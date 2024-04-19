@extends('admin.default')

@section('title')
    Test
    @parent
@stop

@section('header_styles')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            margin-top: 5%;
        }

        .login-container {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .table img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
        }

        /* Responsive CSS for small screens */
        @media (max-width: 768px) {

            .table td,
            .table th {
                padding: 8px;
                font-size: 14px;
            }

            .table img {
                max-width: 60px;
            }
        }
    </style>
@stop

@section('content')
    <!-- Nội dung trang -->
    <div class="container login-container">
        <div class="table-responsive">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ nhận hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                        <th>Ngày đặt hàng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $item)
                        <tr>
                            <td><img src="{{ asset($item->book->URL) }}" class="img-thumbnail" width="150px" alt="">
                            </td>
                            <td>{{ $item->customer->Ten }}</td>
                            <td>{{ $item->customer->DiaChi }}</td>
                            <td>{{ $item->customer->Email }}</td>
                            <td>{{ $item->customer->SoDienThoai }}</td>
                            <td>{{ $item->SoLuong }}</td>
                            <td>{{ $item->Gia }}</td>
                            <td>{{ $item->trang_thai }}</td>
                            <td>{{ $item->customer->ghi_chu }}</td>
                            <td>{{ $item->customer->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop

@section('footer_scripts')
    <!-- Thêm các tài nguyên JavaScript của bạn tại đây -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@stop
