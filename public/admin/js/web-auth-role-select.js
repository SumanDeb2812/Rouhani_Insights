$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //here it check which employee has which type of authorization
    $('#role-auth-empid').change(function(){
        $.ajax({
            url: 'get-role',
            type: "POST",
            data: {emp_id : $(this).val()},
            success: function(response){
                $('#role-auth-roleid').empty();
                let result = JSON.parse(response);
                result.forEach(data => {
                    let option = document.createElement('option');
                    option.value = data.role_id;
                    option.text = data.role_name;
                    $('#role-auth-roleid').append(option);
                });
                
            }
        });
    });

    //here add authorize field if choose forwarding and reporting authurity
    $('#authorization-role').change(function(){
        if($(this).val() == 5 || $(this).val() == 6){
            $(this).css('width', '12vw')
            $('#authorization-emp-select').show();
            $('#authorization-emp-select').find('select').css('width', '12vw');
        }else{
            $('#authorization-emp-select').hide();
            $(this).css('width', '20vw')
        }
    });

    //add authorization with authorized employees
    let count = 1;
    $('#authorization-emp-list').change(function(){
        $('#authorization-emp-select').append(
            '<input type="hidden" name="au_emp_id[]" id="authorization-emp'+count+'"value="' + $(this).val() + '">'
        );
        $('#show-authorized-emp').show();
        $('#show-authorized-emp').append('<span id="span-emp-auth'+count+'">' + $('#authorization-emp'+count).val() + '<i class="fa fa-times" id="remove-emp-auth'+count+'" data-id ="'+count+'"></i></span>');
        $(this).val("");
        function checkAuthPresent(){
            $('#authorization-emp-list option').each(function(){
                if($(this).val() == $('#authorization-emp'+count).val()){
                    $("#authorization-emp-list option[value='" + $(this).val() + "'").hide();
                }else{
                    $("#authorization-emp-list option[value='" + $(this).val() + "'").show();
                }
            });
        }
        checkAuthPresent();
        $('#remove-emp-auth'+count).click(function(){
            $('input').remove('#authorization-emp'+$(this).data('id'));
            $('span').remove('#span-emp-auth'+$(this).data('id'));
            checkAuthPresent();
            if($('#show-authorized-emp').find('span').length == 0){
                $('#show-authorized-emp').hide();
            }
        });
        count++;
    });
});