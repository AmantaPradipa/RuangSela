document.addEventListener('DOMContentLoaded', function() {
    const profilePicInput = document.getElementById('profile-pic-input');
    const profilePic = document.querySelector('.profile-pic');
    const cameraIcon = document.querySelector('.camera-icon');

    if (cameraIcon) {
        cameraIcon.addEventListener('click', function() {
            if (profilePicInput) {
                profilePicInput.click();
            }
        });
    }

    if (profilePicInput) {
        profilePicInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file && profilePic) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePic.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
