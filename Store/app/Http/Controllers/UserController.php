<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $store = Store::all();
        return view('admin.index', [
            'store' => $store
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        $store = Store::all();
        return view('User/user.show' , [
            'store' => $store
        ]);
    }
}
