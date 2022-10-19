
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Properties </title>
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
           
            <div class="col-2"></div>
            <div class=" col-8 card">
            
            <div class="card-body" id="printMe">
                     <!-- Invoice Company Details -->
                      <div class="container">
                            <div class="row">
                                    <div class="col-3"><a class="navbar-brand">
                                        <img src="" alt="" style="width:220px; height:170px;margin-left:-20px;opacity:1.5;"></a>
                                        </div>
                                    <div class="col-4 ">
                                        <ul class="ml-2 px-0 list-unstyled">
                                            <li class="text-bold-800">----</li>
                                            <li>----,</li>
                                            <li>----,</li>
                                            <li>-----</li>
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
      
                                            
                                   </div>
                                   <div class="col" style="text-align:right;">
                                 
                                      
                                     
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
                                        
                                       
                                      </tr>
                                 
                                 
                                      <tr>
                                 
                                      </tr>
                              
                                           
                                    </tbody>
                                  </table>
                            </div></br>
                      <div class="container">  
                            <div class="row">
                                <div class="col">
                                     <p class="lead">Payment:</p>
                                                          
                                                <div style="padding-left:2px;padding-right:4px;">
                                                
                                                                  
                                                </div>      
                                </div>
               
                                <div class="col">
                                       
                                        <table class="table">
                                          <tbody>
                                            <tr>
                                              <td>Monthly Amount Due</td>
                                              <td class="text-right">KSH: </td>
                                            </tr>
                                            <tr>
                                              <td>Previous Balances</td>
                                              <td class="text-right">KSH:  </td>
                                            </tr>
                                            <tr>
                                              <td>Other Charges</td>
                                              <td class="text-right">KSH:  </td>
                                            </tr>
                                            
                                            <tr>
                                              <td>Payment Made</td>
                                             
                                              <td class="pink text-right">KSH:  </td>
                                            </tr>
                                            <tr>
                                              <td class="text-bold-800" style="font-size:18px;font-weight:700">Total Due</td>
                                              
                                              <td class="text-bold-800 text-right" style="font-size:18px;font-weight:700">KSH: </td>
                                           
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
