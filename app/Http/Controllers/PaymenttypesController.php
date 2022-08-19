<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\house;
use App\Models\Utilitycategories;
use App\Models\Utilitypayments;
use App\Models\utilitiesassigned;
use App\Models\tenants;
use App\Models\lease;
use App\Models\Paymenttypes;
use Carbon\Carbon;

class PaymenttypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymenttypes = Paymenttypes::all();
        return view('paymenttypes.index', compact('paymenttypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paymenttypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paymenttype = new Paymenttypes;
        $paymenttype->paymentname = $request->input('paymentname');
        $paymenttype->accountnumber = $request->input('accountnumber');
        $paymenttype->accountname = $request->input('accountname');
        $paymenttype->code = $request->input('code');
        $paymenttype->provider = $request->input('provider');
        $paymenttype->save();
        return redirect('/paymenttypes')->with('status','Payment Type Created Successfully');
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
        $paymenttype = Paymenttypes::find($id);
        return view('Paymenttypes.edit', compact('paymenttype'));
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
        $paymenttype = Paymenttypes::find($id);
        $paymenttype->paymentname = $request->input('paymentname');
        $paymenttype->accountnumber = $request->input('accountnumber');
        $paymenttype->accountname = $request->input('accountname');
        $paymenttype->code = $request->input('code');
        $paymenttype->provider = $request->input('provider');
        $paymenttype->update();
        return redirect('/paymenttypes')->with('status','Payment Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
