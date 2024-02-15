<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Cart;

class Cart extends Component
{
    public function increaseQuantity($rowId)
    {
    	$product = Cart::get($rowId);
	$qty = $product->qty + 1;
	Cart::update($rowId,$qty);
    }

    public function decreaseQuantity($rowId)
    {
    	$product = Cart::get($rowId);
	$qty = $product->qty - 1;
	Cart::update($rowId,$qty);
    }

    public function render()
    {
        return view('components.cart');
    }
}
