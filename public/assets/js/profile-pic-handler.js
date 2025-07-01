document.addEventListener('DOMContentLoaded', function() {
    const profilePicInput = document.getElementById('profile-pic-input');
    const profilePic = document.querySelector('.profile-pic');
    const cameraIcon = document.querySelector('.camera-icon');

    // Pastikan semua elemen ada sebelum menambahkan event listener
    if (cameraIcon && profilePicInput) {
        cameraIcon.addEventListener('click', function() {
            profilePicInput.click();
        });
    }

    if (profilePicInput && profilePic) {
        profilePicInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePic.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});