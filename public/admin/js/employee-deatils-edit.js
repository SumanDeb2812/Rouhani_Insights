let emp_info_sub_ep_pi = document.getElementById('emp-info-sub-ep-pi');
let emp_info_sub_ep_qf = document.getElementById('emp-info-sub-ep-qf');
let emp_info_sub_ep_we = document.getElementById('emp-info-sub-ep-we');
let emp_info_sub_ep_bd = document.getElementById('emp-info-sub-ep-bd');
let emp_info_sub_ep_dp = document.getElementById('emp-info-sub-ep-dp');

function openPi() {
    emp_info_sub_ep_pi.style.display = "block";
    emp_info_sub_ep_qf.style.display = "none";
    emp_info_sub_ep_we.style.display = "none";
    emp_info_sub_ep_bd.style.display = "none";
    emp_info_sub_ep_dp.style.display = "none";
    emp_info_pi.classList.add('emp_info_active');
    emp_info_qf.classList.remove('emp_info_active');
    emp_info_we.classList.remove('emp_info_active');
    emp_info_bd.classList.remove('emp_info_active');
    emp_info_dp.classList.remove('emp_info_active');
    emp_info_pi.classList.remove('emp_info_button');
    emp_info_qf.classList.add('emp_info_button');
    emp_info_we.classList.add('emp_info_button');
    emp_info_bd.classList.add('emp_info_button');
    emp_info_dp.classList.add('emp_info_button');
}

function openQf() {
    emp_info_sub_ep_pi.style.display = "none";
    emp_info_sub_ep_qf.style.display = "block";
    emp_info_sub_ep_we.style.display = "none";
    emp_info_sub_ep_bd.style.display = "none";
    emp_info_sub_ep_dp.style.display = "none";
    emp_info_pi.classList.remove('emp_info_active');
    emp_info_qf.classList.add('emp_info_active');
    emp_info_we.classList.remove('emp_info_active');
    emp_info_bd.classList.remove('emp_info_active');
    emp_info_dp.classList.remove('emp_info_active');
    emp_info_pi.classList.add('emp_info_button');
    emp_info_qf.classList.remove('emp_info_button');
    emp_info_we.classList.add('emp_info_button');
    emp_info_bd.classList.add('emp_info_button');
    emp_info_dp.classList.add('emp_info_button');
}

function openWe() {
    emp_info_sub_ep_pi.style.display = "none";
    emp_info_sub_ep_qf.style.display = "none";
    emp_info_sub_ep_we.style.display = "block";
    emp_info_sub_ep_bd.style.display = "none";
    emp_info_sub_ep_dp.style.display = "none";
    emp_info_pi.classList.remove('emp_info_active');
    emp_info_qf.classList.remove('emp_info_active');
    emp_info_we.classList.add('emp_info_active');
    emp_info_bd.classList.remove('emp_info_active');
    emp_info_dp.classList.remove('emp_info_active');
    emp_info_pi.classList.add('emp_info_button');
    emp_info_qf.classList.add('emp_info_button');
    emp_info_we.classList.remove('emp_info_button');
    emp_info_bd.classList.add('emp_info_button');
    emp_info_dp.classList.add('emp_info_button');
}

function openBd() {
    emp_info_sub_ep_pi.style.display = "none";
    emp_info_sub_ep_qf.style.display = "none";
    emp_info_sub_ep_we.style.display = "none";
    emp_info_sub_ep_bd.style.display = "block";
    emp_info_sub_ep_dp.style.display = "none";
    emp_info_pi.classList.remove('emp_info_active');
    emp_info_qf.classList.remove('emp_info_active');
    emp_info_we.classList.remove('emp_info_active');
    emp_info_bd.classList.add('emp_info_active');
    emp_info_dp.classList.remove('emp_info_active');
    emp_info_pi.classList.add('emp_info_button');
    emp_info_qf.classList.add('emp_info_button');
    emp_info_we.classList.add('emp_info_button');
    emp_info_bd.classList.remove('emp_info_button');
    emp_info_dp.classList.add('emp_info_button');
}

