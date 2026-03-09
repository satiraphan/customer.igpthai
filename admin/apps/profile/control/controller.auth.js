
function handleCredentialResponse(response) {
  // รับ Token ส่งไป Backend เหมือนเดิม
  console.log("Encoded JWT ID token: " + response.credential);
  
  // ตัวอย่างส่งข้อมูลไปหลังบ้าน
  // fetch('/auth/google', { ... });
}

$('#customBtn').click(function(){
	google.accounts.id.initialize({
		client_id: "5656041767-7lbglacetmf3m3tfp64a287aujphic46.apps.googleusercontent.com",
		callback: handleCredentialResponse // ฟังก์ชันรับ Token หลังจาก Login
	});
	google.accounts.id.prompt(); 
});