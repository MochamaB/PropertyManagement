@extends('layouts.admin')

@section('content')

<div class="container-fluid">
<div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Invoices</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Invoice View</span></a> </li>
                 </ol>
             </nav>
         </div>
         <div>
                <button class="btn btn-danger text-white mb-0 me-0 float-end" onclick="history.back()"><i class="mdi mdi-keyboard-return">Back To Invoice List</i></button>
         </div>
     </div></br>


<!---------  breadcrumbs ---------------->

      
            <div class="card">
            
                         <div class="card-header">
                            <br />
                         
                            <a href="" class="btn btn-primary btn-rounded btn-fw float-end" data-toggle="modal" data-target="#sendemail" ><i class="ti-email"></i>Email</a>

                            <a href="" onclick="printDiv('printMe')" class="btn btn-warning btn-rounded btn-fw float-end"><i class="icon-printer" style="color:white" ></i> Print</a>
  
                            <h4>Invoice Details</h4>
                        </div>

                    <div class="card-body" id="printMe">
                     <!-- Invoice Company Details -->
                      <div class="container">
                            <div class="row">
                                    <div class="col-3"><a class="navbar-brand">
                                        <img src="{{ asset('uploads/Images/'.$invoice->apartments->logo) }}" alt="" style="width:220px; height:170px;margin-left:-20px;opacity:1.5;"></a>
                                        </div>
                                    <div class="col-4 ">
                                        <ul class="ml-2 px-0 list-unstyled">
                                            <li class="text-bold-800">{{$invoice->apartments->name}}</li>
                                            <li>{{$invoice->apartments->postalcode}},</li>
                                            <li>{{$invoice->apartments->location}},</li>
                                            <li>{{$invoice->apartments->email}}</li>
                                          </ul>
                                    </div>
                                <div class="col" style="text-align: right;">
                                    <h2 style="text-transform: uppercase;">{{$invoice->invoicetype}} INVOICE</h2>
                                        <p class="pb-sm-3" style="color:blue; font-weight:700;font-size:14px">INV#:{{$invoice->invoiceno}} </p>
                                        <ul class="px-0 list-unstyled">
                                          <li style="color:red; font-weight:700;font-size:14px">Total Due</li>
                                  
                                          <li style="color:red; font-weight:700;"class="lead text-bold-800">KSH {{$total}} </li>
                                         
                                        </ul>
                                </div>
                            </div>
                          </div>  
                     <!-- Invoice Company Details -->

                     <!-- Invoice Customer Details -->
                     <div class="container">
                            <div class="row">
                                   <div class="col ">
                            
                                            <h4="text-muted"><b>BILL TO</b></h4>
      
                                            <ul class="ml-2 px-0 list-unstyled">
                                                <li class="text-bold-800"><b> Name:</b>{{$invoice->tenants->firstname}} {{$invoice->tenants->lastname}}</li>
                                                <li><b>House No:</b>{{$invoice->houses->housenumber}} ,</li>
                                                <li><b>id:</b> {{$invoice->tenants->idnumber}} ,</li>
                                                <li><b>Email:</b> {{$invoice->tenants->email}} ,</li>
                                                <li><b>Phone No:</b> {{$invoice->tenants->phonenumber}},</li>
                                               
                                              </ul>
                                   </div>
                                   <div class="col" style="text-align:right;">
                                        <p><b>Invoice Date :</b> {{\Carbon\Carbon::parse($invoice->invoicedate)->format('d M Y')}} </p>
                                        <p><b>Terms :</b> Due on Receipt</p>
                                        <p><b>Due Date :</b>{{\Carbon\Carbon::parse($invoice->duedate)->format('d M Y')}} </p>
                                        <p><b>Invoice For :</b>{{$invoice->invoicetype}} </p>
                                        <!----------------------------------- ----------->
                                      
                                        @if( $invoice->amountdue - $invoice->payments->sum('amountpaid') == 0 )
                                                     <div style="background-color:green;font-size:17px" class="badge badge-opacity-warning"> PAID</div> <!------Status -->
                                        @elseif( $invoice->amountdue - $invoice->payments->sum('amountpaid') < 0  )             
                                                     <div style="background-color:darkorange;font-size:17px" class="badge badge-opacity-warning"> OVER PAID</div>
                                        @elseif ( $invoice->payments->sum('amountpaid')  != null)             
                                                   
                                                     <div style="background-color:blue;font-size:17px;font-weight:800" class="badge badge-opacity-sucess"> PARTIALLY PAID</div>
                                        @elseif ( $invoice->payments->sum('amountpaid')  == null)           
                                                     <div style="background-color:red;font-size:17px;font-weight:800"  class="badge badge-opacity-warning;font-size:17px">UNPAID </div>
                                        @endif             
                                                    
                                   </div>
                            </div>
                    </div>  
                            <div class="table-responsive">
                            <table class="table" id="table"
                              data-toggle="table"
                    
                              data-side-pagination="server"
                              data-click-to-select="true"
                              class="table table-hover table-striped"
                                   style="font-size:12px">
                                <thead style="" class="sticky-header">
                                    <tr class="tableheading">
                                        
                                        <th>Item & Description</th>
                                        <th class="text-right">Amount Due  </th>
                                        <th class="text-right">Previous Balance</th>
                                        <th class="text-right">Total Paid</th>
                                        <th class="text-right">Sub-total Due</th>
                                      </tr>
                                    </thead>
                                    <tbody>                            
                                      <tr>
                                        
                                        <td class="text-right align-top"><p>{{$invoice->invoicetype}} Due for {{\Carbon\Carbon::parse($invoice->invoicedate)->format('d M Y')}} </p></br>

                                   @if($invoice->utilitycategories->billcycle =='Units')
                                        <p>{{\Carbon\Carbon::parse($readings->fromdate)->format(' M ') }} Reading: {{$readings->currentreading}} <i>Units</i></p>
                                                    <p>{{\Carbon\Carbon::parse($readings->fromdate)->subMonth()->format(' M ') }} Reading: {{$readings->lastreading}} <i>Units</i>:</p>
                                                    <p>Rate: {{$invoice->utilitycategories->rate}} </p>
                                                    <p><b>Units Used: {{$readings->currentreading - $readings->lastreading}}  </b></p></td>
                                    @endif
                                        </td>
                                        <td class="text-right align-top">KSH: {{$invoice->amountdue}} </td>
                                     
                                        <td class="text-right align-top">KSH:{{$previousmonthsbalance}} </td>
                                        
                                        <td class="text-right align-top">KSH: {{$invoice->payments->sum('amountpaid')}}   </td>
                                        <td class="text-right align-top">KSH: {{($invoice->amountdue + $previousmonthsbalance) - $invoice->payments->sum('amountpaid')}}  </td>

                                      </tr>
                                 
                                    @foreach($invoice->parent_utility as $parentutility)
                                      <tr>
                                      <td class="text-right align-top">{{$parentutility['utilname']}}</td> 
                                   
                                      <td class="text-right align-top">{{$parentutility['amount']}} </td>
                                 
                                      <td class="text-right align-top"> - </td>
                                      <td class="text-right align-top">-</td>
                                      <td class="text-right align-top"></td>
                                      </tr>
                                    @endforeach
                                           
                                    </tbody>
                                  </table>
                            </div></br>
                      <div class="container">  
                            <div class="row">
                                <div class="col">
                                     <p class="lead">Payment:</p>
                                                          
                                                <div style="padding-left:2px;padding-right:4px;">
                                                    <p>1. Go to the M-PESA Menu </p>
                                                      <p>2. Go to Lipa Na Mpesa </p>
                                                      <p>3. Select Paybill </p>
                                                      <p>4. Enter the business no. <span style="color:blue; font-weight:700;">{{$paymenttype->accountnumber}}</span></p>
                                                      <p>5. Enter the Account no. Which is the Invoice Number <span style="color:blue; font-weight:700;">{{$invoice->invoiceno}} </span></p>
                                                     
                                                                    <p>6. Enter Total amount due. <span style="color:blue; font-weight:700;">KSH {{$total}} </span><p>
                                                                    
                                                      <p>7. Complete Transaction</p>
                                                                  
                                                </div>      
                                </div>
               
                                <div class="col">
                                       
                                        <table class="table">
                                          <tbody>
                                            <tr>
                                              <td>Monthly Amount Due</td>
                                              <td class="text-right">KSH: {{$invoice->amountdue}} </td>
                                            </tr>
                                            <tr>
                                              <td>Previous Balances</td>
                                              <td class="text-right">KSH: {{$previousmonthsbalance}} </td>
                                            </tr>
                                            <tr>
                                              <td>Other Charges</td>
                                              <td class="text-right">KSH: {{$parentutilsum->sum('amount')}} </td>
                                            </tr>
                                            
                                            <tr>
                                              <td>Payment Made</td>
                                             
                                              <td class="pink text-right">KSH: {{$invoice->payments->sum('amountpaid')}} </td>
                                            </tr>
                                            <tr>
                                              <td class="text-bold-800" style="font-size:18px;font-weight:700">Total Due</td>
                                              
                                              <td class="text-bold-800 text-right" style="font-size:18px;font-weight:700">KSH: {{$total}} </td>
                                           
                                            </tr> 
                                         
                                          </tbody>
                                        </table>
                                </div>
                            </div>
                      </div> 
                      <div class="container"> 
                            <div class="row">
                                <div class="col"></br></br>
                                    <h6>Terms & Condition</h6>
                                    <p>Refer to the terms and conditions on Lease agreement.</p>
                                </div>
                                <div class="col">
                                        <p class="mb-0 mt-1">Authorized person</p>
                                    <img src="{{ asset('Templateassets/img/signature.png') }}" alt="signature" class="height-100" />
                                    <h6>{{$invoice->apartments->authorized_person}}</h6>
                                    <p class="text-muted">Managing Director</p>
                                </div>
                            </div>
                      </div>      

                         
                                  <!---- ----------------------   Send Email Modal Section-------------- -->
                                <div class="modal fade" id="sendemail" tabindex="-1" role="dialog" aria-labelledby="sendemail" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header" style="background-color:darkblue;">
                                        <h4 class="modal-title" id="exampleModalLabel" style="color:white;">Confirm Email Details</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                      <form action="{{ url('send-InvoiceEmail/'.$invoice->id. '/' . $invoice->lease_id. '/' . $invoice->invoicedate. '/' . $invoice->invoicetype) }}" method="GET" id="form" name="form">
                                            @csrf
                                            
                                            <div class="form-group col-md-6 mb-3">
                                            <input type="hidden" class="form-control" name="lease_id" value="{{$invoice->lease_id}}" readonly>
                                            <input type="hidden" class="form-control" name="item_id" value="{{$invoice->id}}" readonly>
                                                <label for="">Invoice No <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="itemno" value="{{$invoice->invoiceno}}" readonly>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Mail to  <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="mailto" value="{{$invoice->tenants->email}}" >
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">House Number <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="housenumber" value="{{$invoice->houses->housenumber}}" readonly>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Recepient Name <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="recepientname" value="{{$invoice->tenants->firstname}} {{$invoice->tenants->lastname}}" >
                                            </div>
                                    
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" >Send Email</button>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <!---- ----------------------   End Modal Section-------------- -->

                    </div>
            </div>

      
</div>



@endsection
