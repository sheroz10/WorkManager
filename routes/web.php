<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Models\Assignment;
use App\Models\Category;

Route::get('/', function () {
    if (Auth::check()) {
        $assignments = Assignment::where('user_id', Auth::id())->latest()->get();
        $categories = Category::all();
        return view('welcome', compact('assignments', 'categories'));
    }

    // If not logged in, pass empty collections so Blade doesn't break
    return view('welcome', [
        'assignments' => collect(),
        'categories' => collect()
    ]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Assignment routes
Route::middleware(['auth'])->group(function () {
    Route::resource('assignments', AssignmentController::class);
    Route::resource('categories', CategoryController::class);
    // Route::post('/notifications/{id}/read', function($id) {
    //     $notification = Auth::user()->notifications()->findOrFail($id);
    //     $notification->markAsRead();
    //     return back();
    // })->name('markNotificationRead');
});
