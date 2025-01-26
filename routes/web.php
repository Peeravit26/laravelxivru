<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Livewire\Counter;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    // return view('welcome');
    return view('active/index');
});

Route::get('/teacher', function () {
    return view('teacher');
})->name('teacher');

Route::get('/student', function () {
    return view('student');
})->name('student');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/active/index', function () {
    return view('active/index');
})->name('index');

Route::get('/coronavirus', function () {
    $reports = [
        (object) ["country" => "Thailand", "date" => "2020-04-19", "total" => "2765", "active" => "790", "death" => "47", "recovered" => "1928"],
        (object) ["country" => "Thailand", "date" => "2020-04-18", "total" => "2733", "active" => "899", "death" => "47", "recovered" => "1787"],
        (object) ["country" => "Thailand", "date" => "2020-04-17", "total" => "2700", "active" => "964", "death" => "47", "recovered" => "1689"],
        (object) ["country" => "Thailand", "date" => "2020-04-16", "total" => "2672", "active" => "1033", "death" => "46", "recovered" => "1593"],
        (object) ["country" => "Thailand", "date" => "2020-04-15", "total" => "2643", "active" => "1103", "death" => "43", "recovered" => "1497"],
    ];
    return view("coronavirus", compact("reports"));
})->name('coronavirus');

Route::get('/active/teacher', function () {
    $teachers = json_decode(file_get_contents('https://raw.githubusercontent.com/arc6828/laravel8/main/public/json/teachers.json'));
    return view("active.teacher", compact("teachers"));
})->name('active.teacher');

// Route::get('/category/sport', function () {
//     return "<h1>This is sport Category Page</h1>";
// });
// Route::get('/category/politic', function () {
//     return "<h1>This is politic Category Page</h1>";
// });
// Route::get('/category/entertain', function () {
//     return "<h1>This is entertain Category Page</h1>";
// });
// Route::get('/category/auto', function () {
//     return "<h1>This is auto Category Page</h1>";
// });

Route::get('/category/sport', [CategoryController::class, "sport"]);
Route::get('/category/politic', [CategoryController::class, "politic"]);
Route::get('/category/entertain', [CategoryController::class, "entertain"]);
Route::get('/category/auto', [CategoryController::class, "auto"]);



Route::get('/dashboard', function () {
    // return view('dashboard');
    return view('myauth.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::resource('license', LicenseController::class);
Route::resource('user', UserController::class);
Route::resource('vehicle', VehicleController::class);

Route::resource('movie', MovieController::class);

Route::get('movie-filter', [MovieController::class, 'indexFilter']);



// Route::resource('leave-request', LeaveRequestController::class);
Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin,guest'])->group(function () {
        Route::resource('leave-request', LeaveRequestController::class)->except(['edit', 'update']);
    });
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('leave-request', LeaveRequestController::class)->only(['edit', 'update']);
        Route::get("dashboard-leave", function () {
            return view("dashboard-leave");
        });
    });
});

// use App\Models\Product;
// use Illuminate\Support\Facades\DB;

Route::get('query/sql', function () {
    $products = DB::select("SELECT * FROM products");
    // $products = DB::select("SELECT * FROM products WHERE price > 100");
    return view('query-test', compact('products'));
});
Route::get('query/builder', function () {
    $products = DB::table('products')->get();
    // $products = DB::table('products')->where('price', '>', 100)->get();
    return view('query-test', compact('products'));
});
Route::get('query/orm', function () {
    $products = Product::get();
    // $products = Product::where('price', '>', 100)->get();
    return view('query-test', compact('products'));
});

Route::get('barchart', function () {    
    return view('barchart');
});






Route::get('form', function () {    
    return view('form');
});
Route::get('/form-submit', function (Request $request) {    
    // DO SOMETHING
    $data = $request->all();
    return "Name: " . $data['name'];
})->name('form.submit');

Route::get('product-index', function () {
    $products = Product::get();
    return view('query-test', compact('products'));
})->name("product.index");
Route::get('product-form', function () {    
    return view('product-form');
})->name("product.form");
Route::post('/product-submit', function (Request $request) {    
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ], [
        'name.required' => 'กรุณากรอกชื่อสินค้า',
        'description.required' => 'กรุณากรอกรายละเอียดสินค้า',
        'price.required' => 'กรุณากรอกราคา',
        'price.numeric' => 'ราคาต้องเป็นตัวเลข',
        'image.image' => 'ไฟล์ต้องเป็นรูปภาพ',
    ]);    

    // ตรวจสอบว่ามีการอัปโหลดรูปภาพ
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        $url = Storage::url($imagePath);
        $data["image"] =$url;
    }

    // บันทึกข้อมูลในฐานข้อมูล
    Product::create($data);

    return redirect()->route('product.index')->with('success', 'เพิ่มสินค้าเรียบร้อยแล้ว!');
})->name('product.submit');

Route::get('/product-submit', function (Request $request) {    
    // DO SOMETHING
    $data = $request->all();
    return "Name: " . $data['name'];
})->name('product.submit');



//project

Route::get('procase-form', function () {    
    return view('procase-form');
})->name("procase.form");
Route::post('/procase-submit', function (Request $request) {    
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ], [
        'name.required' => 'กรุณากรอกชื่อ นามสกุล',
        'description.required' => 'กรุณากรอกรายละเอียดที่อยู่',
        'price.required' => 'กรุณากรอกอายุ',
        'price.numeric' => 'อายุต้องเป็นตัวเลข',
        'image.image' => 'ไฟล์ต้องเป็นรูปภาพ',
    ]);
    
    // ตรวจสอบว่ามีการอัปโหลดรูปภาพ
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        $url = Storage::url($imagePath);
        $data["image"] =$url;
    }

    // บันทึกข้อมูลในฐานข้อมูล
    Product::create($data);

    return redirect()->route('product.index')->with('success', 'เพิ่มสินค้าเรียบร้อยแล้ว!');
})->name('procase.submit');