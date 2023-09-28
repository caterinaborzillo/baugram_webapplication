function checkEditProfile() {
    var myForm = document.editProfileForm;

    if (myForm.username.value.length < 4) {
        alert("Lo username deve contenere almeno 4 caratteri");
        return false;
    }
    else if (myForm.newPassword.value.length < 8) {
        alert("La password deve contenere almeno 8 caratteri");
        return false;
    }
    return true;
}