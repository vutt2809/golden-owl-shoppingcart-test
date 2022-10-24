<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    function findShoeById($shoeId) {
        $shoes = config('shoes');

        foreach($shoes as $shoe) {
            if ($shoe['id'] == $shoeId) 
            return $shoe;
        }
    }

    function checkShoeInCart() {
        $shoes = config('shoes');
        $cart = Session::get('cart');

        foreach ($shoes as &$shoe) {
            foreach ($cart as $key => $cartItem) {
                if ($key == $shoe['id']) {
                    $shoe['incart'] = true;
                }
            }
        }

        return $shoes;
    }

    public function index() {
        $cart = Session::get('cart');
        $total = 0;
        $shoes = config('shoes');

        if (isset($cart)) {
            $shoes = $this->checkShoeInCart();
            foreach ($cart as $key => $cartItem) {
                $total += (float)$cartItem['price'] * (int)$cartItem['quantity'];
            }
        }

        return view('app', [
            'shoes' => $shoes,
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function addToCart($shoeId) {
        $shoe = $this->findShoeById($shoeId);

        $cart = Session::get('cart');

        $cart[$shoeId] = [
            "image" => $shoe['image'],
            "name"  => $shoe['name'],
            "description"  => $shoe['description'],
            "price" => $shoe['price'],
            "color" => $shoe['color'],
            "quantity"  => 1,
        ];

        Session::put('cart', $cart);
        return redirect()->route('home');
    }

    public function removeFromCart($shoeId) {
        $cart = Session::get('cart');

        foreach ($cart as $key => $cartItem) {
            if ($key == $shoeId) {
                unset($cart[$key]);
            }
        }        

        Session::put('cart', $cart);
        return redirect()->route('home');
    }

    public function increaseQuantity($shoeId) {
        $cart = Session::get('cart');

        foreach ($cart as $key => &$cartItem) {
            if ($key == $shoeId) {
                $cartItem['quantity'] += 1;
            }
        }

        Session::put('cart', $cart);
        return redirect()->route('home');
    }

    public function decreaseQuantity($shoeId) {
        $cart = Session::get('cart');

        foreach ($cart as $key => &$cartItem) {
            if ($key == $shoeId) {
                $cartItem['quantity'] -= 1;

                if ($cartItem['quantity'] == 0) {
                    unset($cart[$key]);
                }
            }
        }

        Session::put('cart', $cart);
        return redirect()->route('home');
    }
}
