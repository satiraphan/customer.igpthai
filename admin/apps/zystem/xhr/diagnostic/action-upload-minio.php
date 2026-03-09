<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../include/db.php";
	include_once "../../../../include/oceanos.php";
	include_once "../../include/engine.php";
	require '../../../../vendor/autoload.php';
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	use Aws\S3\S3Client;
	use Aws\Exception\AwsException;
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);

	
	// Response JSON
	header('Content-Type: application/json');
	
	// ตรวจสอบว่ามีไฟล์ส่งมาหรือไม่
	if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
		echo json_encode([
			'success' => false,
			'message' => 'No file uploaded or upload error'
		]);
		exit;
	}

	$file = $_FILES['file'];
	$fileName = $file['name'];
	$fileTmpPath = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileType = $file['type'];
	
	// แยกนามสกุลไฟล์
	$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
	
	// สร้างชื่อไฟล์ใหม่ (เก็บตามนามสกุลจริง)
	$newFileName = 'upload-' . time() . '-' . uniqid() . '.' . $fileExtension;
	
	// 1. ตั้งค่าการเชื่อมต่อ MinIO
	$s3Client = new S3Client([
		'version'     => 'latest',
		'region'      => 'us-east-1',
		'endpoint'    => 'http://'.MINIO_SERVER,
		'use_path_style_endpoint' => true,
		'credentials' => [
			'key'    => MINIO_USER,
			'secret' => MINIO_PASS,
		],
	]);

	$bucketName = 'test'; // ต้องสร้าง Bucket นี้ใน MinIO Console ก่อน

	try {
		// 2. อัปโหลดไฟล์ไป MinIO
		$result = $s3Client->putObject([
			'Bucket' => $bucketName,
			'Key'    => $newFileName,
			'SourceFile' => $fileTmpPath,
			'ContentType' => $fileType,
			'ACL' => 'public-read' // ถ้าต้องการให้เข้าถึงได้แบบ public
		]);

		// 3. สร้าง URL สำหรับเรียกดูไฟล์
		$fileUrl = 'http://'.MINIO_SERVER.'/'.$bucketName.'/'.$newFileName;
		
		// หรือใช้ Pre-signed URL (แนะนำสำหรับความปลอดภัย)
		$cmd = $s3Client->getCommand('GetObject', [
			'Bucket' => $bucketName,
			'Key'    => $newFileName
		]);
		$presignedUrl = (string) $s3Client->createPresignedRequest($cmd, '+1 hour')->getUri();

		echo json_encode([
			'success' => true,
			'message' => 'Upload successful',
			'data' => [
				'originalName' => $fileName,
				'storedName' => $newFileName,
				'fileSize' => $fileSize,
				'fileType' => $fileType,
				'extension' => $fileExtension,
				'publicUrl' => $fileUrl,
				'presignedUrl' => $presignedUrl,
				'objectUrl' => $result['ObjectURL']
			]
		]);

	} catch (AwsException $e) {
		echo json_encode([
			'success' => false,
			'message' => 'Upload error: ' . $e->getMessage()
		]);
	}
	
	$dbc->Close();
?>