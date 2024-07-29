<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="assets/sb-admin/css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/sb-admin/vendor/jquery/jquery.min.js"></script>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" id="loginForm">
                                        <div id="loginError" class="alert alert-danger d-none" role="alert"></div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukkan Password" />
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" />
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/sb-admin/js/sb-admin-2.min.js"></script>

    <!-- Custom JavaScript for form validation -->
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                // Clear any previous error messages
                $('#loginError').addClass('d-none').text('');

                var username = $('#username').val().trim();
                var password = $('#password').val().trim();

                // Log input values for debugging
                console.log('Username:', username);
                console.log('Password:', password);

                if (username === '' || password === '') {
                    $('#loginError').removeClass('d-none').text('Username and password cannot be empty.');
                    return;
                }

                // Log before sending AJAX request
                console.log('Sending AJAX request with data:', {
                    username: username,
                    password: password
                });

                // If valid, submit the form via AJAX
                $.ajax({
                    url: '<?php echo site_url('auth/login'); ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        console.log('Response:', response); // Log the response for debugging

                        if (response.status === 'success') {
                            console.log('Login successful, redirecting to dashboard...');
                            window.location.href = '<?php echo site_url('dashboard'); ?>';
                        } else {
                            console.log('Login failed:', response.message);
                            $('#loginError').removeClass('d-none').text(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX Error');
                        console.log('Status:', status);
                        console.log('Error:', error);
                        console.log('Response:', xhr.responseText);
                        $('#loginError').removeClass('d-none').text('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

</body>

</html>