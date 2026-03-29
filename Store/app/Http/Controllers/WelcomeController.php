<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Store;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $cart = Shop::all();
        $store = Store::all();
        return view('welcome', [
            'store' => $store,
            'cart' => $cart
        ]);
    }
    public function shop()
    {
        $cart = Shop::all();
        $store = Store::all();
        return view('shop', [
            'store' => $store,
            'cart' => $cart
        ]);
    }

    public function cart()
    {
        $cart = Shop::all();
        return view('cart', [
            'cart' => $cart
        ]);
    }

    public function store($id)
    {
        $oldData = \App\Models\Store::findOrFail($id);
        $itemInShop = \App\Models\Shop::where('name', $oldData->name)->first();

        if ($itemInShop) {
            $itemInShop->increment('quantity');
        } else {

            Shop::create([
                'name' => $oldData->name,
                'price' => $oldData->price,
                'description' => $oldData->description,
                'longedescription' => $oldData->longedescription,
                "image" => $oldData->image,
                'quantity' => 1
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Product added']);
    }

    private function calculateTotal()
    {
        return \App\Models\Shop::all()->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function updateCart($id, $type)
    {

        $item = \App\Models\Shop::findOrFail($id);
        $wasDeleted = false;

        if ($type === 'plus') {
            $item->increment('quantity');
        } elseif ($type === 'minus') {

            if ($item->quantity > 1) {
                $item->decrement('quantity');
            } else {
                $item->delete();
                $wasDeleted = true;
            }
        }

        return response()->json([
            'status' => 'success',
            'new_qty' => $wasDeleted ? 0 : $item->quantity,
            'was_deleted' => $wasDeleted,
            'total_count' => \App\Models\Shop::sum('quantity'),
            'total_price' => $this->calculateTotal()
        ]);
    }

    public function destroy($id)
    {

        $cart = \App\Models\Shop::findOrFail($id);
        $cart->delete();


        return response()->json([
            'status' => 'success',
            'total_count' => \App\Models\Shop::sum('quantity'),
            'total_price' => $this->calculateTotal()
        ]);
    }
}
