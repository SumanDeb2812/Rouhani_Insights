// $(document).ready(function(){
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $('#role_change').click(function(e){
//         e.preventDefault();
//         let role_id = $('#role_id').val();
//         $.ajax({
//             uploadUrl: "{{ route('change.role') }}",
//             type: 'POST',
//             data: {role_id : role_id},
//             success: function(response){
//                 window.onload(function(){
//                     location.pathname('/admin/dashboard');
//                 });
//             }
//         });
//     });
// });