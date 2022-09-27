<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\utilitycategories;
use App\Models\Invoice;
use Illuminate\Support\Str;

class UtilitycategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilitycategories = utilitycategories::with('parent')
        ->get();
        return view('utilitycategories.index', compact('utilitycategories'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
	$parentutility = utilitycategories ::where('parent_utility','0')->get(); 
         return view('utilitycategories.create',compact('parentutility'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
           
            
        ], [
            'name.required' => 'This field is required',
           
        ]);

        if(utilitycategories::where('name',$request->name)->exists()){
            return redirect('add-utilitycategories')->with('statuserror','utility Category Already Exists'); 
        }

        $utilitycategories = new utilitycategories;
        $utilitycategories->name = Str::ucfirst($request->input('name')); /// the Str function make sure the first letter is capital
        $utilitycategories->prefix = $request->input('prefix');
        $utilitycategories->billcycle = $request->input('billcycle');
        $utilitycategories->rate = $request->input('rate');
        $utilitycategories->create_invoice = $request->input('create_invoice');
	 if($request->input('parent_utility') == null){
        $utilitycategories->parent_utility = '0';   
        }else{
        $utilitycategories->parent_utility = $request->input('parent_utility');
        }
        $utilitycategories->save();
        return redirect('utilitycategories')->with('status','Utility Category Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $utilitycategories = utilitycategories::find($id);
        return view('utilitycategories.edit', compact('utilitycategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $utilitycategories = utilitycategories::find($id);
        $utilitycategories->billcycle = $request->input('billcycle');
        $utilitycategories->rate = $request->input('rate');
        $utilitycategories->update();
        return redirect('utilitycategories')->with('status','Utility categories Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $utilname =  utilitycategories::where('id',$id)->pluck('name');
       
        if(Invoice::where('invoicetype',$utilname)->exists()){
            return redirect('utilitycategories')->with('statuserror','First Delete All invoices related to this category');
        }
        $utilitycategories = utilitycategories::find($id);
        $utilitycategories->delete();
        return redirect('utilitycategories')->with('status','utility Categories Deleted Successfully');
    }
}
