<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
        </style>
    </head>
    <body class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center ">
                <div class="col-md-4" style="padding-top:100px;">
                    <div class="card">
                        <h3 class="card-header text-center">Login</h3>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login')  }}" id="loginForm">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
                                    <span class="text-danger email-error">{{ $errors->first('email') }}</span>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control" name="password" min="6" required>
                                    <span class="text-danger password-error">{{ $errors->first('password') }}</span>
                                </div>

                                <div class="d-grid mx-auto">
                                    <button type="button" class="btn btn-primary btn-block loginBtn">Sign In</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $('.loginBtn').on('click',function(e) {
        e.preventDefault();
        const email = $('#email').val();
        const password = $("#password").val();
        let emailErrorText = '';
        let passErrorText = '';
        let error = false;
        if(!email) {
            emailErrorText = 'email field is required!';
            error = true
        }
        if(password.length < 6) {
            passErrorText = 'password must contain minimum 6 characters!'
            error = true
        }
        if(!isValidEmail(email)) {
            emailErrorText = 'Incorrect format for email!';
            error = true
        }
        if(error) {
            let emailErrorField = $('.email-error');
            let passwordErrorField = $('.password-error');
            emailErrorField.text(emailErrorText);
            passwordErrorField.text(passErrorText);
            emailErrorField.show();
            passwordErrorField.show();
            return false
        }

        $("#loginForm").submit();
    });

    $('#email').on('input',function(e) {
        e.preventDefault();
        $('.email-error').hide();
    });

    $('#password').on('input',function(e) {
        e.preventDefault();
        $('.password-error').hide();
    });

    function isValidEmail(email) {
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailPattern.test(email);
    }
</script>
