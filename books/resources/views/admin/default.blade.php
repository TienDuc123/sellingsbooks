<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laravel')</title>
    <!-- Thêm các tài nguyên CSS của bạn tại đây -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @yield('header_styles')
    <style>
        .colo {
            color: white !important;
        }

        .colo:hover {
            color: blue !important;
        }

        /* CSS cho phần footer */
        .footer {
            background: linear-gradient(to right, #2980b9, #6dd5fa);
            padding: 50px 0;
            margin-top: 5rem;
        }

        .footer h2 {
            color: #333;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .footer p {
            color: #555;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .footer ul li {
            margin-bottom: 10px;
        }

        .footer ul li a {
            color: #555;
            font-size: 16px;
        }

        .footer ul li a:hover {
            color: #007bff;
        }

        /* CSS cho bản đồ Google Maps */
        #map {
            width: 100%;
            height: 200px;
            /* Độ cao của bản đồ */
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header class="navbar navbar-default navbar-fixed-top" style="background: #02bbff" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('index') }}"><strong><b class="colo">Trang chủ</b></strong></a></li>
                    @if (Auth::check())
                        <li><a href="{{ route('list_order') }}" class="colo">Đơn hàng</a></li>
                    @endif
                    <li><a href="{{ route('cart') }}" class="colo">Giỏ hàng</a></li>
                    @if($admin)
                        <li><a href="{{ route('store') }}" class="colo">Thêm sách</a></li>
                    @endif
                </ul>

                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <button type="submit" class="btn btn-default colo">Search</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    @if(!Auth::check())
                        <li><a href="{{route('login')}}" class="btn btn-default navbar-btn ">Đăng nhập</a></li>
                        <li><a href="{{route('signup')}}" class="btn btn-warning navbar-btn colo">Đăng ký</a></li>
                    @else
                        <li><a href="{{route("logout")}}" class="btn btn-danger navbar-btn colo">Đăng xuất</a></li>
                    @endif
                    <li>
                        <div style="display: flex;justify-content: center;align-items: center;height: 55px;">
                            <a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"
                                    style="color: red; font-size: 20px" id="sodonhang">0</i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>


    {{-- <div class="sidebar btn btn-warning" style="position: fixed; height: 75rem;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <!-- Thay thế phần biểu tượng SVG bằng hình ảnh hoặc biểu tượng khác -->
            <img src="your-logo.png" alt="Your Logo" width="40" height="32">
            <span class="fs-4">Sidebar</span>
        </a>
        <hr>
        <ul class="nav nav-pills nav-stacked mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                    <span class="glyphicon glyphicon-home"></span> Home
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <span class="glyphicon glyphicon-dashboard"></span> Dashboard
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <span class="glyphicon glyphicon-th"></span> Orders
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <span class="glyphicon glyphicon-list-alt"></span> Products
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <span class="glyphicon glyphicon-user"></span> Customers
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="dropdownUser1" data-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="" width="32" height="32"
                    class="img-circle me-2">
                <strong>mdo</strong>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li class="divider"></li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div> --}}
    <div class="" style="margin-top: 6rem">

    </div>

    <!-- Nội dung chính của trang -->
    @yield('content')
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Thông tin liên hệ</h2>
                    <p><strong>Email:</strong> contact@example.com</p>
                    <p><strong>Điện thoại:</strong> 0123 456 789</p>
                    <p><strong>Địa chỉ:</strong> Số 123, Đường ABC, Thành phố XYZ</p>
                </div>
                <div class="col-md-4">
                    <h2>Theo dõi chúng tôi</h2>
                    <ul class="list-unstyled">
                        <li><a href="#" target="_blank">Facebook</a></li>
                        <li><a href="#" target="_blank">Twitter</a></li>
                        <li><a href="#" target="_blank">Instagram</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h2>Bản đồ</h2>
                    <div id="map" style="height: 200px;"></div>
                    <!-- Replace the following iframe with your Google Maps embed code -->
                    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.331079522163!2d106.69742031431294!3d10.762075992329033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f08a5010aa7%3A0x72df9b9c9b98968f!2zS2jGsMahbmcgVGjDoG5o!5e0!3m2!1svi!2s!4v1586995846280!5m2!1svi!2s" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Thêm các tài nguyên JavaScript của bạn tại đây -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <script type="text/javascript">
        function initMap() {
            var mapOptions = {
                center: {
                    lat: 10.762076,
                    lng: 106.697420
                },
                zoom: 16
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        }
        function update_cart(){
            // Gửi yêu cầu AJAX đến route '/add-to-cart'
            fetch('display-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                    },
                    body: JSON.stringify({
                        // Dữ liệu bạn muốn gửi đi (nếu cần)
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // console.log(data.cartCount)
                    // Cập nhật số đơn hàng trong phần tử "#sodonhang"
                    $("#sodonhang").html(data.cartCount);
                    // document.getElementById('sodonhang').innerText = data.cartCount;
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        }
        $(function() {
            update_cart();
        });
    </script>
    @yield('footer_scripts')
</body>

</html>
