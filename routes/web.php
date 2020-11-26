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

//attaching role to user
Route::get('/attach', function (){
    $user = User::findOrFail(1);
    $user->roles()->attach(2);
    return "Role attached to user";
});

//detaching roles from user
Route::get('/detach', function (){
    $user= User::findOrFail(1);
    $user->roles()->detach(2);
    //to detach all roles from a particular user     $user->roles()->detach();
    return "Role detached from user";
});

//syncing roles
Route::get('/sync', function (){
    $user= User::findOrFail(1);
    //can pass many roles in the array separated by "," => sync([1,3]);
    $user->roles()->sync([3]);
    return "role no with id 3 synced to user id 1";
});
