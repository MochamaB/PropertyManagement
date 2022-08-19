@extends('layouts.admin')

@section('content')

<div class="container">
            <div class="col-12 grid-margin">
            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

	<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Properties</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Leases</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Edit Lease</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->

            <div class="card">
                 <div class="card-header">
                    <br />
                    <a href="{{ url('leases') }}" class="btn btn-danger float-end">View All Leases</a><br/>
                    <h4>Edit Assign House/ Add Lease</h4>
                </div>
              
           <div class="card-body">
                    <p class="card-description">
                      Lease info
                    </p>
                    <form action="{{ url('update-lease/'.$lease->id) }}" method="POST">
                        @csrf
                           
                       <div class="row mt-2">
                             <div class="col-md-6">
                                    <label class="labels">House Category</label>
                                       <input type="text" name="email" value="{{$leasedetails->type}}" class="form-control" readonly/>
                                            
                              </div>
                              <div class="col-md-6">
                                    <label class="labels">House Number</label>
                                    <input type="text" name="email" value="{{$leasedetails->housenumber}}" class="form-control" readonly/>
                                    
                              </div>
                       </div>
                               <div class="row mt-3">
                                            <div class="col-md-6"><label class="labels">Lease Number</label>
                                            <input type="text" name="email" value="{{$leasedetails->leaseno}}" class="form-control" readonly/>
                                            
                                            </div>

                                            <div class="col-md-6"><label class="labels">Tenant Names</label>
                                                <input type="text" name="email" value="{{$leasedetails->firstname}} {{$leasedetails->lastname}}" class="form-control" readonly/>
                                            </div>
                                            </br>
                                            <div class="col-md-6"><label class="labels">Rent</label>
                                                <input type="text" name="email" value="{{$leasedetails->actualrent}}" class="form-control" />
                                             </br>   
                                            </div>
                                            </br>
                                            <div class="col-md-6"><label class="labels">Deposit</label>
                                                <input type="text" name="email" value="{{$leasedetails->actualdeposit}}" class="form-control" />
                                            </div>
                                            
                                            <div class="col-md-6"><label class="labels">Date lease started</label>
                                                <input type="text" name="email" value="{{$leasedetails->created_at}}" class="form-control" readonly/>
                                              
                                            </br>
          
                                             </div>
                                        
                   
                                        </div>

                            
                                
                        <!---- ------------------------>

                        
                            
                        
                        

               
             
                      <div class="form-group mb-3" style="float:right">
                            <button type="submit" class="btn btn-primary">Edit Lease</button>
                      </div>
                    
          </div>
      </div>
   </div>

@endsection
