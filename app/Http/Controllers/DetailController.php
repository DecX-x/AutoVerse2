<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function show($id)
    {
        // Fetch the detail from the database using the provided ID
        $DetailProduct = detail_product::findOrFail($id);

        // Check if the detail exists
        if (!$DetailProduct) {
            return redirect()->route('home')->with('error', 'Detail Product not found.');
        }

        // Return the detail view with the fetched detail
        return view('detailproduct.show', compact('detailProduct'));
    }
}
