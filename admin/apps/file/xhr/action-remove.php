<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	require '../../../vendor/autoload.php';

	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	use Aws\S3\S3Client;
	use Aws\Exception\AwsException;
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	

	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);

	$remove_physical = isset($_POST['remove_physical'])?true:false;
	$file = $dbc->GetRecord("os_files","*","id=".$_POST['file_id']);

	if($remove_physical) {
		try {

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

            // 2. ลบไฟล์ใน Minio
            $s3Client->deleteObject([
                'Bucket' => 'test',
                'Key'    => $file['name'],
            ]);

			$dbc->Delete("os_files","id=".$_POST['file_id']);
			$os->save_log(0,$os->auth['id'],"file-delete",$_POST['file_id'],array("file" => $file));

			echo json_encode(array(
				'success' => true,
				'message' => 'File deleted successfully'
			));

        } catch (Exception $e) {
			echo json_encode(array(
				'success' => false,
				'message' => 'Failed to delete file',
				'error' => $e->getMessage()
			));
        }

	}else{
		$dbc->Update("os_files",array(
			"#deleted" => "NOW()"
		),"id=".$_POST['file_id']);
		$file = $dbc->GetRecord("os_files","*","id=".$_POST['file_id']);
		$os->save_log(0,$os->auth['id'],"file-delete",$_POST['file_id'],array("file" => $file));

		echo json_encode(array(
			'success' => true,
			'message' => 'File marked as deleted'
		));
	}

	$dbc->Close();
?>
