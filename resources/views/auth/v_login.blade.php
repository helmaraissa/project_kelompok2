<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Fonts dan CSS -->
    <link href="{{ asset("template") }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700" rel="stylesheet">
    <link href="{{ asset("template") }}/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-login {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            padding: 3rem;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .card-login h1 {
            font-size: 2rem;
            font-weight: bold;
        }

        .form-control-user {
            height: 3.2rem;
            font-size: 1.1rem;
        }

        .btn-user {
            font-size: 1.1rem;
            padding: 0.75rem;
        }
    </style>
</head>

<body style="background: url('{{ asset('assets/img/headersmanja.JPG') }}') no-repeat center center fixed; background-size: cover;">

    <div class="container login-wrapper">
        <div class="card-login">
            <div class="text-center mb-4">
                <h1 class="text-gray-900">Welcome Back!</h1>
            </div>
            <form class="user" method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-user"
                        placeholder="Enter Username..." required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user"
                        placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-warning btn-user btn-block">
                    Login
                </button>
            </form>
            <hr>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset("template") }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset("template") }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset("template") }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ asset("template") }}/js/sb-admin-2.min.js"></script>

</body>

</html>
