let leave_type = document.getElementById('leave-type');
    let leave_from_date = document.getElementById('leave-from-date');
    let leave_to_date = document.getElementById('leave-to-date');
    let leave_file = document.getElementById('leave-file');
    let leave_day = document.getElementById('leave-day');
    let leave_count = document.getElementById('leave-count');

    leave_type.addEventListener('change', function(){
        if(leave_type.value != ""){
            leave_day.innerHTML = "";
        }
        if(leave_type.value == "medical"){
            document.getElementById('medical-leave-special').innerHTML = "* File must be upload in case of medical leave"
        }else{
            document.getElementById('medical-leave-special').innerHTML = "";
        }
    });

    leave_from_date.addEventListener('change', function(){
        if(leave_type.value == "" && leave_from_date.value != ""){
            leave_from_date.value = "";
            leave_day.innerHTML = "Select a leave type first";
        }
        if((new Date(leave_from_date.value).getTime() - new Date().getTime()) < 0){
            leave_from_date.value = "";
            leave_day.innerHTML = "Past date is not accepted";
        }
        if(leave_from_date.value != ""){
            leave_day.innerHTML = "";
        }
    });

    leave_to_date.addEventListener('change', function(){
        if(leave_type.value == "" && leave_to_date.value != ""){
            leave_to_date.value = "";
            leave_from_date.value = "";
            leave_day.innerHTML = "Select a leave type first";
        }else if(leave_from_date.value == "" && leave_to_date.value != ""){
            leave_to_date.value = "";
            leave_day.innerHTML = "From date value need first";
        }else{
            let leave_days = [];
            let x = new Date(leave_from_date.value);
            let y = new Date(leave_to_date.value);
            for(let i = x; i <= y; i.setDate(i.getDate() + 1)){
                if(i.getDay() != 0 && i.getDay() != 6){
                    leave_days.push(i.getDate());
                }
            }
            leave_day.innerHTML = "No of days: " + leave_days.length;
            leave_count.value = leave_days.length;
        }
        if((new Date(leave_to_date.value).getTime() - new Date().getTime()) < 0){
            leave_to_date.value = "";
            leave_day.innerHTML = "Past date is not accepted";
        }
        if(leave_type.value == 'casual' && leave_count.value > 3){
            leave_day.innerHTML = "More than 3 day casual leave not allowed";
            leave_to_date.value = "";
            leave_from_date.value = "";
        }
        if(leave_type.value == 'sick' && leave_count.value > 10){
            leave_day.innerHTML = "More than 10 days sick leave not allowed";
            leave_to_date.value = "";
            leave_from_date.value = "";
        }
        if(leave_type.value == 'earned' && leave_count.value > 12){
            leave_day.innerHTML = "More than 12 days earned leave not allowed";
            leave_to_date.value = "";
            leave_from_date.value = "";
        }
    });