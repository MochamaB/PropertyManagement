
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
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Edit Payment</span></a> </li>
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
                    <h4>Edit Payment </h4>

                </div>
                <div class="card-body">

                <form action="{{ url('update-payment/'.$Payments->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="">Payment ID</label>
                                <input type="text" name="invoice_id" value="{{$Payments->id}}" class="form-control" readonly/>
                                    @if ($errors->has('type'))
                                        <span class="text-danger" style="font-size:12px">{{ $errors->first('type') }}</span>
                                    @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Receipt No</label>
                                <input type="text" name="invoiceno" value="{{$Payments->receiptno}}" class="form-control" readonly/>
                                    @if ($errors->has('price'))
                                        <span class="text-danger" style="font-size:13px;font-weight:700">{{ $errors->first('price') }}</span>
                                    @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Payment Method</label>

                                <select name="paymenttype_id" class="form-control" />
                                <option value="">Change Payment Method</option>
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
                                <label for="">Date of Payment</label>
                                <input type="text" name="invoicedate" value="{{$Payments->created_at}}" class="form-control" readonly/>
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
                                <input type="text" name="amountpaid" class="form-control" value="{{$Payments->amountpaid }}" />
                                    @if ($errors->has('amountpaid'))
                                        <span class="text-danger" style="font-size:13px;font-weight:700">{{ $errors->first('amountpaid') }}</span>
                                    @endif
                            </div>
                        
                        </div>
                    </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary float-end">Edit Payment</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
