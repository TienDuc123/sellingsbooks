<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class BooksController extends Controller
{
    protected $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;

        // view()->share('hasEditorRole', $hasEditorRole);
    }

    public function index(){
        // $user = Auth::user();
        // $hasEditorRole = $user ? $user->roles->contains('name', 'User') : false;
        $list_books = $this->bookService->getAllBook();
        return view("index", compact('list_books'));
    }

    public function store(){

        return view("store");
    }
    public function create(Request $req){
         // Kiểm tra xem file đã được tải lên chưa
        if ($req->hasFile('image')) {
            // Lấy file từ request
            $file = $req->file('image');

            // Tạo tên file mới dựa trên timestamp để tránh trùng lặp
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Di chuyển file vào thư mục public/upload
            $file->move(public_path('upload'), $fileName);

            // Tạo đường dẫn tương đối của file đã lưu
            $url = '/upload/' . $fileName;

        } else {
            // Nếu không có file, đặt đường dẫn là null hoặc giá trị mặc định
            $url = null; // hoặc $url = 'default.jpg';

        }
        $data = [
            "TenSach" => $req->productName,
            "TacGia" => $req->author,
            "Gia" => $req->price,
            "SoLuongTrongKho" => $req->quantity,
            "MoTa" => $req->description,
            "URL" => $url,
        ];
        $books = $this->bookService->createBook($data);
        return redirect()->route("index");
    }

    public function delete(Request $req){
        $this->bookService->deleteBook($req->id);
        return back();
    }

    public function edit(Request $req){
        $books = $this->bookService->getBookById($req->id);
        return view("edit",compact('books'));
    }

    public function update(Request $req){
        $data = [
            "TenSach" => $req->productName,
            "TacGia" => $req->author,
            "Gia" => $req->price,
            "SoLuongTrongKho" => $req->quantity,
            "MoTa" => $req->description,
        ];
        if ($req->hasFile('image')) {
            // Lấy file từ request
            $file = $req->file('image');

            // Tạo tên file mới dựa trên timestamp để tránh trùng lặp
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Di chuyển file vào thư mục public/upload
            $file->move(public_path('upload'), $fileName);

            // Tạo đường dẫn tương đối của file đã lưu
            $url = '/upload/' . $fileName;
            $data['URL'] = $url;
        }

        $books = $this->bookService->updateBook($req->id,$data);
        return redirect()->route("index");
    }

    public function detail(Request $req){
        $book = $this->bookService->getBookById($req->id);
        $comment = Comment::all();
        return view("detail",compact("book","comment"));
    }

    public function addtocart(Request $req){
         // Lấy ID của sản phẩm được gửi từ client side
        $productId = $req->input('productId');
        // Giả sử bạn lưu thông tin giỏ hàng trong session, bạn có thể thực hiện các bước sau:

        // Kiểm tra xem session giỏ hàng đã được tạo chưa
        if (!$req->session()->has('cart')) {
            // Nếu chưa, tạo một giỏ hàng mới
            $req->session()->put('cart', []);
        }

        // Lấy thông tin giỏ hàng từ session
        $cart = $req->session()->get('cart');

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if (isset($cart[$productId])) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên 1
            $cart[$productId]['quantity'] += 1;
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng với số lượng là 1
            $cart[$productId] = [
                'quantity' => 1,
                // Thêm thông tin khác của sản phẩm vào đây nếu cần
            ];
        }

        // Lưu lại thông tin giỏ hàng vào session
        $req->session()->put('cart', $cart);

        // Tính toán số lượng sản phẩm trong giỏ hàng
        $cartCount = array_sum(array_column($cart, 'quantity'));

        // Trả về kết quả là số lượng sản phẩm trong giỏ hàng dưới dạng JSON
        return response()->json(['cartCount' => $cartCount]);
    }

    public function displaytocar(Request $req){
        // Lấy thông tin giỏ hàng từ session
        $cart = $req->session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
        // Trả về thông tin giỏ hàng dưới dạng JSON
        return response()->json(['cartCount' => $cartCount]);
    }

    public function login(Post $post){
        // $userId = Auth::id();
        // dd($userId);
        // $this->authorize('view', $post);
        return view("login");
    }

    public function check_login(Request $req){
        // Xác thực thông tin đăng nhập
        if (Auth::attempt(['email' => $req->username, 'password' => $req->password])) {
            // Đăng nhập thành công, lưu thông tin người dùng vào session
            // $req->session()->regenerate();

            // Thực hiện chuyển hướng sau khi đăng nhập thành công
            return redirect()->route('index');
        }else{
            return redirect()->back()->with(["error" => "Mật khẩu không đúng"]);
        }
    }

    public function cart(){

        $cart = session()->get('cart');
        $books = "";
        $bookQuantities = "";
        if ($cart && is_array($cart)) {
            $bookIds = array_keys($cart);
            $books = DB::table('books')->whereIn("id", $bookIds)->get();
            $bookQuantities = [];
            foreach ($cart as $key => $val) {
                $bookQuantities[$key] = $val;
            }
            return view("cart", compact('books','bookQuantities'));
        } else {
            // Xử lý trường hợp không có dữ liệu trong session cart
            // Ví dụ: hiển thị thông báo rằng giỏ hàng trống
            return view("cart", compact('books','bookQuantities'));
        }
    }

    public function changetocart(Request $req){
          // Lấy ID của sản phẩm được gửi từ client side
          $productId = $req->input('productId');
          // Giả sử bạn lưu thông tin giỏ hàng trong session, bạn có thể thực hiện các bước sau:

          // Kiểm tra xem session giỏ hàng đã được tạo chưa
          if (!$req->session()->has('cart')) {
              // Nếu chưa, tạo một giỏ hàng mới
              $req->session()->put('cart', []);
          }

          // Lấy thông tin giỏ hàng từ session
          $cart = $req->session()->get('cart');

          // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
          if (isset($cart[$productId])) {
              // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên 1
              if($req->sum == "zero"){
                  if($req->check == 1){
                    $cart[$productId]['quantity'] -= 1;
                  }else{
                    $cart[$productId]['quantity'] += 1;
                  }
              }else{
                $cart[$productId]['quantity'] = $req->sum;
              }
          } else {
              // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng với số lượng là 1
              $cart[$productId] = [
                  'quantity' => 1,
                  // Thêm thông tin khác của sản phẩm vào đây nếu cần
              ];
          }

          // Lưu lại thông tin giỏ hàng vào session
          $req->session()->put('cart', $cart);

          // Tính toán số lượng sản phẩm trong giỏ hàng
          $cartCount = array_sum(array_column($cart, 'quantity'));

          if($req->check_all == 0){
              // Trả về kết quả là số lượng sản phẩm trong giỏ hàng dưới dạng JSON
              return response()->json(['cartCount' => $cart[$productId]['quantity']]);
          }else{
              return response()->json(['cartCount' => $cartCount]);
          }
    }

    public function check_oder(Request $req){
        $cart = session()->get('cart');
        $books = "";
        $bookQuantities = "";
        if ($cart && is_array($cart)) {
            $bookIds = array_keys($cart);
            $books = DB::table('books')->whereIn("id", $bookIds)->get();
            $bookQuantities = [];
            foreach ($cart as $key => $val) {
                $bookQuantities[$key] = $val;
            }
            return response()->json(['books' => $books, 'cartCount' => $bookQuantities]);
            // return view("cart", compact('books','bookQuantities'));
        } else {
            // Xử lý trường hợp không có dữ liệu trong session cart
            // Ví dụ: hiển thị thông báo rằng giỏ hàng trống
            return response()->json(['books' => $books, 'cartCount' => $bookQuantities]);
        }
    }
    public function order(Request $req){
        $currentTime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $data_kh = [
            "Ten" => $req->fullname,
            "DiaChi" => $req->address,
            "Email" => $req->email,
            "SoDienThoai" => $req->phone,
            "ghi_chu" => $req->notes,
            "created_at" => $currentTime,
            "updated_at" => null,
        ];

        // Save Customer
        $customer_id = $this->bookService->createCustomer($data_kh);
        $data = json_decode($req->book);
        $cartCountArray = json_decode(json_encode($data->cartCount), true);
        foreach ($data->books as $book) {
            $price = $book->Gia * $cartCountArray[$book->id]['quantity'];
            $data_order = [
                "ID_Sach"  => $book->id,
                "ID_Kh"  => $customer_id,
                "SoLuong"  => $cartCountArray[$book->id]['quantity'],
                "Gia"  => $price,
                "trang_thai"  => 'danggiao',
                "created_at" => $currentTime,
                "updated_at" => null,
            ];
            $save_order = $this->bookService->createOder($data_order);

        }
        return redirect()->route("index");;
    }


    public function test(){
        $user = Auth::user();
        $hasEditorRole = $user->roles->contains('name', 'Editor');
        $list_books = $this->bookService->getAllBook();
        return view("test", compact('list_books','hasEditorRole'));
    }

    public function list_order(){
        $order = Order::all();
        $khachhang = $this->bookService->getAllCustomer();
        return view("list_order",compact('order'));
    }

    public function comment(Request $req){
        $currentTime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $data = [
            "id_book" => $req->id_book,
            "id_user" => $req->id_user,
            "comment" => $req->comment,
            "created_at" => $currentTime,
        ];
        $user = $this->bookService->getUserById($req->id_user);
        $comment = $this->bookService->createComment($data);

        return response()->json(['comment' => $comment, 'user' => $user]);
    }
    public function deletecomment(Request $req){
        $comment = $this->bookService->deletComment($req->id);
        return $req->id;
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function signup(){

        return view("signup");
    }

    public function check_signup(Request $req){
        $pass = bcrypt($req->password);
        $currentTime = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');
        $createUser = [
            "name" => $req->name,
            "email" => $req->email,
            "password" => $pass,
            "created_at" => $currentTime,
        ];
        $user = $this->bookService->createUser($createUser);
        $createRole = [
            "role_id"   => 3,
            "user_id"   => $user,
        ];
        $save_role = $this->bookService->createRoleUser($createRole);
        session()->flash('success', 'Đăng ký thành công!');
        return Redirect("login");
    }
}
