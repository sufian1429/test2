window.addEventListener('DOMContentLoaded', (event) => {
    loadUserProfile();
  });
  
  
  function loadUserProfile() {
    // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
    // และดึงข้อมูลบัญชีผู้ใช้จากฐานข้อมูล
  
    // ตัวอย่างข้อมูลบัญชีผู้ใช้จากฐานข้อมูล
    var user = {
      mem_name: "John Doe",
      mem_img: "./img_web/profile.jpg"
    };
  
    var profileImage = document.getElementById("profile-image");
    var profileName = document.getElementById("profile-name");
  
    if (user) {
      profileImage.src = user.mem_img;
      profileName.textContent = user.mem_name;
    }
  }
  