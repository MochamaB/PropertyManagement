<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Hinga Properties </title>
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
                     <div class="container">
                            <div class="row">
                                    <div class="col-3"><a class="navbar-brand">
                                        <img src="{{ asset('Templateassets/img/logo2edit.png') }}" alt="" style="width:220px; height:170px;margin-left:-20px;opacity:1.5;"></a>
                                        </div>
                                    <div class="col-3 ">
                                        <ul class="ml-2 px-0 list-unstyled">
                                            <li class="text-bold-800">MJ Hinga Properties</li>
                                            <li>Adress details,</li>
                                            <li>Nairobi,</li>
                                            <li>KENYA</li>
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
                                        <p><b>Invoice Amount Due :</b><span style="color:red; font-weight:700;font-size:15px">KSH {{$receiptdetails->amountdue}}</span></p>
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

 
                    </div>
            </div>

       </div>



</div>            

</body>

</html>