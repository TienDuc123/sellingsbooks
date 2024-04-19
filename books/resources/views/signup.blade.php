@extends('admin.default')

@section('title')
    Test
    @parent
@stop

@section('header_styles')
    @parent
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .containers {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .containers h2 {
            margin-bottom: 30px;
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
        }

        .form-control {
            border-radius: 5px;
            border-color: #ccc;
        }

        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 30px;
            color: #999;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #007bff;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #ff0000;
        }
    </style>
@stop

@section('content')
    <!-- Nội dung trang -->
    <div class="containers">
        <h2>Đăng ký tài khoản</h2>
        <form id="registerForm" action="{{route("check_signup")}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Họ và tên:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <i class="fa fa-eye-slash password-toggle" id="togglePassword"></i>
            </div>
            <div class="form-group">
                <label for="password_confirm">Nhập lại mật khẩu:</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                <div class="error-message" id="passwordError"></div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
            </div>
            <div class="login-link">
                <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
            </div>
        </form>
    </div>
@stop

@section('footer_scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#registerForm').submit(function(event) {

                // Kiểm tra mật khẩu và mật khẩu nhập lại
                var password = $('#password').val();
                var confirmPassword = $('#password_confirm').val();
                if (password !== confirmPassword) {
                    $('#passwordError').text('Mật khẩu nhập lại không trùng khớp');
                    return;
                } else {
                    $('#passwordError').text('');
                }

                // Gửi dữ liệu đăng ký qua Ajax
            });

            // Hiển thị/ẩn mật khẩu
            $('#togglePassword').click(function() {
                var passwordField = $('#password');
                var passwordFieldType = passwordField.attr('type');
                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    $(this).removeClass('fa-eye-slash').addClass('fa-eye');
                } else {
                    passwordField.attr('type', 'password');
                    $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                }
            });
        });
    </script>
@stop
