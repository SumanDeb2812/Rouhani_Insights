// JS for contact us form validation

let error_show = document.getElementById('error-show');

function validateName() {
    let input_name = document.getElementById('input-name');
    if (input_name.value == '') {
        error_show.innerHTML = 'Name is required';
        return false;
    } else if (!input_name.value.match(/^[a-zA-Z ]*$/)) {
        error_show.innerHTML = "Invalid name";
        return false;
    } else {
        error_show.innerHTML = '';
        return true;
    }
};
function validateEmail() {
    let input_email = document.getElementById('input-email');
    if (input_email.value == '') {
        error_show.innerHTML = 'Email is required';
        return false;
    } else if (!input_email.value.match(/^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/)) {
        error_show.innerHTML = "Invalid email";
        return false;
    } else {
        error_show.innerHTML = '';
        return true;
    }
};
function validatePhone() {
    let input_phone = document.getElementById('input-phone');
    if (input_phone.value == '') {
        error_show.innerHTML = 'Phone no. is required';
        return false;
    } else if (!input_phone.value.match(/^\+?[1-9][0-9]{7,14}$/)) {
        error_show.innerHTML = "Invalid phone no.";
        return false;
    } else {
        error_show.innerHTML = '';
        return true;
    }
};
function validateSubject() {
    let input_subject = document.getElementById('input-subject');
    if (input_subject.value == '') {
        error_show.innerHTML = 'Subject is required';
        return false;
    } else {
        error_show.innerHTML = '';
        return true;
    }
};
function validateForm() {
    if (validateName() && validateEmail() && validatePhone() && validateSubject()) {
        return true;
    } else {
        return false;
    }
};