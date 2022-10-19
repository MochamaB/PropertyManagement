@extends('layouts.admin')

@section('content')
    
    

<div class="container">
    <!---------  breadcrumbs ---------------->
    <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Settings</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>System Settings</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Settings</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>

     @include('layouts.partials.messages')	
     
     @if($settings == null)
     <h4>No configurations set<h4>
        <a href="{{ url('add-setting') }}" class="btn btn-primary float-start">Set configurations</a>
        @else
     <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                      <ul class="nav nav-tabs" role="tablist">
                
                            <li class="nav-item">
                            <a class="nav-link  {{ (request()->segment(1) == 'settings') ? 'active' : '' }} " id="info-tab" data-bs-toggle="tab" href="#info" role="tab" aria-controls="overview" aria-selected="false">System Information</a>
                            </li> 
                            <li class="nav-item">
                            <a class="nav-link  " id="invoice-tab" data-bs-toggle="tab" href="#invoice" role="tab" aria-controls="overview" aria-selected="false">Invoice Settings</a>
                            </li>
                           
                          
                      </ul>
    </div>
    <div class="tab-content">
                        <div id="info" class="tab-pane fade show {{ (request()->segment(1) == 'settings') ? 'active' : '' }}">
                        <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header"></br>
                                                    <h4>
                                                       System Information
                                                   
                                                    <a href="{{ url('edit-setting/'.$settings->id) }}" class="btn btn-success float-end">Edit configurations</a>
                                                    
                                                    </h4>
                                        </div>
                                    <div class="card-body">
                    
                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100">
                                    <p class="mb-2 font-weight-medium">
                                      System Name
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <i class="mdi mdi-information text-muted me-1"></i>
                                        <p class="mb-0 text-small text-muted">{{$settings->systemname}}</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100">
                                    <p class="mb-2 font-weight-medium">
                                      Company
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <i class="mdi mdi-information text-muted me-1"></i>
                                        <p class="mb-0 text-small text-muted">{{$settings->companyname}}</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100">
                                    <p class="mb-2 font-weight-medium">
                                      Email
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <i class="mdi mdi-information text-muted me-1"></i>
                                        <p class="mb-0 text-small text-muted">{{$settings->email}}</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100">
                                    <p class="mb-2 font-weight-medium">
                                      Phone Number
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <i class="mdi mdi-information text-muted me-1"></i>
                                        <p class="mb-0 text-small text-muted">{{$settings->phonenumber}}</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100">
                                    <p class="mb-2 font-weight-medium">
                                      Logo
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                      <img src="{{ url('uploads/Images/'.$settings->logo) }}"
                                            style="height: 100px; width: 150px;">
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100">
                                    <p class="mb-2 font-weight-medium">
                                      Flavicon
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                      <img src="{{ url('uploads/Images/'.$settings->flavicon) }}"
                                            style="height: 50px; width: 100px;">
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                    </div>
                                </div>
                        </div>
                            
                            
                            
                        </div>

                        <div id="invoice" class="tab-pane fade show">
                            <h4>Invoice Se</h4>
                            
                            
                            
                        </div>
                     
           



    </div>
    @endif
</div>
@endsection