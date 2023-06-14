<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\userController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\CalenderController;
use Illuminate\Support\Facades\Route;
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
    if($user = Auth::user()){
       return redirect()->route("dashboard");
    }else{
        return view('Auth.login');
    }
});
Route::controller(dashboardController::class)->group(function(){
    Route::get('/dashboard','index')->name("dashboard")->middleware("auth");
})->middleware("auth");



Route::controller(userController::class)->group(function(){

    Route::get('/login', 'index')->name("login");
    Route::get('/logout', 'logout')->name("logout");
    Route::post("/authenticate","Authentication")->name("authenticate");
    Route::get("/profile/{id}","user_profile")->name("profile");
    Route::post("/edit_user_picture","upload_picture")->name("upload_picture");
    Route::post("/edit_user","updateUser")->name("edit_user");
    Route::post("/edit_password","editPassword")->name("user.edit_password");
    Route::get('/register', function(){
        return view("Auth.register");
    })->name("register");
    Route::post("/register","register")->name("register");
    

})->middleware("auth");

Route::controller(ChatController::class)->group(function(){
    Route::get("/chat","index")->name("chat");
    Route::post("/chat/send","store")->name("chat.send");
    Route::post("/chat/get","index")->name("chat.get");
})->middleware("auth");

Route::controller(projectController::class)->group(function(){
    
    // Route Get Method For Proejct
    Route::get("/projects","index")->name("projects");
    Route::get("/myproject","MyProject")->name("my_project");
    Route::get("/projects/invite/{projectCode}","invite")->name("invite");
    Route::get("/project/open/{id}","project_detail")->name("project.detail");

    // Route Get Project
    Route::post("project/join","join")->name("join");
    Route::post("/projects","store")->name("store_project");

})->middleware("auth");

Route::controller(PostinganController::class)->group(function(){
    Route::post("project/post/create","store")->name("post.create");
    Route::get("project/post/delete/{id}","destroy")->name("post.delete");
})->middleware("auth");

// upload dan hapus file yang dilampirkan
Route::controller(FileController::class)->group(function(){
    Route::post("project/post/upload_file","uploadFile")->name("upload_files");
    Route::post("project/post/delete_file","deleteFile")->name("deleteFiles"); 
    Route::get("project/post/download/{file}","download")->name("downloadFile");
})->middleware("auth");

Route::controller(ProjectTaskController::class)->group(function(){
    Route::post("project_task/create","store")->name("task.create");
    Route::post("project_task/get","index")->name("task.get");
    Route::post("project_task/delete","destroy")->name("task.delete");
    Route::post("project_task/check","check")->name("task.check");


    Route::post("project_task/all","getByProjectId")->name("task.getAll");

});


Route::get('calendar-event', [CalenderController::class, 'index'])->name('calendar-event');
Route::post('calendar-crud-ajax', [CalenderController::class, 'calendarEvents']);