<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Housecategories;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HousecategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userrole = Auth::user()->apartment_id;
        
        $housecategories = Housecategories::FilterByUSerRole($userrole)->get();
        
        return view('housecategories.index', compact('housecategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $apartment = Apartment::get();
        return view('housecategories.create',compact('apartment'));
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
            'type' => 'required',
            'rent' => 'required|numeric',
            'setdeposit' => 'required|numeric',
            'apartment_id' => 'required',
        ], [
            'type.required' => '* Type is required',
            'rent.required' => '* Price is required',
            'rent.numeric' => '* Input numbers only',
            'rent.max'=> '* rent Value is too long',
            'setdeposit.required' => '* Deposit is required',
            'setdeposit.max'=> '* Deposit Value is too long',
            'setdeposit.numeric' => '* Input numbers only'

        ]);

            $housecategoriestype = Housecategories::where('type', $request->type)
                                                ->where('apartment_id',$request->apartment_id)
                                                ->exists();

            
            if ($housecategoriestype != null) {
               return redirect('/add-housecategories')->with('statuserror','House Type is already in the system');
            }
            else
            {

                $housecategories = new Housecategories;
                $housecategories->type = $request->input('type');
                $housecategories->price = $request->input('price');
                $housecategories->rent = $request->input('rent');
                $housecategories->setdeposit = $request->input('setdeposit');
                $housecategories->description = $request->input('description');
                $housecategories->apartment_id = $request->input('apartment_id');
                $housecategories->save();
                return redirect('housecategories')->with('status','House Category Added Successfully');
            }
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
        
        $housecategories = Housecategories::with('apartment')->find($id);
        $apartment = Apartment::get();
        return view('housecategories.edit', compact('housecategories','apartment'));
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
        $validatedData = $request->validate([
                'type' => 'required',
                'rent' => 'required|numeric',
                'setdeposit' => 'required|numeric',
                'apartment_id' => 'required',
            ], [
                'type.required' => '* Type is required',
                'rent.required' => '* Price is required',
                'rent.numeric' => '* Input numbers only',
                'rent.max'=> '* rent Value is too long',
                'setdeposit.required' => '* Deposit is required',
                'setdeposit.max'=> '* Deposit Value is too long',
                'setdeposit.numeric' => '* Input numbers only'

            ]);
        
        $hcname = Housecategories::where('id',$id)->select('type')->first();
        
        $housecategories = housecategories::find($id);
        $housecategories->type = $request->input('type');
        $housecategories->price = $request->input('price');
        $housecategories->rent = $request->input('rent');
        $housecategories->setdeposit = $request->input('setdeposit');
        $housecategories->description = $request->input('description');
        $housecategories->apartment_id = $request->input('apartment_id');

    if($hcname->type == $request->get('type') ){
        $housecategories->update();
        return redirect('housecategories')->with('status','House category Updated Successfully');
    }
    elseif(Housecategories::where('type', $request->type)
    ->where('apartment_id',$request->apartment_id)
    ->exists()) {
        return redirect('housecategories')->with('statuserror','House category is already in the system');
    }
    else{
        $housecategories->update();
        return redirect('housecategories')->with('status','House category Updated Successfully');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $housecategories = housecategories::find($id);

        $housesdelete = house::where('housecategoryid',$housecategories->ID)->exists();
        if ($housesdelete != null) {
               return redirect('/housecategories')->with('statuserror',' First Delete all Houses attached to the category');
            }
        else{       
        $housecategories->delete();
        return redirect('housecategories')->with('status','House Categories Deleted Successfully');
            }
    }
}
