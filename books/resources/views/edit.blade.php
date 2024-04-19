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
    </style>
@stop

@section('content')
    <!-- Nội dung trang -->
    <div class="container mt-5">
        <h2 class="mb-4">Thêm Sản Phẩm</h2>
        <form method="POST" action="{{ route('update', ['id' => $books['id']]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="productName">Tên Sách:</label>
                <input type="text" class="form-control" id="productName" value="{{$books["TenSach"]}}" name="productName" placeholder="Nhập tên sách">
            </div>
            <div class="form-group">
                <label for="author">Tác Giả:</label>
                <input type="text" class="form-control" id="author" value="{{$books["TacGia"]}}" name="author" placeholder="Nhập tên tác giả">
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" class="form-control" id="price" value="{{$books["Gia"]}}" name="price" placeholder="Nhập giá sách">
            </div>
            <div class="form-group">
                <label for="quantity">Số Lượng:</label>
                <input type="number" class="form-control" id="quantity" value="{{$books["SoLuongTrongKho"]}}" name="quantity" placeholder="Nhập số lượng sách">
            </div>
            <div class="form-group">
                <label for="description">Mô Tả:</label>
                <textarea class="form-control" id="description" rows="3" name="description" placeholder="Nhập mô tả sách">{{$books["MoTa"]}}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Ảnh Sách:</label>
                <input type="file" class="form-control-file" name="image" id="image" onchange="previewImage()">
                <div id="display_image">
                    <img src="{{asset(isset($books["URL"]) ? $books["URL"] : '' )}}" width="100px" alt="">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
@stop

@section('footer_scripts')
    <!-- Thêm các tài nguyên JavaScript của bạn tại đây -->
    <script type="text/javascript">
        function previewImage() {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#display_image').html('<img width="100px" src="' + e.target.result + '" class="img-fluid mt-2" style="max-width: 200px;">');
            }
            reader.readAsDataURL($('#image')[0].files[0]);
        }
    </script>
@stop
