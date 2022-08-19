
@extends('layouts.admin')

@section('content')

<div class="container">
    <!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Payments</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Create New Payment</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if($errors->all())
            <h6 class="alert alert-danger">Check Error messages in the form!</h6>
            @endif
			  @if (session('statuserror'))
                        <h6 class="alert alert-danger">{{ session('statuserror') }}</h6>
            @endif
            <div class="card">
                <div class="card-header">
                    <button type="" onclick="history.back()" class="btn btn-danger float-end">BACK</button>
                    <br />
                    <h4>Add Payment </h4>

                </div>
                <div class="card-body">

                    <form action="{{ url('add-payment') }}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="">Invoice ID</label>
                                <input type="text" name="invoice_id" value="{{$invoice->id}}" class="form-control" readonly/>
                                    @if ($errors->has('type'))
                                        <span class="text-danger" style="font-size:12px">{{ $errors->first('type') }}</span>
                                    @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Invoice No</label>
                                <input type="text" name="invoiceno" value="{{$invoice->invoiceno}}" class="form-control" readonly/>
                                    @if ($errors->has('price'))
                                        <span class="text-danger" style="font-size:13px;font-weight:700">{{ $errors->first('price') }}</span>
                                    @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Payment Method</label>

                                <select name="paymenttype_id" class="form-control" />
                                <option value="">Select Payment Method</option>
                                    @foreach($paymenttypes as $row)
                                    <option value="{{$row->id}}">{{$row->paymentname}}</option>
                                    @endforeach
                                </select>
                                    @if ($errors->has('paymenttype_id'))
                                        <span class="text-danger" style="font-size:13px;font-weight:700">{{ $errors->first('paymenttype_id') }}</span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-6">
                        <div class="form-group mb-3">
                                <label for="">Date of Invoice</label>
                                <input type="text" name="invoicedate" value="{{$invoice->invoicedate}}" class="form-control" readonly/>
                                    @if ($errors->has('invoicedate'))
                                        <span class="text-danger" style="font-size:12px">{{ $errors->first('invoicedate') }}</span>
                                    @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Payment Type</label>
                                <input type="text" name="paymentitem" value="{{$invoice->invoicetype}}" class="form-control" readonly/>
                                    @if ($errors->has('type'))
                                        <span class="text-danger" style="font-size:12px">{{ $errors->first('type') }}</span>
                                    @endif
                            </div>
                            <div class="form-group mb-3">
                                
                                <input type="hidden" name="lease_id" class="form-control" value="  {{$invoice->lease_id }}" />
                                   
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Amount Paid</label>
                                <input type="text" name="amountpaid" class="form-control" placeholder=" Amount Due - {{$invoice->amountdue - $invoice->payments->sum('amountpaid')}}" />
                                    @if ($errors->has('amountpaid'))
                                        <span class="text-danger" style="font-size:13px;font-weight:700">{{ $errors->first('amountpaid') }}</span>
                                    @endif
                            </div>
                        
                        </div>
                    </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary float-end">Save Payment</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
