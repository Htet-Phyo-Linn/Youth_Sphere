<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\AdminAuthCheckMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LessonsController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Middleware\CacheJsMiddleware;
use App\Http\Controllers\AuthenticatedUserController;
use App\Http\Middleware\RestrictPublicAccess;

// public routes
Route::view('/', 'welcome')->name('/');
Route::view('/contact', 'user.layouts.contact')->name('contact');

Route::get('/courses', [CoursesController::class, 'index'])->name('public.courses');
Route::get('/filter', [CoursesController::class, 'filter'])->name('courses.filter');


// no dashboard, using route to split admin and user
Route::get('/dashboard', function () {
})->middleware(['auth', 'verified', AdminAuthCheckMiddleware::class])->name('dashboard');

Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');


// Routes that require authentication and role checking
Route::middleware(['auth', 'verified', RoleMiddleware::class])->group(function () {

    Route::get('home', [AuthenticatedUserController::class, 'index'])->name('home');

    Route::prefix('admin')->group(function () {
        Route::get('dashboard', function () {
            return view('dashboard');
        })->name('admin.dashboard');

        Route::prefix('user')->group(function () {
            Route::get('list', [UserController::class, 'list'])->name('user.list');
            Route::post('create', [UserController::class, 'create'])->name('user.create');

            Route::post('edit', [UserController::class, 'edit'])->name('user.edit');
            Route::get('edit/{id}', [UserController::class, 'editPage'])->name('user.editPage');

            Route::get('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
        });

        Route::prefix('category')->group(function () {
            Route::get('list', [CategoriesController::class, 'list'])->name('category.list');
            Route::post('create', [CategoriesController::class, 'create'])->name('category.create');

            Route::post('edit', [CategoriesController::class, 'edit'])->name('category.edit');
            Route::get('edit/{id}', [CategoriesController::class, 'editPage'])->name('category.editPage');

            Route::get('delete/{id}', [CategoriesController::class, 'delete'])->name('category.delete');
        });

        Route::prefix('course')->group(function () {
            Route::get('list', [CoursesController::class, 'list'])->name('course.list');
            Route::post('create', [CoursesController::class, 'create'])->name('course.create');

            Route::post('edit', [CoursesController::class, 'edit'])->name('course.edit');
            Route::get('edit/{id}', [CoursesController::class, 'editPage'])->name('course.editPage');

            Route::get('delete/{id}', [CoursesController::class, 'delete'])->name('course.delete');
        });

        Route::prefix('lesson')->group(function () {
            Route::post('listUpdate', [LessonsController::class, 'listUpdate'])->name('lesson.listUpdate');
            Route::get('list/{id}', [LessonsController::class, 'list'])->name('lesson.list');
            Route::post('create', [LessonsController::class, 'create'])->name('lesson.create');

            Route::post('edit', [LessonsController::class, 'edit'])->name('lesson.edit');
            Route::get('edit/{id}', [LessonsController::class, 'editPage'])->name('lesson.editPage');

            Route::delete('delete/{id}', [LessonsController::class, 'delete'])->name('lesson.delete');
        });

        Route::prefix('enrollment')->group(function () {
            Route::get('list', [EnrollmentsController::class, 'list'])->name('enrollment.list');
            Route::post('create', [EnrollmentsController::class, 'create'])->name('enrollment.create');

            Route::post('edit', [EnrollmentsController::class, 'edit'])->name('enrollment.edit');
            Route::get('edit/{id}', [EnrollmentsController::class, 'editPage'])->name('enrollment.editPage');

            Route::get('delete/{id}', [EnrollmentsController::class, 'delete'])->name('enrollment.delete');
        });
    });

});

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::middleware(['auth', 'verified', RoleMiddleware::class])->group(function () {

//     Route::prefix('admin')->group(function () {
//         Route::get('/', function () {
//             return view('adminhome');
//         })->name('admin.home');

//         Route::get('/profile', function () {
//             return view('admin.profile');
//         })->name('admin.profile');

//         Route::get('/settings', function () {
//             return view('admin.settings');
//         })->name('admin.settings');
//     });

//     Route::prefix('instructor')->group(function () {
//         Route::get('/instructor', function () {
//             return view('instructorhome');
//         });
//     });

//     Route::prefix('user')->group(function () {
//         Route::get('/user', function () {
//             return view('userhome');
//         });
//     });
// });


Route::fallback(function () {
    return redirect()->route('dashboard'); // Redirect to dashboard for undefined routes
});
// Authentication routes provided by Laravel Breeze
require __DIR__ . '/auth.php';

