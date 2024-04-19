@extends('admin.default')

@section('title')
    Test
    @parent
@stop

@section('header_styles')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .containes {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            /* Đặt chiều rộng tối đa */
            width: 100%;
            margin: auto;
            /* Căn giữa */
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }

        .illustration {
            width: 200px;
            margin-bottom: 30px;
        }

        .action-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .action-button:hover {
            background-color: #45a049;
        }
    </style>
@stop

@section('content')
    <!-- Nội dung trang -->
    @if ($books != '')
        <div class="container">
            @foreach ($books as $item)
                <div class="row book-item">
                    <div class="col-md-3">
                        <a href="#">
                            <img src="{{ asset($item->URL) }}" class="img-responsive" alt="{{ $item->TenSach }}">
                        </a>
                    </div>
                    <div class="col-md-6">
                        <h3 class="book-title">Giới thiệu: {{ $item->MoTa }}</h3>
                        <p><strong>Tên sách:</strong> {{ $item->TenSach }}</p>
                        <p><strong>Tác giả:</strong> {{ $item->TacGia }}</p>
                    </div>
                    <div class="col-md-3">
                        <p><strong
                                id="price_{{ $item->id }}">{{ $item->Gia * $bookQuantities[$item->id]['quantity'] }}đ</strong>
                        </p>
                        <div class="quantity">
                            <button class="btn btn-default btn-sm"
                                onclick="change({{ $item->id }}, {{ 1 }}, {{ 0 }}, {{ $item->Gia }})">-</button>
                            <input type="number" id="quantity_{{ $item->id }}"
                                onchange="select2({{ $item->id }}, {{ 1 }}, {{ 0 }}, {{ $item->Gia }})"
                                value="{{ $bookQuantities[$item->id]['quantity'] }}">
                            <button class="btn btn-default btn-sm"
                                onclick="change({{ $item->id }}, {{ 2 }}, {{ 0 }}, {{ $item->Gia }})">+</button>
                            <h2 style="color: red">Số lượng</h2>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="container">
            <h2>Thông tin khách hàng</h2>
            <form action="order" method="post" id="form_order">
                <input type="text" name="book" class="book_order" hidden>
                @csrf
                <div class="form-group">
                    <label for="fullname">Họ và Tên:</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>
                <div class="form-group">
                    <label for="phone">Điện Thoại:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Địa Chỉ Nhận Hàng:</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="notes">Lưu Ý/Yêu Cầu:</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                </div>
                <div class="form-group btn btn-danger" style="width: 100%" onclick="order_quantity()">
                    <p">Đặt Hàng</p>
                        <p>Hotline: 0815.208.208 (8h - 21h)</p>
                </div>

            </form>
        </div>
    @else
        <div class="containes">
            <img src="data:image/jpeg;base64,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" alt="Illustration" class="illustration">
            <h1>Không có đơn hàng nào</h1>
            <p>Hãy tiếp tục duyệt sách và đặt hàng để có trải nghiệm mua sắm tuyệt vời!</p>
            <button class="action-button" onclick="redirectToHome()">Quay lại trang chính</button>
        </div>

    @endif
@stop
@section('footer_scripts')
    <!-- Thêm các tài nguyên JavaScript của bạn tại đây -->
    <script type="text/javascript">
        function redirectToHome() {
            // Thay thế link dưới đây bằng đường dẫn của trang chính hoặc trang sản phẩm của bạn
            window.location.href = "{{route('index')}}";
        }

        function change(id, check, check_all, cost) {
            let sum = 'zero';
            // Gửi yêu cầu AJAX đến route '/add-to-cart'
            fetch('change-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                    },
                    body: JSON.stringify({
                        // Dữ liệu bạn muốn gửi đi (nếu cần)
                        productId: id,
                        check: check,
                        check_all: check_all,
                        sum: sum,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    $("#quantity_" + id).val(data.cartCount);
                    let quantity = $("#quantity_" + id).val();
                    price(cost, quantity, id);
                    check_order();
                    update_cart();
                    // Cập nhật số đơn hàng trong phần tử "#sodonhang"
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        }

        function select2(id, check, check_all, cost) {
            let sum = $("#quantity_" + id).val();
            // Gửi yêu cầu AJAX đến route '/add-to-cart'
            fetch('change-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token để bảo vệ ứng dụng Laravel của bạn
                    },
                    body: JSON.stringify({
                        // Dữ liệu bạn muốn gửi đi (nếu cần)
                        productId: id,
                        check: check,
                        check_all: check_all,
                        sum: sum,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    price(cost, sum, id);
                    check_order();
                    update_cart();
                    // $("#quantity_"+id).val(data.cartCount);
                    // Cập nhật số đơn hàng trong phần tử "#sodonhang"
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                });
        }

        function price(cost, quantity, id) {
            let sum_cost = cost * quantity;
            sum_cost += "đ";
            $("#price_" + id).html(sum_cost);
        }

        function order_quantity() {
            check_order().then(() => {
                $("#form_order").submit();
            }).catch((error) => {
                console.error('Lỗi khi kiểm tra đơn đặt hàng:', error);
            });
        }

        function check_order() {
            return new Promise((resolve, reject) => {
                fetch('check_oder', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            // Dữ liệu bạn muốn gửi đi (nếu cần)
                        })
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Kết quả không hợp lệ từ máy chủ');
                        }
                    })
                    .then(data => {
                        $('.book_order').val(JSON.stringify(data));
                        resolve(); // Giải quyết khi xử lý thành công
                    })
                    .catch(error => {
                        console.error('Lỗi khi gửi yêu cầu kiểm tra đơn đặt hàng:', error);
                        reject(error); // Bác bỏ nếu xử lý không thành công
                    });
            });
        }
    </script>
@stop
