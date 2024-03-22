$(document).ready(function(){
    let onlyAlphaPattern = /^[a-zA-Z ]+$/;
    // let validateError = true;
    function validateFatherName(){
        if($('#emp-father').val() == ""){
            $('#emp-father-error').html("Name is required");
            return false;
        }else if(!$('#emp-father').val().match(onlyAlphaPattern)){
            $('#emp-father-error').html("Name is invailed");
            return false;
        }else if($('#emp-father').val().length < 2){
            $('#emp-father-error').html("Name must have aleast two charecter");
            return false;
        }else{
            $('#emp-father-error').html("");
            return true;
        }
    }
    function validateMotherName(){
        if($('#emp-mother').val() == ""){
            $('#emp-mother-error').html("Name is required");
            return false;
        }else if(!$('#emp-mother').val().match(onlyAlphaPattern)){
            $('#emp-mother-error').html("Name is invailed");
            return false;
        }else if($('#emp-mother').val().length < 2){
            $('#emp-mother-error').html("Name must have aleast two charecter");
            return false;
        }else{
            $('#emp-mother-error').html("");
            return true;
        }
    }
    function validateGurdianName(){
        if($('#emp-gurdian').val() == ""){
            $('#emp-gurdian-error').html("Name is required");
            return false;
        }else if(!$('#emp-gurdian').val().match(onlyAlphaPattern)){
            $('#emp-gurdian-error').html("Name is invailed");
            return false;
        }else if($('#emp-gurdian').val().length < 2){
            $('#emp-gurdian-error').html("Name must have aleast two charecter");
            return false;
        }else{
            $('#emp-gurdian-error').html("");
            return true;
        }
    }
    function checkoriClone_1(){
        if($('#oriClone_1').val() == ""){
            $('#emp-ori-1-error').html('Name is required');
            return false;
        }else if(!$('#oriClone_1').val().match(onlyAlphaPattern)){
            $('#emp-ori-1-error').html("Name is invailed");
            return false;
        }else if($('#oriClone_1').val().length < 2){
            $('#emp-ori-1-error').html("Name must have aleast two charecter");
            return false;
        }else{
            $('#emp-ori-1-error').html('');
            return true;
        }
    }
    function checkoriClone_2(){
        if($('#oriClone_2').val() == ""){
            $('#emp-ori-2-error').html('Please select an option');
            return false;
        }else{
            $('#emp-ori-2-error').html('');
            return true;
        }
    }
    function validateMarital(){
        if($('#emp-marital').val() == ""){
            $('#emp-marital-error').html('Please select an option');
            return false;
        }else{
            $('#emp-marital-error').html('');
            return true;
        }
    }
    function validateNationality(){
        if($('#emp-nationality').val() == ""){
            $('#emp-nationality-error').html('Please select an option');
            return false;
        }else{
            $('#emp-nationality-error').html('');
            return true;
        }
    }
    function validateReligion(){
        if($('#emp-religion').val() == ""){
            $('#emp-religion-error').html("Religion is required");
            return false;
        }else if(!$('#emp-religion').val().match(onlyAlphaPattern)){
            $('#emp-religion-error').html("Religion is invailed");
            return false;
        }else if($('#emp-religion').val().length < 2){
            $('#emp-religion-error').html("Religion must have aleast two charecter");
            return false;
        }else{
            $('#emp-religion-error').html("");
            return true;
        }
    }
    $('#emp-father').on('keyup', validateFatherName);
    $('#emp-mother').on('keyup', validateMotherName);
    $('#emp-gurdian').on('keyup', validateGurdianName);
    $('#oriClone_1').on('keyup', function(){
        if(checkoriClone_1() == true && checkoriClone_2() == true){
            $('#clone-dependent').attr('disabled', false);
        }
    });
    $('#oriClone_2').on('change', function(){
        if(checkoriClone_1() == true && checkoriClone_2() == true){
            $('#clone-dependent').attr('disabled', false);
        }
    });
    $('#emp-marital').on('change', validateMarital);
    $('#emp-nationality').on('change', validateNationality);
    $('#emp-religion').on('keyup', validateReligion);

    $('#submit-personal-details').on('submit', function(){
        if(validateFatherName() == false || validateMotherName() == false || validateGurdianName() == false || checkoriClone_1() == false || checkoriClone_2() == false || validateMarital() == false || validateNationality() == false || validateReligion() == false){
            return false;
        }
    });
});