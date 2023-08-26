<?php

namespace App\Http\Controllers;
use App\Models\section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section_db=section::all();
        return view('sections.section',compact('section_db'));
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
        // الطريقة  الاولى
    //  
        // $input=$request->all();
        // $b_exists=section::where('section_name','=',$input['section_name'])->exists();
        // if ($b_exists) {
        //    session()->flash('Error','خطأ القسم مسجل مسبقا');
        //    return redirect('/section');
        // } 
        // else {
        //     section::create([
        //     'section_name' => $request->section_name,
        //     'description' => $request->description,
        //     'created_by' => (Auth::User()->name),
        //   ]);
        //   session()->flash('Add','تم اضافة القسم بنجاح');
        //   return redirect('/section');
        // }
        // طريقة الثانية 
        
       $validatedData = $request->validate([
        'section_name' => 'required|unique:sections',
            'description'=>'required'
       ],[
        'section_name.required' => 'يرجى ملئ حقل اسم القسم',
        'section_name.unique' => 'اسم القسم مسجل مسبقا',
        'description.required'=>'يرجى ملئ حقل الوصف',
       ]);
       section::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => (Auth::User()->name),
       ]);
                 return redirect('/section');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->id;
        $this ->validate($request,[
            'section_name' => 'required|max:255|unique:sections',
                'description'=>'required'
           ],[
            'section_name.required' => 'يرجى ملئ حقل اسم القسم',
            'section_name.unique' => 'اسم القسم مسجل مسبقا',
            'description.required'=>'يرجى ملئ حقل الوصف',
           ]);
           $sections =section::find($id);
           $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
           ]);
           session()->flash('edit','تم العديل بنجاح');
           return redirect('/section');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $id= $request->id;
       section::find($id)->delete();
       session()->flash('delete','تم الحذف بنجاح');
       return redirect('/section');
    }
}
