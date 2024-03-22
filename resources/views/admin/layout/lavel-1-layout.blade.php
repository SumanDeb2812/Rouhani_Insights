<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('website/images/favicon.png') }}">

    <!-- Style sheet link below! -->
    <link rel="stylesheet" href="{{ asset('admin/scss/style.css') }}">

    <!-- Google font link below! -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    <!-- Bootstrap css link below! -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font awsome icon link below! -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Owl carousel css file link below! -->
    <link rel="stylesheet" href="{{ asset('admin/owl-carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/owl-carousel/css/owl.theme.default.css') }}">

    <title>Rouhani - Dashboard</title>
</head>

<body style="background-color: rgb(220, 255, 240)">
    @if(session()->has('success-alert'))
    <div id="success-alert">
        <p><i class="fa fa-times" id="cancel-success-msg" onclick="cancelSuccessMsg()"></i>{{ session()->get('success-alert') }}</p>
    </div>
    @endif
    @error('error-alert')
    <div id="error-alert">
        <p><i class="fa fa-times" id="cancel-error-msg" onclick="cancelErrorMsg()"></i>{{ $message }}</p>
    </div>
    @enderror

    @yield('main-content')

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="{{ asset('admin/js/change-role.js') }}"></script>
    <script src="{{ asset('admin/js/clone.js') }}"></script>
    <script src="{{ asset('admin/js/apply-leave.js') }}"></script>
    <script src="{{ asset('admin/js/reject-leave.js') }}"></script>
    <script src="{{ asset('admin/js/web-auth-role-select.js') }}"></script>
    <script src="{{ asset('admin/js/leave-search.js') }}"></script>
    <script src="{{ asset('admin/js/leave-notification.js') }}"></script>
    <script src="{{ asset('admin/js/employee-details-validation.js') }}"></script>

    <!-- Owl cerousel js file and jquery file link below! -->
    <script src="{{ asset('admin/owl-carousel/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin/owl-carousel/js/script.js') }}"></script>
    
    <script>
        function cancelSuccessMsg(){
            document.getElementById('success-alert').style.display = "none";
        }
        function cancelErrorMsg(){
            document.getElementById('error-alert').style.display = "none";
        }
    </script>
    
    <!-- Bootstrap js link below -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>