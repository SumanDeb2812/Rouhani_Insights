let count = 0;
let flag = 0;
let array = [];
let leave_type_clone_div = document.getElementById('leave-type-clone-div');
let emp_clone_div = document.getElementById('emp-clone-div');
let leave_count_clone_div = document.getElementById('leave-count-clone-div');
let leave_type_clone = document.getElementById('leave-type-clone');
let emp_clone = document.getElementById('emp-clone');
let leave_count_clone = document.getElementById('leave-count-clone');
let remove_leave_box_casual = document.getElementById('remove-leave-box-casual');
let clone_error = document.getElementById('clone-error');

function makeClone(){
    if(leave_type_clone.value != "" && emp_clone.value != "" && leave_count_clone.value != ""){
        count += 1;
        clone_1 = leave_type_clone.cloneNode(true);
        clone_2 = emp_clone.cloneNode(true);
        clone_3 = leave_count_clone.cloneNode(true);
        leave_type_clone_div.appendChild(clone_1);
        emp_clone_div.appendChild(clone_2);
        leave_count_clone_div.appendChild(clone_3);
        leave_type_clone_div.lastChild.setAttribute('id', 'leave_type_clone' + "_" + count);
        emp_clone_div.lastChild.setAttribute('id', 'emp_clone_div' + "_" + count);
        leave_count_clone_div.lastChild.setAttribute('id', 'leave_count_clone' + "_" + count);
        for(let i = 0; i <= 4; i++){
            if(leave_type_clone.value === leave_type_clone[i].value){
                leave_type_clone_div.lastChild[i].setAttribute('selected', true);
            }
        }
        for(let i = 0; i < emp_clone.length; i++){
            if(emp_clone.value == emp_clone[i].value){
                emp_clone_div.lastChild[i].setAttribute('selected', true);
            }
        }
        leave_type_clone.value = "";
        emp_clone.value = "";
        leave_count_clone.value = "";
        if(count >= 1){
            remove_leave_box_casual.style.display = "block";
        }
    }else{
        clone_error.innerHTML = "Above fields are required";
    }
}

function catchDifference(){
    if(array.length > 0){
        for(let i = 0; i < array.length; i++){
            if(leave_type_clone.value + " " + emp_clone.value === array[i]){
                flag = 1;
                break
            }else{
                flag = 0;
            }
        }
    }
    if(flag == 0){
        array.push(leave_type_clone.value + " " + emp_clone.value);
        return true;
    }else{
        leave_type_clone.value = "";
        emp_clone.value = "";
        clone_error.innerHTML = "This combination is already exists please choose something else";
        return false;
    }
}

function submitForm(){
    if(leave_type_clone.value == "" && emp_clone.value == "" && leave_count_clone.value == "" || catchDifference == false){
        clone_error.innerHTML = "Above fields are required";
        return false;
    }else{
        return true;
    }
}

function removeClone(){
    leave_type_clone.value = leave_type_clone_div.lastChild.value;
    emp_clone.value = emp_clone_div.lastChild.value;
    leave_count_clone.value = leave_count_clone_div.lastChild.value;
    leave_type_clone_div.removeChild(leave_type_clone_div.lastChild);
    emp_clone_div.removeChild(emp_clone_div.lastChild);
    leave_count_clone_div.removeChild(leave_count_clone_div.lastChild);
    count = count- 1;
    if(count == 0){
        remove_leave_box_casual.style.display = "none";
    }
}

function removeError(){
    clone_error.innerHTML = "";
}
    