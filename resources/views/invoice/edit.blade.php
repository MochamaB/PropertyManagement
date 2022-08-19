
@extends('layouts.admin')

@section('content')

<div class="container">
    <!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Invoices</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Edit Invoice </span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    <div class="col-12 grid-margin">
            @if($errors->all())
            <h6 class="alert alert-danger">Check Error messages in the form!</h6>
            @endif
             <div class="card">
                     <div class="card-header">
                        <br />
                        <button class="btn btn-danger text-white mb-0 me-0 float-end" onclick="history.back()"><i class="mdi mdi-keyboard-return">Back</i></button>
                    <br />
                    <h4>Edit Invoice</h4>
                    </div>

                <div class="card-body">
                        <form action="{{ url('update-invoice/'.$invoice->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-md-6 mb-3">
                                        <h3 style="text-transform:uppercase;color:blue">{{$invoice->invoicetype}} Invoice</h3>
                                        <p></p>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                        <label for=""><span style="color:black;font-size:15px">Invoice No: </span> {{$invoice->invoiceno}}</label>
                                        <p></p>
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                        <label for=""><span style="color:black;font-size:15px">Tenant Name: </span> {{$invoicedetails->firstname}} {{$invoicedetails->lastname}}</label>
                                        <p></p>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                        <label for=""><span style="color:black;font-size:15px">House Number: </span> {{$invoicedetails->housenumber}}</label>
                                        <p></p>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                        <label for=""><span style="color:black;font-size:15px">Invoice Date: </span> {{\Carbon\Carbon::parse($invoicedetails->invoicedate)->format('Y M d')}}</label>
                                        <p></p>
                                        </div>

                                         <div class="form-group col-md-6 mb-3">
                                         <label for=""><span style="color:black;font-size:15px">Amount Due: </span></label>
                                        <input type="text" name="amountdue" class="form-control" value="{{$invoicedetails->amountdue}}"  />
                                            @if ($errors->has('amountdue'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('amountdue') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                         <label for=""><span style="color:black;font-size:15px">Due Date: </span>{{\Carbon\Carbon::parse($invoicedetails->duedate)->format('Y M d')}}</label>
                                        <input type="date" name="duedate" class="form-control" value="{{$invoicedetails->duedate}}"  />
                                            @if ($errors->has('duedate'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('duedate') }}</span>
                                            @endif
                                        </div>

        
                                        

                                        
                                         
                                       <button type="submit" class="btn btn-primary float-end" >Edit Invoice</button>
    
                            </div>
                                         
                                    
                                  
                                    
                                    
                                    
              

                </div>
    </div>
                 
    
          
</body>

@endsection
