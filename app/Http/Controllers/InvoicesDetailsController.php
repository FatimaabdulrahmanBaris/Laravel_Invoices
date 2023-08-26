<?php

namespace App\Http\Controllers;
use App\Models\invoices;
use App\Models\invoices_details;
use App\Models\invoices_attachments;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Response;

class InvoicesDetailsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where('id',$id)->first();
        $details = invoices_details::where('id_Invoice',$id)->get();
        $attachments = invoices_attachments::where('invoice_id',$id)->get();
        return view('invoices.Detailinvoices',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices_details  $invoices_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = invoices_attachments::findOrFail($request->id);
        $invoices->delete();
        Storage::disk('public-uploads')->delete($request->invoice_number.'/'.$request->file_name);
        return back();
    }
      public function open_file($invoices_number,$file_name){
      

    $path = public_path('Attachments'.'/'.$invoices_number.'/'.$file_name);

    if (!File::exists($path)) {

        abort(404);

    }

    $file = File::get($path);

    $type = File::mimeType($path);

  

    $response = Response::make($file, 200);

    $response->header("Content-Type", $type);

    return $response;

    }

    public function get_file($invoices_number,$file_name){

        $path = public_path('Attachments'.'/'.$invoices_number.'/'.$file_name);

      return response()->download($path);
    }
}
