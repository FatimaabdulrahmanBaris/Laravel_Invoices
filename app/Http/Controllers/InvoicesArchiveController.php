<?php

namespace App\Http\Controllers;

use App\Models\invoicesArchive;
use App\Models\invoices;

use Illuminate\Http\Request;

class InvoicesArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices =invoices::onlyTrashed()->get();
        return view('invoices.Archive_Invoices',compact('invoices'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoicesArchive  $invoicesArchive
     * @return \Illuminate\Http\Response
     */
    public function show(invoicesArchive $invoicesArchive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoicesArchive  $invoicesArchive
     * @return \Illuminate\Http\Response
     */
    public function edit(invoicesArchive $invoicesArchive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoicesArchive  $invoicesArchive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->invoices_id;
        $flight =invoices::withTrashed()->where('id',$id)->restore();
        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoicesArchive  $invoicesArchive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoices_id;
        $invoices =invoices::withTrashed()->where('id',$id)->first();
        $invoices->forceDelete();
        return redirect('Archive_Invoices');
       
    }
}
