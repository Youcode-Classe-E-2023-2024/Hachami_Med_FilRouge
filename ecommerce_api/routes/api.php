<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AdminController;




Route::get("login", function(){
    return response()->json(['message'=>'Unauthenticated'],401);

})->name('login');



Route::post("register", [ApiController::class, "register"]);
Route::post("login", [ApiController::class, "login"]);
Route::post("admin_login", [ApiController::class, "adminlogin"]);



Route::group(["middleware" => ["auth:api"]], function(){



    Route::get("profile", [ApiController::class, "profile"]);
    Route::get("refresh", [ApiController::class, "refreshToken"]);
    Route::get("logout", [ApiController::class, "logout"]);
});


Route::group(["middleware" => ["auth:api"]], function(){

    Route::get("admin/users/latest", [AdminController::class, "getLastUsers"]);
    Route::get("admin/users/count", [AdminController::class, "getUsersCount"]);
    Route::get("admin/users", [AdminController::class, "listUsers"]);
    Route::get("admin/users/{id}", [AdminController::class, "getUser"]);
    Route::put("admin/users/update/{id}", [AdminController::class, "updateUser"]);
    Route::delete("admin/users/delete/{id}", [AdminController::class, "deleteUser"]);
});