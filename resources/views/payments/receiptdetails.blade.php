@extends('layouts.admin')

@section('content')

<div class="container-fluid">
<div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Payments</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Receipt View</span></a> </li>
                 </ol>
             </nav>
         </div>
         <div>
                <button class="btn btn-danger text-white mb-0 me-0 float-end" onclick="history.back()"><i class="mdi mdi-keyboard-return">Back To Receipt List</i></button>
         </div>
     </div>


<!---------  breadcrumbs ---------------->

      
       <br/>
            <div class="card">
            
                         <div class="card-header">
                         <br />
                           
                            <a href="" class="btn btn-primary btn-rounded btn-fw float-end" data-toggle="modal" data-target="#sendemail" ><i class="ti-email"></i>Email</a>
                            <a href="" onclick="printDiv('printMe')" class="btn btn-warning btn-rounded btn-fw float-end"><i class="icon-printer" style="color:white" ></i> Print</a>
                            <a href="" class="btn btn-dark btn-rounded btn-fw float-end"><i class="icon-download"></i>
                            <span style="color:white">Export PDF</span></a>
                            
                            <h4>Receipt Details</h4>
                        </div>

                    <div class="card-body" id="printMe">
                     <!-- Invoice Company Details -->
                     <div class="container">
                            <div class="row">
                            <div class="col-3"><a class="navbar-brand">
                                        <img src="{{ asset('uploads/Images/'.$receiptdetails->logo) }}" alt="" style="width:220px; height:170px;margin-left:-20px;opacity:1.5;"></a>
                                        </div>
                                    <div class="col-4 ">
                                        <ul class="ml-2 px-0 list-unstyled">
                                            <li class="text-bold-800">{{$receiptdetails->name}}</li>
                                            <li>{{$receiptdetails->postalcode}},</li>
                                            <li>{{$receiptdetails->location}},</li>
                                            <li>{{$receiptdetails->email}}</li>
                                          </ul>
                                    </div>
                                <div class="col " style="text-align: right;">
                                    <h2 style="text-transform: uppercase;">{{$receiptdetails->paymentitem}} RECEIPT</h2>
                                        <p class="pb-sm-3" style="color:blue; font-weight:700;font-size:14px">RCT#: RCT-{{$receiptdetails->invoiceno}} </p>
                                        <ul class="px-0 list-unstyled">
                                          <li style="color:blue; font-weight:700;font-size:14px">Total Paid:</li>
                                          <li style="color:blue; font-weight:700;"class="lead text-bold-800">KSH {{$receiptpayments->sum('amountpaid')}} </li>
                                        </ul>
                                </div>
                            </div>
                     </div>     
                     <!-- Invoice Company Details -->

                     <!-- Invoice Customer Details -->
                            <div class="row">
                                   <div class="col ">
                            
                                            <h4="text-muted"><b>PAID BY</b></h4>
      
                                            <ul class="ml-2 px-0 list-unstyled">
                                                <li class="text-bold-800"><b> Name:</b>{{$receiptdetails->firstname}} {{$receiptdetails->lastname}}</li>
                                                <li><b>House No:</b> {{$receiptdetails->housenumber}} ,</li>
                                                <li><b>id:</b>,{{$receiptdetails->idnumber}}</li>
                                                <li><b>Email:</b> {{$receiptdetails->email}} ,</li>
                                                <li><b>Phone No:</b> {{$receiptdetails->phonenumber}} ,</li>
                                               
                                            </ul>
                                   </div>
                                   <div class="col" style="text-align:right;">
                                        <p><b>Invoice Due Date :</b> {{ \Carbon\Carbon::parse($receiptdetails->duedate)->format('d M Y')}}  </p>
                                        <p><b>Invoice Date :</b> {{\Carbon\Carbon::parse($receiptdetails->invoicedate)->format('d M Y')}}</p>
                                        <p><b>Receipt For :</b> {{$receiptdetails->paymentitem}}</p>
                                        <p style="color:red; font-weight:700;font-size:16px;"></p>
                                   </div>
                                <!-- Invoice Customer Details -->

                            </div>
                            <div class="col-12">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        
                                        <th>Payment Date</th>
                                        <th class="text-right">Invoice No</th>
                                        <th class="text-right">Transaction Code</th>
                                        <th class="text-right"> Amount Received</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($receiptpayments as $key => $item)
                                      <tr>
                                        
                                        
                                        <td>
                                          <p><span style="color:black; font-weight:700;font-size:16px;">{{$key + 1}}: </span>  &nbsp;&nbsp;&nbsp; {{\Carbon\Carbon::parse($item->created_at)->format('d M Y')}} </p>
                                          
                                        </td>
                                        <td class="text-right">{{$item->invoiceno}}</td>
                                       
                                        <td class="text-right">{{$item->receiptno}}</td>
                                
                                        <td class="text-right">{{$item->amountpaid}}</td>
                                        
                                      </tr>
                                      @endforeach

                                    </tbody>
                                  </table>
                            </div></br>
                            <div class="row">
                                <div class="col">
                    
                                </div>
                                <div class="col">
                                        
                                </div>
                                <div class="col">
                                        <p class="lead"><b>Total Paid: KSH {{$receiptpayments->sum('amountpaid')}}</b></p>
                                      
                                </div>
                            </div></br></br></br>
                            <div class="row">
                                <div class="col">
                                    <h6>Terms & Condition</h6>
                                    <p>Test pilot isn't always the healthiest business.</p>
                                </div>
                                <div class="col">
                                        <p class="mb-0 mt-1">Authorized person</p>
                                    <img src="{{ asset('Templateassets/img/signature.png') }}" alt="signature" class="height-100" />
                                    <h6>MJ HINGA</h6>
                                    <p class="text-muted">Managing Director</p>
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
                                      <form action="{{ url('send-PaymentEmail/'.$receiptdetails->invoice_id) }}" method="GET" id="form" name="form">
                                            @csrf
                                            
                                            <div class="form-group col-md-6 mb-3">
                                            <input type="hidden" class="form-control" name="lease_id" value="{{$receiptdetails->lease_id}}" readonly>
                                            <input type="" class="form-control" name="item_id" value="{{$receiptdetails->invoice_id}}" readonly>
                                                <label for="">Invoice No <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="itemno" value="{{$receiptdetails->invoiceno}}" readonly>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Mail to  <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="mailto" value="{{$receiptdetails->email}}" >
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">House Number <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="housenumber" value="{{$receiptdetails->housenumber}}" readonly>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Recepient Name <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="recepientname" value="{{$receiptdetails->firstname}} {{$receiptdetails->lastname}}" >
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
