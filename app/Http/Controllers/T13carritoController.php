<?php

namespace App\Http\Controllers;

use App\Models\T04productos;
use App\Models\T12carritoItem;
use App\Models\T13carrito;
use Illuminate\Http\Request;

class T13carritoController extends Controller
{
    public function addToCart(Request $request) {

        // dd(request()->cookie('flordeazahar_session'));
        $productId = $request->get('t04id');
        $quantity = $request->get('quantity');

        $cart = $this->getOrCreateCart();
        // dd($cart, request()->cookie('flordeazahar_session'));

        $cartItem = T12carritoItem::select('t12id', 't12producto', 't12cantidad', 'p.t04id', 'p.t04nombre')
        ->leftJoin('t04productos as p', 'p.t04id', '=', 't12producto')
        ->where('t12producto', '=', $productId)
        ->where('t12id', '=', $cart->t13id)->get();

        // dd($cartItem);

        if (empty($cartItem)) {
            foreach ($cartItem as $item) {
                if($item->t12producto == $productId){
                    $item->t12cantidad += $quantity;
                    dump($item);
                    $item->update();
                }
            }
        } else {
            $product = T04productos::findOrFail($productId);
            $cartItem = new T12carritoItem([
                't12carrito' => $cart->t13id,
                't12producto' => $product->t04id,
                't12cantidad' => $quantity,
            ]);
            $cartItem->save();
        }

        return response()->json(['mensaje' => 'Producto entro al carrito']);

    }

    public function getCart()
    {
        $cart = $this->getOrCreateCart();

        $check = false;



        $cartItems = T12carritoItem::select('t12producto', 't12cantidad', 't12carrito', 'p.t04precio', 'p.t04id', 'p.t04nombre')
        ->leftJoin('t04productos as p', 'p.t04id', '=', 't12producto')
        ->where('t12carrito', '=', $cart->t13id)->get();

        $total = 0;
        foreach ($cartItems as $cartItem) {
            $check = true;

            $total += $cartItem->t04precio * $cartItem->t12cantidad;
        }

        return view('carrito', compact('cartItems', 'total', 'check'));
        // return response()->json([
        //     'cartItems' => $cartItems,
        //     'total' => $total
        // ]);
    }

    public function removeCartItem(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $cartItem = T12carritoItem::findOrFail($request->t12producto);
        // dd($cartItem);
        $cartItem->delete();

        return response()->json(['mensaje' => 'Elemento eliminado del carrito']);
    }

    private function getOrCreateCart()
    {
        if (auth()->user()) {
            $cart = T13carrito::where('t13cliente', auth()->user()->sys01id)->first();
        } else {
            $sessionId = request()->cookie('flordeazahar_session');
            $cart = T13carrito::where('t13sessionid', $sessionId)->first();
        }

        if (!$cart) {
            $cart = new T13carrito();
            if (auth()->user()) {
                $cart->t13cliente = auth()->user()->sys01id;
            } else {
                $cart->t13sessionid = request()->cookie('flordeazahar_session');
            }
            $cart->save();
        }

        return $cart;
    }

}
