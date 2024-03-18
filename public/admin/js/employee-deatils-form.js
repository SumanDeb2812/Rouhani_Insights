let emp_info_sub_pi = document.getElementById('emp-info-sub-pi');
let emp_info_sub_qf = document.getElementById('emp-info-sub-qf');
let emp_info_sub_we = document.getElementById('emp-info-sub-we');
let emp_info_sub_bd = document.getElementById('emp-info-sub-bd');

function openPi() {
    emp_info_sub_pi.style.display = "block";
    emp_info_sub_qf.style.display = "none";
    emp_info_sub_we.style.display = "none";
    emp_info_sub_bd.style.display = "none";
    emp_info_pi.classList.add('emp_info_active');
    emp_info_we.classList.remove('emp_info_active');
    emp_info_bd.classList.remove('emp_info_active');
    emp_info_qf.classList.remove('emp_info_active');
    emp_info_pi.classList.remove('emp_info_button');
    emp_info_we.classList.add('emp_info_button');
    emp_info_bd.classList.add('emp_info_button');
    emp_info_qf.classList.add('emp_info_button');
}

function openQf() {
    emp_info_sub_pi.style.display = "none";
    emp_info_sub_qf.style.display = "block";
    emp_info_sub_we.style.display = "none";
    emp_info_sub_bd.style.display = "none";
    emp_info_pi.classList.remove('emp_info_active');
    emp_info_we.classList.remove('emp_info_active');
    emp_info_bd.classList.remove('emp_info_active');
    emp_info_qf.classList.add('emp_info_active');
    emp_info_pi.classList.add('emp_info_button');
    emp_info_we.classList.add('emp_info_button');
    emp_info_bd.classList.add('emp_info_button');
    emp_info_qf.classList.remove('emp_info_button');
}

function openWe() {
    emp_info_sub_pi.style.display = "none";
    emp_info_sub_qf.style.display = "none";
    emp_info_sub_we.style.display = "block";
    emp_info_sub_bd.style.display = "none";
    emp_info_pi.classList.remove('emp_info_active');
    emp_info_we.classList.add('emp_info_active');
    emp_info_bd.classList.remove('emp_info_active');
    emp_info_qf.classList.remove('emp_info_active');
    emp_info_pi.classList.add('emp_info_button');
    emp_info_we.classList.remove('emp_info_button');
    emp_info_bd.classList.add('emp_info_button');
    emp_info_qf.classList.add('emp_info_button');
}

function openBd() {
    emp_info_sub_pi.style.display = "none";
    emp_info_sub_qf.style.display = "none";
    emp_info_sub_we.style.display = "none";
    emp_info_sub_bd.style.display = "block";
    emp_info_pi.classList.remove('emp_info_active');
    emp_info_we.classList.remove('emp_info_active');
    emp_info_bd.classList.add('emp_info_active');
    emp_info_qf.classList.remove('emp_info_active');
    emp_info_pi.classList.add('emp_info_button');
    emp_info_we.classList.add('emp_info_button');
    emp_info_bd.classList.remove('emp_info_button');
    emp_info_qf.classList.add('emp_info_button');
}

openPi();
