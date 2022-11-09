
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
                                  <!---- ----------------------   Unpaid Modal Section-------------- -->
                                  
                       
                                  
                                
                        
                                  <div class="modal fade" id="invoicesnotpaid" tabindex="-1" role="dialog" aria-labelledby="invoicesnotpaid" aria-hidden="true">
                                  <div class="modal-dialog" role="document" style="max-width:900px ;">
                                    <div class="modal-content ">
                                      <div class="modal-header" style="background-color:darkblue;">
                                        <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Overdue Invoices</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body ">
                                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Warning! </strong> 
                                            The following {{$invoice->invoicetype}} Invoices for the House/Tenant are overdue. Please Pay before proceeding!!!
                                     </div>
                                    <div class="table-responsive">
                                    <table id="table"
                                            data-toggle="table"
                                            data-icon-size="sm"
                                                class="table table-hover table-striped"
                                                style="font-size:12px">
                                                <thead  class="sticky-header">
                                                        <tr class="tableheading">
                                                            <th data-sortable="true">Invoice Date</th>
                                                            <th data-sortable="true">Invoice No</th>
                                                            <th data-sortable="true">Details</th>
                                                            <th data-sortable="true">Amount Due</th>
                                                            <th>Amount Paid</th>
                                                            <th data-sortable="true">Balance</th>
                                                            <th>Actions</th>
                                        
                                                        </tr>
                                                    </thead>
                                                    <tbody style="padding-left:0; padding-right:0px">
                                                    @foreach($invoicesnotpaid as $item)
                                                    @if ($item->invoiceno != null) 
                                                        <script>$('#invoicesnotpaid').modal('show')</script>
                                                    @else
                                                    <script>$('#invoicesnotpaid').modal('hide')</script>
                                                    @endif
                                                    @if(($item->amountdue + $parentutilsum->sum('amount') - $item->amountpaid) != 0 )
                                                    <tr>
                                                            <td>{{\Carbon\Carbon::parse($item->invoicedate)->format('d M Y')}}</td> 
                                                            <td>{{$item->invoiceno}}</td>
                                                            <td>{{$item->housenumber}}- {{$item->firstname}} {{$item->lastname}}</td>
                                                            <td>{{$item->amountdue + $parentutilsum->sum('amount')}}</td>
                                                           @if($item->amountpaid != 0)
                                                            <td>{{$item->amountpaid}}</td>
                                                            @else<td>0</td>
                                                            @endif
                                                            <td>{{$item->amountdue + $parentutilsum->sum('amount') - $item->amountpaid}} </td>
                                                            <td>  
                                                                <a href="{{ url('invoices/ListInvoices/'.\Carbon\Carbon::parse($item->invoicedate)->format('Y'). '/' . Carbon\Carbon::parse($item->invoicedate)->format('M'). '/' .$item->invoicetype) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-cash-usd"></i></i>Go to Invoices<i class="mdi mdi-cash-usd"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    @endforeach
                                                    </tbody>
                                    </table>
                                    </div>                                  
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Proceed Anyway!</button>
                        
                                      
                                      </div>
                                    </div>
                                  </div>
                                </div>
                   
                                <!---- ----------------------   End Modal Section-------------- -->
    <div class="row justify-content-center">
        <div class="col-md-10">
        @include('layouts.partials.messages')	
            <div class="card">
                <div class="card-header">
                    <button type="" onclick="history.back()" class="btn btn-danger float-end">BACK</button>
                    <br />
                    <h4>Add Payment </h4>

                </div>
                <div class="card-body">
             @foreach($invoicesnotpaid as $item)
                <label for="">XXXXXXXXXX</label>
             @endforeach   
            
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
                                <label for="">Payment Method <span style="color:red;font-size:20px">*</span></label>

                                <select name="paymenttype_id" class="formcontrol2" required/>
                                <option value="">Select Payment Method</option>
                                    @foreach($paymenttypes as $row)
                                    <option value="{{$row->id}}">{{$row->paymentname}}</option>
                                    @endforeach
                                </select>
                                    @if ($errors->has('paymenttype_id'))
                                        <span class="text-danger" style="font-size:13px;font-weight:700">{{ $errors->first('paymenttype_id') }}</span>
                                    @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Payment Code</label>
                                <input type="text" name="payment_code" value="{{old('payment_code')}}" class="form-control" />
                                    @if ($errors->has('payment_code'))
                                        <span class="text-danger" style="font-size:12px">{{ $errors->first('payment_code') }}</span>
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
                                <label for="">Amount Paid <span style="color:red;font-size:20px">*</span></label>
                                <input type="text" name="amountpaid" class="form-control" value =" {{($invoice->amountdue + $parentutilsum->sum('amount')) - $invoice->payments->sum('amountpaid')}}" />
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