function openDp() {
    emp_info_sub_ep_pi.style.display = "none";
    emp_info_sub_ep_qf.style.display = "none";
    emp_info_sub_ep_we.style.display = "none";
    emp_info_sub_ep_bd.style.display = "none";
    emp_info_sub_ep_dp.style.display = "block";
    emp_info_pi.classList.remove('emp_info_active');
    emp_info_qf.classList.remove('emp_info_active');
    emp_info_we.classList.remove('emp_info_active');
    emp_info_bd.classList.remove('emp_info_active');
    emp_info_dp.classList.add('emp_info_active');
    emp_info_pi.classList.add('emp_info_button');
    emp_info_qf.classList.add('emp_info_button');
    emp_info_we.classList.add('emp_info_button');
    emp_info_bd.classList.add('emp_info_button');
    emp_info_qf.classList.remove('emp_info_button');
}

openPi();

//-------------------------------------------------------------

let count = 1;
let oriClone_1 = document.getElementById('oriClone_1');
let cloneDiv_1 = document.getElementById('cloneDiv_1');
let oriClone_2 = document.getElementById('oriClone_2');
let cloneDiv_2 = document.getElementById('cloneDiv_2');
let cloneDiv_3 = document.getElementById('cloneDiv_3');
let remove_clone = document.getElementById('remove_clone');

function makeClone() {
    event.preventDefault();
    let clone_1 = oriClone_1.cloneNode(true);
    let clone_2 = oriClone_2.cloneNode(true);
    let clone_3 = remove_clone.cloneNode(true);
    cloneDiv_1.appendChild(clone_1);
    cloneDiv_2.appendChild(clone_2);
    cloneDiv_3.appendChild(clone_3);
    remove_clone.style.display = 'inline';
    count = count + 1;
    clone_1.value = '';
    clone_2.value = '';
}

function removeClone() {
    event.preventDefault();
    cloneDiv_1.removeChild(cloneDiv_1.lastChild);
    cloneDiv_2.removeChild(cloneDiv_2.lastChild);
    cloneDiv_3.removeChild(cloneDiv_3.lastChild);
    count = count - 1;
    if (count == 1) {
        document.getElementById('remove_clone').style.display = 'none';
    }
}

//----------------------------------------------------------------------

function searchPincode() {
    let pincode = document.getElementById('pincode').value;
    let district = document.getElementById('district');
    let state = document.getElementById('state');
    let country = document.getElementById('country');
    let city_name = document.getElementById('city-name');

    let p = fetch("https://api.postalpincode.in/pincode/" + pincode);
    p.then((response) => {
        return response.json();
    }).then((value) => {
        console.log(value);
        let data = value[0].PostOffice[0];
        country.value = data.Country;
        district.value = data.District;
        state.value = data.State;
        let city = value[0].PostOffice;
        city.forEach(cityName => {
            let option = document.createElement('option');
            option.value = cityName.Name;
            option.text = cityName.Name;
            city_name.appendChild(option);
        });
    });
}

//----------------------------------------------------------------------

let count_skill = 1;
let oriClone_Skill = document.getElementById('oriClone_Skill');
let cloneDiv_Skill = document.getElementById('cloneDiv_Skill');
let cloneDiv_Skill_Remove = document.getElementById('cloneDiv_Skill_Remove');
let remove_clone_skill = document.getElementById('remove_clone_skill');

function makeSkillClone() {
    event.preventDefault();
    let clone_skill1 = oriClone_Skill.cloneNode(true);
    let clone_skill2 = remove_clone_skill.cloneNode(true);
    cloneDiv_Skill.appendChild(clone_skill1);
    cloneDiv_Skill_Remove.appendChild(clone_skill2);
    remove_clone_skill.style.display = 'inline';
    count_skill = count_skill + 1;
    clone_skill1.value = '';
}

function removeSkillClone() {
    event.preventDefault();
    cloneDiv_Skill.removeChild(cloneDiv_Skill.lastChild);
    cloneDiv_Skill_Remove.removeChild(cloneDiv_Skill_Remove.lastChild);
    count_skill = count_skill - 1;
    if (count_skill == 1) {
        remove_clone_skill.style.display = 'none';
    }
}

//--------------------------------------------------------------------------

function searchIFSC() {
    let emp_bank_ifsc = document.getElementById('emp_bank_ifsc').value;

    let p = fetch("https://ifsc.razorpay.com/" + emp_bank_ifsc);
    p.then((response) => {
        return response.json();
    }).then((value) => {
        let data = value;
        emp_bank_branch.value = data.BRANCH;
        emp_bank_name.value = data.BANK;
        emp_bank_address.value = data.ADDRESS;
    })
}