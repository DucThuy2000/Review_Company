<?php

Route::prefix("auth")->name("auth.")->group(function (){
    $controllerName = "AuthController@";
    Route::get('login', $controllerName . "login")->name("login");
    Route::post('authenticate', $controllerName ."authenticate")->name("authenticate");
    Route::get('logout', $controllerName . "logout")->name("logout");
});

Route::namespace("Admin")->prefix("admin")->middleware('auth')->name("admin.")->group(function (){
    /*----------- User -----------*/
    $prefix = "user";
    $controller = "user";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".update")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".update")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });

    /*----------- Role -----------*/
    $prefix = "role";
    $controller = "role";
    Route::prefix($prefix)->name($controller . ".")->group(function () use($controller){
        $controllerName = ucfirst($controller) . "Controller@";
        Route::get("/", $controllerName . "index")->middleware("can:" . $controller . ".index")->name("index");
        Route::get("create", $controllerName . "create")->middleware("can:" . $controller . ".create")->name("create");
        Route::post("store", $controllerName . "store")->middleware("can:" . $controller . ".create")->name("store");
        Route::get("edit/{id}", $controllerName . "edit")->middleware("can:" . $controller . ".update")->name("edit");
        Route::post("update/{id}", $controllerName . "update")->middleware("can:" . $controller . ".update")->name("update");
        Route::get("delete/{id}", $controllerName . "delete")->middleware("can:" . $controller . ".delete")->name("delete");
    });
});
