<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> </title>
  <!-- plugins:css -->

  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('template/css/vertical-layout-light/style.css') }} ">
  <link rel="stylesheet" href="{{ asset('template/css/vertical-layout-light/bootstrap-table/dist/bootstrap-table.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/vertical-layout-light/mystyle.css') }}">
                            
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('template/images/faviconnew.png') }}" />
                            
  <!-- endinject -->
  
</head>

<body>

<div class="col-md-12">



<!---------  breadcrumbs ---------------->

      
       <br/>
            <div class="col-8 card">
            
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
                    


</div>            

</body>

</html>