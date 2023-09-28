function checkSignUp() {
    if (document.registrForm.username.value.length < 4) {
        alert("Username deve contenere almeno 4 caratteri");
        return false;
    }
    else if (document.registrForm.password.value.length < 8) {
        alert("La password deve essere lunga almeno 8 caratteri");
        return false;
    }
    else if (document.registrForm.password.value != document.registrForm.passwordConfirm.value) {
        alert("Le password non corrispondono");
        return false;
    }
    return true;
}