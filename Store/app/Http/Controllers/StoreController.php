<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $store = Store::with('user')->where('user_id', auth()->id())->get();
        return view('dashboard', [
            'store' => $store
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
        ]);

        if ($request->hasFile('image')) {
            $imgpath = $request->file('image')->store('image', 'public');
        }


        Store::create([
            "name" =>  $request->name,
            "user_id" => $request->user_id,
            "price" => $request->price,
            'description' => $request->description,
            "longedescription" => $request->longdescription,
            "image" => $imgpath,
        ]);

        return redirect()->route('dashboard', ['id' => Auth::id()]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $store = Store::findOrFail($id);


        Storage::disk('public')->delete($store->image);


        $store->delete();


        return redirect()->route('dashboard', ['id' => Auth::id()]);
    }
}
