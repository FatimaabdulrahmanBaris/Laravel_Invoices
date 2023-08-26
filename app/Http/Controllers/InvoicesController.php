<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\invoices;
use App\Models\invoices_details;
use App\Models\invoices_attachments;
use App\Models\section;
use App\Models\products;
use App\Models\User;
use App\Notifications\Addinvoice;
use App\Notifications\Add_invoice;

use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;


class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices_db= invoices::all();
        // $invoices_details_db= invoices_details::all();
        // $invoices_attachments_db= invoices_attachments::all();

        return view('invoices.invoices',compact('invoices_db'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections= section::all();
        $products_db = products::all();
        return view('invoices.add_invoices',compact('sections','products_db'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        invoices::create([
            'invoices_number' => $request->invoice_number,
            'invoices_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
             'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_commission' => $request->Amount_Commission,
            'discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'total' => $request->Total,
            'status' => 'غير مدفوعة',
            'value_Status' =>2,
            'note' => $request->note,
        ]);

        $invoice_id = invoices::latest()->first()->id;
        
        invoices_details::create([
            'id_Invoice' => $invoice_id,
            'invoice_number'=>$request->invoice_number,
            'product' => $request->product,
            'section' => $request->Section,
            'status' => 'غير مدفوعة',
            'value_status' =>2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);
       
        if($request->hasFile('pic')){
            $this->validate($request,['pic' => 'required|mimes:pdf,jpeg,png,jpg'],['pic.mimes' =>'تم حفظ:خطأ']);
            $invoice_id = Invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name=$image->getClientOriginalName();
            $invoice_number = $request->invoice_number;
            $attachments = new invoices_attachments();
            $attachments->file_name =$file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id =$invoice_id;
            $attachments->save();

            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/'.$invoice_number),$imageName);

        
        }

       // // $user=User::first();
        //  طريقة 1 اما
        // Notification::send($user,new Addinvoice($invoice_id));
        // او طريقة 2
        // $user->notify(new Addinvoice($invoice_id));   
        
        // اشعار بان شخص اضاف لقاعدة البيانات فاتورة
        // $user_add = User::get();
        // الاشعار لجميع المستخدمين

       //    الاشعار فقط يلي عمل الفاتورة 
        // $user_add = User::find(Auth::user()->id);


        $invoicenew_id = invoices::latest()->first();
        // Notification::send($user_add, new Add_invoice($invoicenew_id));


        $users=User::where('id','!=',auth()->user()->id)->get();
        $user_create=auth()->user()->name;
        Notification::send($users,new Add_invoice($invoicenew_id,$user_create));
        return back();
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = invoices::where('id',$id)->first();
        $sections = section::all();
        return view('invoices.status_update',compact('invoices','sections'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where('id',$id)->first();
        $sections = section::all();
        return view('invoices.edit_invoice',compact('sections','invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $invoices = invoices::findOrFail($request->invoices_id);
        $invoices->update([
            'invoices_number' => $request->invoice_number,
            'invoices_Date' => $request->invoice_Date,
            'Due_date'=>$request->Due_date,
            'product'=>$request->product,

            'section_id'=>$request->Section,
            'Amount_collection'=>$request->Amount_collection ,
            'Amount_commission'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'Value_VAT'=>$request->Value_VAT,
            'Rate_VAT'=>$request->Rate_VAT,
            'total'=>$request->Total,
            'note'=>$request->note,
        ]);
        session()->flash('edit','تم تعديل بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoices_id;
        $invoices = invoices::where('id',$id)->first();
        $Details=invoices_attachments::where('invoice_id',$id)->first();
        $id_page =$request->id_page;

        if (!$id_page==2) {
           
            if(!empty($Details->invoice_number)){
                Storage::disk('public-uploads')->deleteDirectory($Details->invoice_number);
          
                  }
                  // $invoices->Delete();
                  $invoices->forceDelete();
          
                  session()->flash('delete_invoice');
                  return redirect('/invoices');
              
        } 
        else {
            $invoices->delete();
            session()->flash('archive_invoice');
            return redirect('/invoices');
       
        }
        
      
    
    
    }
    public function status_update(Request $request,$id)
    {

              $invoices = invoices::findOrFail($id);

              if($request->status === 'مدفوعة'){

                $invoices->update([
                    'value_Status' =>1,
                    'status' => $request->status,
                    'payment_Date' => $request->payment_Date,
                ]);
                invoices_details::create([
                    'id_Invoice' => $request->invoices_id,
                    'invoice_number'=>$request->invoice_number,
                    'product' => $request->product,
                    'section' => $request->Section,
                    'status' =>  $request->status,
                    'value_status' => 1,
                    'note' => $request->note,
                    'payment_Date' => $request->payment_Date,
                    'user' => (Auth::user()->name),
                ]);
                return redirect('/invoices');

              }
              else if($request->status === 'مدفوعة جزئية'){
                $invoices->update([
                    'value_Status' =>3,
                    'status' => $request->status,
                    'payment_Date' => $request->payment_Date,
                ]);
                invoices_details::create([
                    'id_Invoice' => $request->invoices_id,
                    'invoice_number'=>$request->invoice_number,
                    'product' => $request->product,
                    'section' => $request->Section,
                    'status' =>  $request->status,
                    'value_status' => 3,
                    'note' => $request->note,
                    'payment_Date' => $request->payment_Date,
                    'user' => (Auth::user()->name),
                ]);
                return redirect('/invoices');
              }
        //  return $request;   
    }
    
    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);

    }

    public function Invoices_paid(){
        $invoices=Invoices::where('value_Status',1)->get();
        return view('invoices.invoices_paid',compact('invoices'));
    }

    public function Invoices_unpaid()
    {
        $invoices=Invoices::where('value_Status',2)->get();
        return view('invoices.invoices_unpaid',compact('invoices'));

    }

     public function Invoices_partial()
     {

        $invoices=Invoices::where('value_Status',3)->get();
        return view('invoices.invoices_partial',compact('invoices'));
                
     }

      public function print_invoice($id)
      {
        $invoices = invoices::where('id',$id)->first();
        return view('invoices.printinvoice',compact('invoices'));

       
      }

      public function export()
      {

        return Excel::download(new InvoicesExport,'invoices.xlsx',ExcelExcel::XLSX);

      }

      public function MarkAsRead_all()
      {

       $userunreadNotification = auth()->user()->unreadNotifications;
       
       if($userunreadNotification){
        $userunreadNotification->markAsRead();
        return back();
       }

      }
      public function MarkAsRead_one($id){
        $invoice_id=invoices::findorFail($id);
        $getID = DB::table('notifications')->where('data->id',$invoice_id)->pluck('id');
        DB::table('notifications')->where('id',$getID)->update(['read_at'=>now()]);
        


        // $invoices = invoices::where('id',$id)->first();
        // $details = invoices_details::where('id_Invoice',$id)->get();
        // $attachments = invoices_attachments::where('invoice_id',$id)->get();

        // return view('invoices.Detailinvoices',compact('invoices','details','attachments'));
       
        return $invoice_id;
      }
}
