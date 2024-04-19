@extends('admin.default')

@section('title')
    Test
    @parent
@stop

@section('header_styles')
    @parent
    <style>
        body {
            background-color: #f0f2f5; /* Màu nền tương tự với Facebook */
            font-family: Arial, sans-serif; /* Font chữ tương tự Facebook */
        }

        .login-container {
            margin-top: 100px; /* Dời form lên trên */
            /* max-width: 400px; Đặt độ rộng tối đa cho form */
            padding: 0 20px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: #1877f2; /* Màu chữ cho tiêu đề */
        }

        .login-form {
            background-color: #fff; /* Màu nền form */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng đổ */
        }

        .login-form label {
            font-weight: bold;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 12px 40px 12px 20px; /* Thêm khoảng trống bên phải để icon mắt không bị che */
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ddd; /* Viền input */
            border-radius: 4px;
            box-sizing: border-box;
        }

        .login-form input[type="checkbox"] {
            margin-top: 10px;
        }

        .login-form button {
            width: 100%;
            background-color: #1877f2; /* Màu nút */
            color: #fff; /* Màu chữ nút */
            padding: 14px 20px;
            margin: 20px 0 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-form button:hover {
            background-color: #0e63b1; /* Màu nền khi hover */
        }

        .register-link {
            text-align: center;
        }

        .register-link a {
            color: #1877f2; /* Màu chữ liên kết */
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* CSS cho icon mật khẩu */
        .password-toggle {
            position: absolute;
            top: 53%;
            right: 45px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .css_mid{
            display: flex;
            justify-content: center;
        }
    </style>
@stop

@section('content')
    <!-- Nội dung trang -->
    <div class="container login-container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center css_mid">
            <div class="col-md-6">
                <div class="login-form">
                    <div class="login-header">
                        <h2>Đăng nhập</h2>
                    </div>
                    <form method="POST" action="{{ route('check_login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="username">Tài khoản</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter email or phone">
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter password">
                            <i class="fa fa-eye password-toggle" id="togglePassword"></i> <!-- Icon mật khẩu -->
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                                <label class="form-check-label" for="remember_me">Nhớ mật khẩu</label>
                            </div>
                        </div>
                        <button type="submit" class="btn">Login</button>
                    </form>
                    <div class="register-link">
                        <p>Chưa có tài khoản? <a href="{{route("signup")}}">Đăng ký</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer_scripts')
    @parent
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var togglePassword = document.getElementById('togglePassword');
            var password = document.getElementById('password');

            togglePassword.addEventListener('click', function () {
                var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
@stop
