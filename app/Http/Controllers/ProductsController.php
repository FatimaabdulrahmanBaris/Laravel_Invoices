<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\section;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = section::all();
        $products_db = products::all();
        return view('products.products',compact('sections','products_db'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        products::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'section_id' => $request->section_id

        ]);
        return redirect('/Products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=section::where('section_name',$request->section_name)->first()->id;
        $products=products::findOrFail($request->id);
    
        $products->update([
            'product_name' => $request->product_name,
            'section_name' => $request->section_name,
            'description' => $request->description,
            'section_id' => $id,
            
        ]);
        // return redirect('/Products');

       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id= $request->id;
        $products =products::where('id',$id)->first();
       
        if ($products != null) {
            products::find($id)->delete();
            return redirect('/Products');
        }
        return redirect('/Products');
    }
}
