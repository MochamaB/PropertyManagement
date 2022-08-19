@extends('layouts.admin')

@section('content')

<div class="container-fluid">
<div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Maintenance</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Job Work Order View</span></a> </li>
                 </ol>
             </nav>
         </div>
         <div>
                <button class="btn btn-danger text-white mb-0 me-0 float-end" onclick="history.back()"><i class="mdi mdi-keyboard-return">Back To Repair List</i></button>
         </div>
     </div>


<!---------  breadcrumbs ---------------->

       <div class="col-12 grid-margin">
       <br/>
            <div class="card">
            
                         <div class="card-header">
                            <br />
                            
                            <a href="" class="btn btn-primary btn-rounded btn-fw float-end" data-toggle="modal" data-target="#sendemail" ><i class="ti-email"></i>Email</a>
                            <a href="" onclick="printDiv('printMe')" class="btn btn-warning btn-rounded btn-fw float-end"><i class="icon-printer" style="color:white" ></i> Print</a>
                            
                            <h4>Job Work Order</h4>
                        </div>

                    <div class="card-body" id="printMe">
                     <!-- Invoice Company Details -->
                            <div class="row">
                                    <div class="col-3"><a class="navbar-brand">
                                        <img src="{{ asset('Templateassets/img/logo2edit.png') }}" alt="" style="width:220px; height:170px;margin-left:-20px;opacity:1.5;"></a>
                                        </div>
                                    <div class="col-3">
                                        <ul class="ml-2 px-0 list-unstyled">
                                            <li class="text-bold-800">MJ Hinga Properties</li>
                                            <li>Adress details,</li>
                                            <li>Nairobi,</li>
                                            <li>KENYA</li>
                                          </ul>
                                    </div>
                                <div class="col " style="text-align: right;">
                                    <h2 style="text-transform: uppercase;">JOB WORK ORDER</h2>
                                        <p class="pb-sm-3" style="color:blue; font-weight:700;font-size:14px">#:{{$workorder->Workid}} </p>
                                        <ul class="px-0 list-unstyled">
                                          <li style="color:red; font-weight:700;font-size:14px">Total USED</li>
                                          <li style="color:red; font-weight:700;"class="lead text-bold-800">KSH {{$workorder->amountspent + $workorder->amountpaid}}</li>
                                         
                                        </ul>
                                </div>
                            </div>
                     <!-- Invoice Company Details -->

                     <!-- Invoice Customer Details -->
                            <div class="row">
                                   <div class="col">
                            
                                            <h4="text-muted"><b>DETAILS</b></h4>
      
                                            
                                            <ul class="ml-2 px-0 list-unstyled">
                                                <li class="text-bold-800"><b> Name:</b>{{$workorder->firstname}} {{$workorder->lastname}}</li>
                                                <li><b>House No:</b>{{$workorder->housenumber}} ,</li>
                                                <li><b>id:</b>{{$workorder->idnumber}} ,</li>
                                                <li><b>Email:</b> {{$workorder->email}} ,</li>
                                                <li><b>Phone No:</b> {{$workorder->phonenumber}},</li>
                                               
                                              </ul>
                                   </div>
                                   <div class="col" style="text-align:right;">
                                        <p><b>Date Reported :</b>{{\Carbon\Carbon::parse($workorder->created_at)->format('d M Y') }}   </p>
                                        <p><b>Work Order Created on :</b>{{\Carbon\Carbon::parse($workorder->dateofrepair)->format('d M Y') }} </p>
                                        
                                        <p style="font-weight:700;font-size:16px;">PRIORITY:{{$workorder->priority}}</p>
                                        @if( $workorder->status == 'Completed' )
                                                     <div style="background-color:green;font-size:17px" class="badge badge-opacity-warning"> COMPKETED</div> <!------Status -->
                                                     @elseif( $workorder->status == 'Out of supplies'  )
                                                     <div style="background-color:darkorange;font-size:17px" class="badge badge-opacity-warning"> OUT OF SUPPLIES</div>
                                                     
                                                     @elseif ( $workorder->status == 'Ongoing')
                                                     <div style="background-color:blue;font-size:17px;font-weight:800" class="badge badge-opacity-sucess"> ONGOING</div>
                                                    @elseif ( $workorder->status == 'Stopped')
                                                     <div  class="badge badge-opacity-warning;font-size:17px">STOPPED </div>
                                                     
                                                     @endif
                                   </div>
                                <!-- Invoice Customer Details -->

                            </div><br/>
                            <div class="col-md-7 " style="text-align:middle;">
                                        <p style="color:blue; font-weight:700;font-size:16px;"><b>TITLE: {{$workorder->name}}</b></p>
                                        <p style="font-weight:700;font-size:16px;"><b>1. Short Description of Problem </b></p>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$workorder->description}} </p>
                                        <hr/>
                                        <p style="font-weight:700;font-size:16px;"><b>2. Supplies used </b></p>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$workorder->description}}</p>
                                        <hr/>
                                        <p style="font-weight:700;font-size:16px;"><b>3. Details of work done </b></p>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$workorder->descworkdone}}</p>
                                        <hr/>
                                        <p style="font-weight:700;font-size:16px;"><b>4. Recommendations </b></p>
                                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$workorder->recommendations}}</p>
                                        
                                   </div>
                            
                            
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
                                      <form action="{{ url('send-workorderEmail/'.$workorder->maintenance_id) }}" method="GET" id="form" name="form">
                                            @csrf
                                            
                                            <div class="form-group col-md-6 mb-3">
                                            <input type="hidden" class="form-control" name="lease_id" value="{{$workorder->lease_id}}" readonly>
                                            <input type="hidden" class="form-control" name="item_id" value="{{$workorder->maintenance_id}}" readonly>
                                                <label for="">Work Order No <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="itemno" value="{{$workorder->Workid}}" readonly>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Mail to  <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="mailto" value="{{$user->email}}" >
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">House Number <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="housenumber" value="{{$workorder->housenumber}}" readonly>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Recepient Name <span style="color:red;font-size:20px">*</span></label>
                                                <input type="text" class="form-control" name="recepientname" value="{{$workorder->firstname}} {{$workorder->lastname}}" >
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
