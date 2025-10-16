<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function shop()
    {
        return view('shop');
    }

    public function viewCart(Request $request)
    {
        return view('cart');
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|string',
            'label' => 'required|string',
            'price' => 'required|integer|min:0',
            'qty' => 'required|integer|min:1',
        ]);

        $cart = $request->session()->get('cart', []);
        if (isset($cart[$data['id']])) {
            $cart[$data['id']]['qty'] += $data['qty'];
        } else {
            $cart[$data['id']] = [
                'label' => $data['label'],
                'price' => $data['price'],
                'qty' => $data['qty'],
            ];
        }
        $request->session()->put('cart', $cart);

        return redirect('/cart')->with('status', 'Item added to cart');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|string',
            'qty' => 'required|integer|min:1',
        ]);
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$data['id']])) {
            $cart[$data['id']]['qty'] = $data['qty'];
            $request->session()->put('cart', $cart);
        }
        return redirect('/cart');
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|string',
        ]);
        $cart = $request->session()->get('cart', []);
        unset($cart[$data['id']]);
        $request->session()->put('cart', $cart);
        return redirect('/cart');
    }

    // Fake Stripe checkout: we simulate success without external calls
    public function checkout(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/shop');
        }
        // In a real integration, create a PaymentIntent/Checkout Session here.
        // For demo, we just clear cart and show success.
        $request->session()->forget('cart');
        return view('checkout_success');
    }
}