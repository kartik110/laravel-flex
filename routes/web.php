<?php

use App\Http\Controllers\{HomeController, StudentAuthController, StudentsController, TeacherAuthController, TeacherController};
use Illuminate\Support\Facades\{Auth, Route};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// dd(Auth::guard('teacher')->check());
// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('student')->group(function () {
    Route::get('/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [StudentAuthController::class, 'login'])->name('studentLogin');
    Route::get('/register', [StudentAuthController::class, 'index'])->name('student.register');
    Route::post('/register', [StudentAuthController::class, 'register'])->name('studentRegister');
    Route::post('/logout', [StudentAuthController::class, 'logout'])->name('stulogout');
    // Route::get('/home', [StudentsController::class, 'index'])->name('stuhome');
});

Route::prefix('teacher')->group(function () {
    Route::get('/login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.login');
    Route::post('/login', [TeacherAuthController::class, 'login'])->name('teacherLogin');
    Route::get('/register', [TeacherAuthController::class, 'index'])->name('teacher.register');
    Route::post('/register', [TeacherAuthController::class, 'register'])->name('teacherRegister');
    Route::post('/logout', [TeacherAuthController::class, 'logout'])->name('tealogout');
    // Route::get('/home', [TeacherController::class, 'index'])->name('teahome');
});
Route::post('/changeclass', [HomeController::class, 'changeClass'])->name('changeclass');



