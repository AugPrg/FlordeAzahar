<?php

use App\Models\User;
use App\Notifications\PedidosNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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



Route::get('/confirmadoco', function () {

    if(Auth::check()){
        // $user = User::FindOrFail(Auth::user()->sys01id);
        $userEmail = "no-replay@heladeriaflordeazahar.com";
        Notification::route('mail', $userEmail)->notify(new PedidosNotification);

        return redirect('/')->with('mensaje', 'Se ha pedido el carrito correctamente');
    }

    return redirect('/')->with('mensaje', 'Hubo un error al realizar el pedido');
});
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('test', 'App\Http\Controllers\HomeController@test');


Route::get('productos', 'App\Http\Controllers\ShowProductController@index');

Route::get('producto/{t04slug}', 'App\Http\Controllers\ShowProductController@show')->name('product.show');

Route::get('categorias', 'App\Http\Controllers\ShowCategoryController@index');

Route::get('categoria/{id}', 'App\Http\Controllers\ShowCategoryController@show')->name('category.show');

Route::get('blogs', 'App\Http\Controllers\ShowBlogController@index');

Route::get('blog/{id}', 'App\Http\Controllers\ShowBlogController@show')->name('blogs.show');


Route::get('tiendas', 'App\Http\Controllers\HomeController@tienda');

Route::get('contacto', 'App\Http\Controllers\HomeController@contacto');

Route::post('contacto', 'App\Http\Controllers\HomeController@contactoPost')->name('contact.submit');

Route::get('nosotros', 'App\Http\Controllers\HomeController@nosotros');

Route::get('buscar', 'App\Http\Controllers\HomeController@search')->name('buscar');

Route::get('monedero', 'App\Http\Controllers\T07monederoController@index');


Route::post('monedero', 'App\Http\Controllers\T07monederoController@store')->name('monedero.crear');

Route::get('combos', 'App\Http\Controllers\ShowCombosController@index');

Route::get('combos/{id}', 'App\Http\Controllers\ShowCombosController@show')->name('combos.show');

Route::get('agendar/{id}', 'App\Http\Controllers\HomeController@agendar')->name('agendar');

Route::post('agendarPost', 'App\Http\Controllers\HomeController@agendarPost')->name('agendar.post');

Route::get('combosAgendados', 'App\Http\Controllers\HomeController@combosAgendados')->name('combos.agendados');

Route::post('agregarPost', 'App\Http\Controllers\T13carritoController@addToCart')->name('cart.add');

Route::get('carrito', 'App\Http\Controllers\T13carritoController@getCart')->name('cart.get');

Route::post('carrito', 'App\Http\Controllers\T13carritoController@removeCartItem')->name('cart.delete');

Route::post('pago', 'App\Http\Controllers\T14pedidosController@pay')->name('pay.cart');

Route::post('confirmacion', 'App\Http\Controllers\T14pedidosController@payPost')->name('payPost.cart');

