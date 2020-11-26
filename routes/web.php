<?php

use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Role;

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

Route::get('/', function () {
    return view('welcome');
});

//creating data
Route::get('/create', function () {
    $user = User::findOrFail(1);
    $role = Role::findOrFail(1);
    $user->roles()->save($role);
    return $user->name . " role: " . $role->name . " assigned successfully";
});

//reading data
Route::get('/read', function () {
    $user = User::findOrFail(1);
//    foreach ($user->roles as $role){
//        dd($role->name);
//    }
    echo $user->roles;
});

//updating data
Route::get('/update', function () {
    $user = User::findOrFail(1);
    if ($user->has('roles')) { //checking for relationship
        foreach ($user->roles as $role) {
            $role->name = "Editor";
            $role->save();
        }
    }
    return "role updated";
});

//deleting data
Route::get('/delete', function () {
    $user = User::findOrFail(1);
    foreach ($user->roles as $role) {
        $role->where('id', '2')->delete();
    }
    return "Role deleted successfully";
});
