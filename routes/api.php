<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('test', function(Request $request){
    $request->validate([
        'name' => 'required|string|max:255'
    ]);

    $user = App\Models\User::create([
        'name' => $request->name,
        'email' => \Str::slug($request->name)."@example.com",
        'password' => bcrypt($request->name)
    ]);


    return $user;
});

Route::get('test', function(){
    return response ([
        'count' => App\Models\User::all()->count(),
         'status' => 200
         ]);
});
