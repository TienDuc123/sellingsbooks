@extends('admin.default')

@section('title')
    Trang chủ
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

        #myTable {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #myTable th,
        #myTable td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #myTable th {
            background-color: #f2f2f2;
            color: #333;
        }

        #myTable .btn {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 2px;
            cursor: pointer;
        }

        #myTable .btn-danger {
            background-color: #dc3545;
        }

        #myTable .btn-warning {
            background-color: #ffc107;
        }


    </style>
@stop

@section('content')
    <!-- Nội dung trang -->
    <div class="container login-container">
        @if (Auth::check())
            <a href="{{ route('store') }}" class="btn btn-danger">Thêm sản phẩm</a>
            <a href="{{ route('list_order') }}" class="btn btn-success">Danh sách đơn hàng</a>
        @endif
        <table id="myTable">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sách</th>
                    <th>Tác giả</th>
                    <th>Giá</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_books as $item)
                    <tr>
                        <td><img src="{{ asset($item->URL) }}" alt="" width="10%"></td>
                        <td>{{ $item['TenSach'] }}</td>
                        <td>{{ $item['TacGia'] }}</td>
                        <td>{{ $item['Gia'] }}</td>
                        <td>
                            @if (Auth::check())
                                <a href="{{ route('delete', ['id' => $item['id']]) }}" class="btn btn-danger">Xóa</a>
                            @endif
                            @if (Auth::check())
                                <a href="{{ route('edit', ['id' => $item['id']]) }}" class="btn btn-warning">Chỉnh sửa</a>
                            @endif
                            <a href="{{ route('detail', ['id' => $item['id']]) }}" class="btn btn-warning">Xem chi tiết</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@stop

@section('footer_scripts')
    <!-- Thêm các tài nguyên JavaScript của bạn tại đây -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable({
                searching: true, // Cho phép tìm kiếm
                paging: true, // Cho phép phân trang
                ordering: true, // Cho phép sắp xếp
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                dom: 'lBfrtip', // B for buttons, l for length changing input control
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'] // Thêm các nút
            });
        });
    </script>
@stop
