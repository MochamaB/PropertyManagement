
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Hinga Properties </title>
  <!-- plugins:css -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('template/css/vertical-layout-light/style.css') }} ">
  <link rel="stylesheet" href="{{ asset('template/css/vertical-layout-light/bootstrap-table/dist/bootstrap-table.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/vertical-layout-light/mystyle.css') }}">
                            
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('template/images/faviconnew.png') }}" />
                            
</head>

<body>


<div class="row" style="background-color:lightgray">
                   <div style="padding-left:40px;"><br /><br />  
                            <h4>MJ Hinga Properties - {{$invoicedetails->invoicetype}} Invoice for  {{\Carbon\Carbon::parse($invoicedetails->invoicedate)->format('d M Y')}}</h4>
                            <p><b>How to pay by M-PESA</b> </p>
                            <p>1. Go to the M-PESA Menu </p>
                            <p>2. Go to Lipa Na Mpesa </p>
                            <p>3. Select Paybill </p>
                            <p>4. Enter the business no. <span style="color:blue; font-weight:700;"></span></p>
                            <p>5. Enter the Account no. Which is the Invoice Number <span style="color:blue; font-weight:700;">{{$invoicedetails->invoiceno}}</span></p>
                            @if($invoicedetails->invoicetype == 'Water')
                                          <p>6. Enter Total amount due. <span style="color:blue; font-weight:700;">KSH {{($invoicedetails->amountdue + $watercharge->rate + $previousmonthsbalance) - $paymentsinfo->payments->sum('amountpaid')}}</span></p>
                                          @else
                                          <p>6. Enter Total amount due. <span style="color:blue; font-weight:700;">KSH {{($invoicedetails->amountdue + $previousmonthsbalance) - $paymentsinfo->payments->sum('amountpaid')}}</span><p>
                                          @endif
                            <p>7. Complete Transaction</p>
                          </div>
            <div class="col-2"></div>
            <div class=" col-8 card">
            
            <div class="card-body">
                     <!-- Invoice Company Details -->
                     <div class="container">
                            <div class="row">
                                    <div class="col-3"><a class="navbar-brand">
                                        <img src="{{ asset('Templateassets/img/logo2edit.png') }}" alt="" style="width:220px; height:170px;margin-left:-20px;opacity:1.5;"></a>
                                        </div>
                                    <div class="col-3 ">
                                        <ul class="ml-2 px-0 list-unstyled">
                                            <li class="text-bold-800">MJ Hinga Properties</li>
                                            <li>P.O BOx 532-00605,</li>
                                            <li>Uthiru,</li>
                                            <li>hingajames@gmail.com</li>
                                          </ul>
                                    </div>
                                <div class="col" style="text-align: right;">
                                    <h2 style="text-transform: uppercase;">{{$invoicedetails->invoicetype}} INVOICE</h2>
                                        <p class="pb-sm-3" style="color:blue; font-weight:700;font-size:14px">INV#:{{$invoicedetails->invoiceno}} </p>
                                        <ul class="px-0 list-unstyled">
                                          <li style="color:red; font-weight:700;font-size:14px">Total Due</li>
                                          @if($invoicedetails->invoicetype == 'Water')
                                          <li style="color:red; font-weight:700;"class="lead text-bold-800">KSH {{($invoicedetails->amountdue + $watercharge->rate + $previousmonthsbalance) - $paymentsinfo->payments->sum('amountpaid')}}</li>
                                          @else
                                          <li style="color:red; font-weight:700;"class="lead text-bold-800">KSH {{($invoicedetails->amountdue + $previousmonthsbalance) - $paymentsinfo->payments->sum('amountpaid')}}</li>
                                          @endif
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
                                                <li class="text-bold-800"><b> Name:</b>{{$invoicedetails->firstname}} {{$invoicedetails->lastname}}</li>
                                                <li><b>House No:</b>{{$invoicedetails->housenumber}} ,</li>
                                                <li><b>id:</b>{{$invoicedetails->idnumber}} ,</li>
                                                <li><b>Email:</b> {{$invoicedetails->email}} ,</li>
                                                <li><b>Phone No:</b> {{$invoicedetails->phonenumber}},</li>
                                               
                                              </ul>
                                   </div>
                                   <div class="col" style="text-align:right;">
                                        <p><b>Invoice Date :</b> {{\Carbon\Carbon::parse($invoicedetails->invoicedate)->format('d M Y')}} </p>
                                        <p><b>Terms :</b> Due on Receipt</p>
                                        <p><b>Due Date :</b>{{\Carbon\Carbon::parse($invoicedetails->duedate)->format('d M Y')}} </p>
                                        <p><b>Invoice For :</b>{{$invoicedetails->invoicetype}} </p>
                                        <!----------------------------------- ----------->
                                      
                                        @if( $invoicedetails->amountdue -$paymentsinfo->payments->sum('amountpaid') == 0 )
                                                     <div style="background-color:green;font-size:17px" class="badge badge-opacity-warning"> PAID</div> <!------Status -->
                                                     @elseif( $invoicedetails->amountdue - $paymentsinfo->payments->sum('amountpaid') < 0  )
                                                     <div style="background-color:darkorange;font-size:17px" class="badge badge-opacity-warning"> OVER PAID</div>
                                                     
                                                     @elseif ( $paymentsinfo->payments->sum('amountpaid')  != null)
                                                     <div style="background-color:blue;font-size:17px;font-weight:800" class="badge badge-opacity-sucess"> PARTIALLY PAID</div>
                                                    @elseif ( $paymentsinfo->payments->sum('amountpaid')  == null)
                                                     <div  class="badge badge-opacity-warning;font-size:17px">UNPAID </div>
                                                     
                                                     @endif
                                   </div>
                            </div>
                      </div>  
                            <div class="col-12">
                                  <table class="table">
                                    <thead>
                                      <tr>
                                        
                                        <th>Item & Description</th>
                                        <th class="text-right">  {{$invoicedetails->invoicetype}} Amount Due  </th>
                                        <th class="text-right">Previous Months Balance</th>
                                        <th class="text-right">Total Paid</th>
                                        <th class="text-right">Total Due</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @if($invoicedetails->invoicetype == 'Water')
                                    <tr>
                                        
                                    <tr >
                                                  <td class="text-right">
                                                  <p style="font-size:14px"><b>Water Invoice Summary:</b></p>
                                                    <p>{{\Carbon\Carbon::parse($readings->fromdate)->format(' M ') }} Reading: {{$readings->currentreading}} <i>Units</i></p>
                                                    <p>{{\Carbon\Carbon::parse($readings->fromdate)->subMonth()->format(' M ') }} Reading: {{$readings->lastreading}} <i>Units</i>:</p>
                                                    <p>Rate: {{$utilitycat->rate}}</p>
                                                    <p><b>Units Used: {{$readings->currentreading - $readings->lastreading}} </b></p>
                                                  </td>
                                                        
                                                        <td class="text-right align-top">
                                                        KSH: {{$invoicedetails->amountdue}}
                                           
                                                        </td>
                                                        
                                                    <td class="text-right align-top">KSH: {{$previousmonthsbalance}}</td>
                                                    <td class="text-right align-top">KSH: {{$paymentsinfo->payments->sum('amountpaid')}}</td>
                                        <td class="text-right align-top">KSH: {{($invoicedetails->amountdue + $previousmonthsbalance) - $paymentsinfo->payments->sum('amountpaid')}}</td>

                                              </tr>
                                      </tr>
                                      @else
                                      <tr>
                                        
                                        <td>
                                          <p>{{$invoicedetails->invoicetype}} Due for {{\Carbon\Carbon::parse($invoicedetails->invoicedate)->format('d M Y')}} </p>
                                          
                                        </td>
                                        <td class="text-right">KSH: {{$invoicedetails->amountdue}}</td>
                                      
                                        <td class="text-right">KSH: {{$previousmonthsbalance}}</td>
                                        
                                        <td class="text-right">KSH: {{$paymentsinfo->payments->sum('amountpaid')}}</td>
                                        <td class="text-right">KSH: {{($invoicedetails->amountdue + $previousmonthsbalance) - $paymentsinfo->payments->sum('amountpaid')}}</td>

                                      </tr>
                             
                                    
                                           
                                       
                                            @endif
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
                                                      <p>4. Enter the business no. <span style="color:blue; font-weight:700;"></span></p>
                                                      <p>5. Enter the Account no. Which is the Invoice Number <span style="color:blue; font-weight:700;">{{$invoicedetails->invoiceno}}</span></p>
                                                      @if($invoicedetails->invoicetype == 'Water')
                                                                    <p>6. Enter Total amount due. <span style="color:blue; font-weight:700;">KSH {{($invoicedetails->amountdue + $watercharge->rate + $previousmonthsbalance) - $paymentsinfo->payments->sum('amountpaid')}}</span></p>
                                                                    @else
                                                                    <p>6. Enter Total amount due. <span style="color:blue; font-weight:700;">KSH {{($invoicedetails->amountdue + $previousmonthsbalance) - $paymentsinfo->payments->sum('amountpaid')}}</span><p>
                                                                    @endif
                                                      <p>7. Complete Transaction</p>
                                                                  
                                                </div>      
                                </div>
               
                                <div class="col">
                                        <p class="lead">Total due</p>
                                        <table class="table">
                                          <tbody>
                                            <tr>
                                              <td>Monthly Amount Due</td>
                                              <td class="text-right">KSH: {{$invoicedetails->amountdue}}</td>
                                            </tr>
                                            @if($invoicedetails->invoicetype == 'Water')
                                            <tr>
                                              <td>Water Deposit</td>
                                              <td class="text-right">KSH: 0</td>
                                            </tr>
                                            <tr>
                                              <td>Water Standing Charge</td>
                                              <td class="text-right">KSH: {{$watercharge->rate}}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                              <td>Previous Balances</td>
                                              <td class="text-right">KSH: {{$previousmonthsbalance}}</td>
                                            </tr>
                                            
                                            <tr>
                                              <td>Payment Made</td>
                                             
                                              <td class="pink text-right">KSH: {{$paymentsinfo->payments->sum('amountpaid')}} </td>
                                            </tr>
                                            <tr>
                                              <td class="text-bold-800" style="font-size:18px;font-weight:700">Total Due</td>
                                              @if($invoicedetails->invoicetype == 'Water')
                                              <td class="text-bold-800 text-right" style="font-size:18px;font-weight:700">KSH: {{($invoicedetails->amountdue + $watercharge->rate + $previousmonthsbalance) - $paymentsinfo->payments->sum('amountpaid')}}</td>
                                              @else
                                              <td class="text-bold-800 text-right" style="font-size:18px;font-weight:700">KSH: {{($invoicedetails->amountdue + $previousmonthsbalance) - $paymentsinfo->payments->sum('amountpaid')}}</td>
                                              @endif
                                            </tr> 
                                         
                                          </tbody>
                                        </table>
                                </div>
                            </div>
                      </div> 
                      <div class="container"> 
                            <div class="row">
                                <div class="col"></br></br></br></br></br></br>
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
