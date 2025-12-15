<?php

namespace App\Http\Controllers;

use App\Models\ProdukTapioka;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($id)
    {
        $produk = ProdukTapioka::findOrFail($id);
        return view('detail', compact('produk'));
    }
}
