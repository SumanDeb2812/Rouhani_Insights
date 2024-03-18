<div style="font-size: 16px;">
    <img src="https://rouhaniinsights.com/images/logo2.png" style="width: 100px; height: auto; margin-buttom: 20px">
    <p>Dear, {{ $name}}</p>
    <p>Welcome to Rouhani Information System,</p>
    <p>Our cloud based in-built ERP portal for your business requirements.</p>
    <p><b>Your login id is: {{ $emp_id }}</b></p>
    <p><b>Your password is: {{ $password }}</b></p>
    <a href="{{ url('login') }}"><b>Please click on the link to change the One-time system Generated Password</b></a>
</div>