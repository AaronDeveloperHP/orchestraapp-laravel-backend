<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\StatusController;
use JasperPHP\JasperPHP as JasperPHP;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::prefix('requests')->group(function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/get', [RequestsController::class, 'index']);
        Route::post('/post', [RequestsController::class, 'store']);
        Route::put('/put/{id}', [RequestsController::class, 'update']);
        Route::get('/get/{id}', [RequestsController::class, 'show']);
        Route::get('/userData/{email}', [RequestsController::class, 'userData']);
        Route::delete('/delete/{id}', [RequestsController::class, 'destroy']);
    });
});

Route::prefix('data')->group(function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/get', [DataController::class, 'index']);
        Route::post('/post', [DataController::class, 'store']);
        Route::put('/put/{id}', [DataController::class, 'update']);
        Route::get('/get/{id}', [DataController::class, 'show']);
        Route::get('/userData/{email}', [DataController::class, 'userData']);
        Route::delete('/delete/{id}', [DataController::class, 'destroy']);
    });
});

Route::prefix('status')->group(function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/get', [StatusController::class, 'index']);
        Route::post('/post', [StatusController::class, 'store']);
        Route::put('/put/{id}', [StatusController::class, 'update']);
        Route::get('/get/{id}', [StatusController::class, 'show']);
        Route::get('/userData/{email}', [StatusController::class, 'userData']);
        Route::delete('/delete/{id}', [StatusController::class, 'destroy']);
    });
});

Route::prefix('auth')->group(function () {
    Route::get('/getTheme/{email}', 'AuthController@getTheme');
    Route::get('/postTheme/{email}', 'AuthController@postTheme');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
    Route::get('userData/{email}', 'AuthController@userData');
    Route::get('user', 'AuthController@user');
    Route::get('users', 'UserController@index');
    Route::get('users/{id}', 'UserController@show');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
    });
});

Route::get('requests/compilar', function () {
    // Crear el objeto JasperPHP
    $jasper = new JasperPHP;

    // Compilar el reporte para generar .jasper
    $jasper->compile(base_path() .
        '//public/Blank_Letter.jrxml')->execute();

    return view('welcome');
});

Route::get('requests/reporte', function () {
    // Crear el objeto JasperPHP
    $jasper = new JasperPHP;
    $headers = ['Content-Type' => 'application/pdf'];


    $filename = 'Blank_Letter';
    $output = base_path('//public/' . $filename);
    // Generar el Reporte
    $jasper->process(
        // Ruta y nombre de archivo de entrada del reporte
        base_path() .
            '//public/Blank_Letter.jasper',
        $output, // Ruta y nombre de archivo de salida del reporte (sin extensión)
        array('pdf', 'rtf'), // Formatos de salida del reporte
        array(),
        array(
            'driver' => 'mysql',
            'host' => 'eyw6324oty5fsovx.cbetxkdyhwsb.us-east-1.rds.amazonaws.com',
            'port' => '3306',
            'database' => 'zctjy7mirdo35xjg',
            'username' => 'oxoh5a184wpkmj5q',
            'password' => 'jlko5zp0rbnxa6do',
        ),
    )->execute();
    $pathToFile = public_path('/Blank_Letter.pdf');
    return response()->file($pathToFile);
});

Route::get('status/compilar', function () {
    // Crear el objeto JasperPHP
    $jasper = new JasperPHP;

    // Compilar el reporte para generar .jasper
    $jasper->compile(base_path() .
        '//public/Blank_Letter_2.jrxml')->execute();

    return view('welcome');
});

Route::get('status/reporte', function () {
    // Crear el objeto JasperPHP
    $jasper = new JasperPHP;
    $headers = ['Content-Type' => 'application/pdf'];


    $filename = 'Blank_Letter_2';
    $output = base_path('//public/' . $filename);
    // Generar el Reporte
    $jasper->process(
        // Ruta y nombre de archivo de entrada del reporte
        base_path() .
            '//public/Blank_Letter_2.jasper',
        $output, // Ruta y nombre de archivo de salida del reporte (sin extensión)
        array('pdf', 'rtf'), // Formatos de salida del reporte
        array(),
        array(
            'driver' => 'mysql',
            'host' => 'eyw6324oty5fsovx.cbetxkdyhwsb.us-east-1.rds.amazonaws.com',
            'port' => '3306',
            'database' => 'zctjy7mirdo35xjg',
            'username' => 'oxoh5a184wpkmj5q',
            'password' => 'jlko5zp0rbnxa6do',
        ),
    )->execute();
    $pathToFile = public_path('/Blank_Letter_2.pdf');
    return response()->file($pathToFile);
});

Route::get('data/compilar', function () {
    // Crear el objeto JasperPHP
    $jasper = new JasperPHP;

    // Compilar el reporte para generar .jasper
    $jasper->compile(base_path() .
        '//public/orquestadatos.jrxml')->execute();

    return view('welcome');
});

Route::get('data/reporte', function () {
    // Crear el objeto JasperPHP
    $jasper = new JasperPHP;
    $headers = ['Content-Type' => 'application/pdf'];


    $filename = 'orquestadatos';
    $output = base_path('//public/' . $filename);
    // Generar el Reporte
    $jasper->process(
        // Ruta y nombre de archivo de entrada del reporte
        base_path() .
            '//public/orquestadatos.jasper',
        $output, // Ruta y nombre de archivo de salida del reporte (sin extensión)
        array('pdf', 'rtf'), // Formatos de salida del reporte
        array(),
        array(
            'driver' => 'mysql',
            'host' => 'eyw6324oty5fsovx.cbetxkdyhwsb.us-east-1.rds.amazonaws.com',
            'port' => '3306',
            'database' => 'zctjy7mirdo35xjg',
            'username' => 'oxoh5a184wpkmj5q',
            'password' => 'jlko5zp0rbnxa6do',
        ),
    )->execute();
    $pathToFile = public_path('/orquestadatos.pdf');
    return response()->file($pathToFile);
});
