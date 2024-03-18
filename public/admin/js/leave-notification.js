$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // function showLeaveNotification(){
    //     $.ajax({
    //         url: 'ckeck-leave-notification',
    //         success: function(response){
    //             let result = JSON.parse(response);
    //             let resultCount = result.length;
    //             if(resultCount > 1){
    //                 $('#leave-request-notification').append(
    //                     '<span>' + "You have " + resultCount + " pending leave request" + '</span>'
    //                 );
    //             }else{
    //                 result.forEach(data => {
    //                     $('#leave-request-notification').append(
    //                         '<span>' + "You have a pending leave request from " + data.emp_fname + '</span>'
    //                     );
    //                 });
    //             }
    //             //to start showing close button
    //             if(result.length > 0){
    //                 setTimeout(() => {
    //                     $('#close-notification').show();
    //                 }, 500);
    //             }
    //         }
    //     });
    // }
    // showLeaveNotification();

    // $('#close-notification').click(function(){
    //     $('#leave-request-notification').fadeOut('slow');
    // })
    function getleaveNotification(){
        $.ajax({
            url: 'ckeck-leave-notification',
            success: function(response){
                let result = JSON.parse(response);
                let resultCount = result.length;
                if(resultCount > 0){
                    $('#notification-count').html(resultCount);
                    $('#notification-count').css('display', 'flex');
                    $('#notification-bell').addClass('animateBell');
                }
            }
        });
    }
    getleaveNotification();
    const leaveNF = setInterval(getleaveNotification, 5000);

    $('#leave-request-notification').click(() => {
        $.ajax({
            url: 'ckeck-leave-notification',
            success: function(response){
                $('#notification-box').empty();
                $('#notification-box-outer').show();
                let result = JSON.parse(response);
                let resultCount = result.length;
                if(resultCount > 0){
                    result.forEach(data => {
                        $('#notification-box').append(
                            '<span>' + "You have a pending leave request from " + data.emp_fname + '</span>'
                        );
                        $.ajax({
                            url: 'update-notification-status',
                            success: function(response){
                                $('#notification-count').hide();
                                $('#notification-bell').removeClass('animateBell');
                            }
                        });
                    });
                }else{
                    $('#notification-box').append(
                        '<span id="noNF">No more notification</span>'
                    );
                }
            }
        });
    });

    $(window).on('click', () => {
        $('#notification-box-outer').hide();
    });
});