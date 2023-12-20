<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CoreProc | Log in</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>CoreProc</b></a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form id="loginForm">
                    <div class="mb-3">
                        <div class="input-group email_div fields">
                            <input name="email" id="email" type="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text fields">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <span class="error text-red" id="email_error"></span>
                    </div>

                    <div class="mb-3">
                        <div class="input-group password_div fields">
                            <input name="password" id="password" type="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div><span class="error text-red" id="password_error"></span></div>
                    </div>
                    <div><span class="text-red" id="login_error"></span></div>
                    <div class="row">
                        <div class="col-8">

                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign
                                In</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>

    <script type="module">
        $('#loginForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '/api/login',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Clear previous errors
                    $('.error').text('');
                    $('.fields').removeClass('border border-danger');
                    $('#login_error').text('');
                    

                    if (response.success === true) {
                        // Handle successful submission
                        window.location.href = '/';

                    }else {
                        // Handle validation errors
                        $('#login_error').text('Invalid credentials, Try Again');
                        $.each(response.errors, function(key, value) {
                            $('#' + key + '_error').text(value[0]);
                            $('.' + key + '_div').addClass('border border-danger');
                        });
                        
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>

</body>

</html>