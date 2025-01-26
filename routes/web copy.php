<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';