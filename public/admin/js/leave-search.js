$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function autoLoad(){
        $.ajax({
            url: 'search-leave-report',
            success: function(response){
                $('#leave-report-tbody').empty();
                $('#leave-report-tbody').html(response);
            }
        });
    }
    autoLoad();

    let count = 1;
    $('#first_page_leave_url').click(function(){
        if(count > 1){
            count = count-1;
            $.ajax({
                url: 'search-leave-report?page=' + count,
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }
        console.log(count);
    });
    $('#next_page_leave_url').click(function(){
        count = count+1;
        $.ajax({
            url: 'search-leave-report?page=' + count,
            success: function(response){
                $('#leave-report-tbody').empty();
                $('#leave-report-tbody').html(response);
            }
        });
        console.log(count);
    });

    $('#leave_name_search').keyup(function(){
        if($($(this).val() != "" && '#leave_from_date_search').val() == "" && $('#leave_to_date_search').val() == ""){
            request = $.ajax({
                url: 'search-leave-report/' + $(this).val() + '/all/all',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($(this).val() != "" && $('#leave_from_date_search').val() != "" && $('#leave_to_date_search').val() == ""){
            $.ajax({
                url: 'search-leave-report/' + $(this).val() + '/' + $('#leave_from_date_search').val() + '/all',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($(this).val() == "" && $('#leave_from_date_search').val() != "" && $('#leave_to_date_search').val() == ""){
            $.ajax({
                url: 'search-leave-report/all/' + $('#leave_from_date_search').val() + '/all',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($(this).val() != "" && $('#leave_from_date_search').val() == "" && $('#leave_to_date_search').val() != ""){
            $.ajax({
                url: 'search-leave-report/' + $(this).val() + '/all/' + $('#leave_to_date_search').val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($(this).val() == "" && $('#leave_from_date_search').val() == "" && $('#leave_to_date_search').val() != ""){
            $.ajax({
                url: 'search-leave-report/all/all/' + $('#leave_to_date_search').val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($(this).val() != "" && $('#leave_from_date_search').val() != "" && $('#leave_to_date_search').val() != ""){
            $.ajax({
                url: 'search-leave-report/' + $(this).val() + '/' + $('#leave_from_date_search').val() + '/' + $('#leave_to_date_search').val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($(this).val() == "" && $('#leave_from_date_search').val() != "" && $('#leave_to_date_search').val() != ""){
            $.ajax({
                url: 'search-leave-report/all/' + $('#leave_from_date_search').val() + '/' + $('#leave_to_date_search').val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else{
            $.ajax({
                url: 'search-leave-report',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }
    });

    $('#leave_from_date_search').change(function(){
        if($('#leave_name_search').val() == "" && $(this).val() != "" && $('#leave_to_date_search').val() == ""){
            $.ajax({
                url: 'search-leave-report/all/' + $(this).val() + '/all',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() == "" && $(this).val() == "" && $('#leave_to_date_search').val() == ""){
            $.ajax({
                url: 'search-leave-report',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() != "" && $(this).val() != "" && $('#leave_to_date_search').val() == ""){
            $.ajax({
                url: 'search-leave-report/'+ $('#leave_name_search').val() + '/' + $(this).val() + '/all',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() != "" && $(this).val() == "" && $('#leave_to_date_search').val() == ""){
            $.ajax({
                url: 'search-leave-report/'+ $('#leave_name_search').val() + '/all/all',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() != "" && $(this).val() == "" && $('#leave_to_date_search').val() != "") {
            $.ajax({
                url: 'search-leave-report/' + $('#leave_name_search').val() + '/all/' + $('#leave_to_date_search').val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() == "" && $(this).val() != "" && $('#leave_to_date_search').val() != "") {
            $.ajax({
                url: 'search-leave-report/all/' + $(this).val() + '/' + $('#leave_to_date_search').val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() == "" && $(this).val() == "" && $('#leave_to_date_search').val() != "") {
            $.ajax({
                url: 'search-leave-report/all/all/' + $('#leave_to_date_search').val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else{
            $.ajax({
                url: 'search-leave-report/'+ $('#leave_name_search').val() + '/' + $(this).val() + '/' + $('#leave_to_date_search').val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }
    });

    $('#leave_to_date_search').change(function(){
        if($('#leave_name_search').val() == "" && $('#leave_from_date_search').val() == "" && $(this).val() != ""){
            $.ajax({
                url: 'search-leave-report/all/all/' + $(this).val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() == "" && $('#leave_from_date_search').val() == "" && $(this).val() == ""){
            $.ajax({
                url: 'search-leave-report',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() != "" && $('#leave_from_date_search').val() == "" && $(this).val() != ""){
            $.ajax({
                url: 'search-leave-report/' + $('#leave_name_search').val() + '/all/' + $(this).val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() != "" && $('#leave_from_date_search').val() == "" && $(this).val() == ""){
            $.ajax({
                url: 'search-leave-report/' + $('#leave_name_search').val() + '/all/all',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() != "" && $('#leave_from_date_search').val() != "" && $(this).val() != ""){
            $.ajax({
                url: 'search-leave-report/' + $('#leave_name_search').val() + '/' +  $('#leave_from_date_search').val() + '/' + $(this).val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() == "" && $('#leave_from_date_search').val() != "" && $(this).val() != ""){
            $.ajax({
                url: 'search-leave-report/all/' +  $('#leave_from_date_search').val() + '/' + $(this).val(),
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else if($('#leave_name_search').val() == "" && $('#leave_from_date_search').val() != "" && $(this).val() == ""){
            $.ajax({
                url: 'search-leave-report/all/' +  $('#leave_from_date_search').val() + '/all',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }else{
            $.ajax({
                url: 'search-leave-report/' + $('#leave_name_search').val() + '/' +  $('#leave_from_date_search').val() + '/all',
                success: function(response){
                    $('#leave-report-tbody').empty();
                    $('#leave-report-tbody').html(response);
                }
            });
        }
    });

    $('#clear-leave-filter').click(function(){
        if($('#leave_name_search').val() != "" || $('#leave_from_date_search').val != "" || $('#leave_to_date_search').val != ""){
            document.getElementById('leave_name_search').value = "";
            document.getElementById('leave_from_date_search').value = "";
            document.getElementById('leave_to_date_search').value = "";
            autoLoad();
        }
    });

    $('#generate-leave-report-btn').click(function(){
        $('#generate-leave-report-div-outer').css('display', 'flex');
    });
    
    $('#generate-leave-report-div-close').click(function(){
        $('#generate-leave-report-div-outer').fadeOut('slow');
    });

    $('#print_with_filter').click(function(e){
        e.preventDefault();
        let emp_id = $('#leave-report-name').val();
        let from_date = $('#leave-report-from-date').val();
        let to_date = $('#leave-report-to-date').val();
        if(emp_id == "" && from_date == "" && to_date == ""){
            $('#leave-report-error').show();
        }else{
            $('#leave-report-error').hide();
            $.ajax({
                url: 'generate-leave-report',
                type: 'POST',
                data: {emp_id: emp_id, from_date: from_date, to_date: to_date},
                success: function(response){
                    $('#generate-leave-report-div-outer').hide();
                    $('#leave-report-preview-outer').css('display', 'flex');
                    $('#leave-report-preview-outer').html(response);
                }
            });
        }
        $('#leave-filter-form').trigger('reset');
    });

    $('#print_without_filter').click(function(){
        $.ajax({
            url: 'generate-leave-report-wofilter',
            success: function(response){
                $('#generate-leave-report-div-outer').hide();
                $('#leave-report-preview-outer').css('display', 'flex');
                $('#leave-report-preview-outer').html(response);
            }
        });
    });
});

document.getElementById('leave_name_search').addEventListener('search', function(){
    if(this.value == ""){
        autoLoad();
        $('#leave-report-tbody').html("");
    }
});

function validateLeaveReportForm(){
    if(document.getElementById('leave-report-name').value == "" && document.getElementById('leave-report-from-date').value == "" && document.getElementById('leave-report-to-date').value == ""){
        event.preventDefault();
        document.getElementById('leave-report-error').style.display = "block";
        return false;
    }else{
        document.getElementById('leave-report-error').style.display = "none";
        return true;
    }
}

function cancelPrint(){
    $('#leave-report-preview-outer').fadeOut('slow');
}