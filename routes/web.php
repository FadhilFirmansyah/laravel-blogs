<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardBlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [BlogController::class, "home"]);
Route::get("/about", [BlogController::class, "about"]);
Route::get("/blogs", [BlogController::class, "blog"]);
Route::get("/blogs/{slugContent:slug}", [BlogController::class, "content"]);
Route::get("/categories", [BlogController::class, "categories"]);

Route::get("/login", [LoginController::class, "index"])->name("login")->middleware("guest");
Route::post("/login", [LoginController::class, "authenticate"]);
Route::get("/register", [RegisterController::class, "index"])->middleware("guest");
Route::post("register", [RegisterController::class, "store"]);
Route::post("/logout", [LoginController::class, "logout"]);
Route::get("/dashboard", function(){
    return view("dashboard.index");
})->middleware("auth");

Route::get("/dashboard/blog/checkSlug", [DashboardBlogController::class, "checkSlug"])->middleware("auth");
Route::resource("/dashboard/blog", DashboardBlogController::class)->middleware("auth");