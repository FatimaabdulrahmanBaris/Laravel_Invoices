<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachments;
use App\Models\invoices;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoicesAttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
       $this->validate($request,[
        'file_name' => 'mimes:pdf,jpeg,png,jpg',
       ],[
        'file_name.mimes' => 'pdf,jpeg,png,jpg صيغة المرفق يجب ان تكون  '
       ]);
       $image = $request->file('file_name');
       $file_name = $image->getClientOriginalName();
       $invoice_number = $request->invoices_number;
       $invoices_id=$request->invoices_id;
       $invoice_id = Invoices::latest()->first()->id;
       $attachments = new invoices_attachments();
       $attachments->file_name =$file_name;
        $attachments->invoice_number =$invoice_number;
        $attachments->invoice_id = $invoices_id;
        $attachments->Created_by = Auth::user()->name;
        $attachments->save();
        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/'.$invoice_number),$imageName);
        return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_attachments $invoices_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_attachments  $invoices_attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices_attachments $invoices_attachments)
    {
        //
    }
}
