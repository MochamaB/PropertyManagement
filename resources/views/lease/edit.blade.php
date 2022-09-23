@extends('layouts.admin')

@section('content')

<div class="container">
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
            <div class="col-7 grid-margin">
            @include('layouts.partials.messages')	

	

            <div class="card">
                 <div class="card-header">
                    <br />
                    <a href="{{ url('leases') }}" class="btn btn-danger float-end">View All Leases</a><br/>
                    <h4>Edit Assign House/ Add Lease</h4>
                </div>
                <div class="card-body">
                
                <form action="{{ url('update-lease/'.$lease->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                
                     
                        <div class="form-group  mb-3">
                            
                                      <label for="">Rent Amount <span style="color:red;font-size:20px">*</span></label></br>
                              
                                      <input id = "rent" type="text" name="rent" value="{{$leasedetails->rent}}" class="form-control" />
                                      @if ($errors->has('rent'))
                                          <span class="text-danger" style="font-size:12px">{{ $errors->first('rent') }}</span>
                                          @endif
                        </div>  
                        <div class="form-group mb-3">
                                      <label for="">Deposit Amount <span style="color:red;font-size:20px">*</span></label></br>
                                      <input type= "text"  id="deposit" class="form-control" value="{{$leasedetails->deposit}}" name="deposit" value="{{ old('deposit') }}">
                                      @if ($errors->has('deposit'))
                                          <span class="text-danger" style="font-size:12px">{{ $errors->first('deposit') }}</span>
                                          @endif
                        </div>
                        <div class="form-group mb-3">
                                          <label for="">Start Date <span style="color:red;font-size:20px">*</span></label>
                                          <input type="date" name="startdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" />
                                     
                                              @if ($errors->has('startdate'))
                                                  <span class="text-danger" style="font-size:12px">{{ $errors->first('startdate') }}</span>
                                              @endif
                          </div>
                          <div class="form-group mb-3">
                                          <label for=""> End Date <span style="color:red;font-size:20px">*</span></label>
                                          <input type="date" name="enddate" value="<?php echo date('Y-m-d'); ?>"  class="form-control" />
                                              @if ($errors->has('todate'))
                                                  <span class="text-danger" style="font-size:12px">{{ $errors->first('todate') }}</span>
                                              @endif
                                          </div>
                        <div class="form-group mb-3">
                                      <label for="">Status <span style="color:red;font-size:20px">*</span></label></br>
                                      <select  class="formcontrol2" name="status" >
                                        <option value="">Select Status of Lease</option>
                                        <option value="Active">Active</option>
                                        <option value="In_Active">In Active</option>
                                        <option value="Suspended">Suspended</option>
                                    </select>
                                    
                                      @if ($errors->has('status'))
                                          <span class="text-danger" style="font-size:12px">{{ $errors->first('status') }}</span>
                                          @endif
                        </div>   
                       
                        <div class="form-group  mb-3">
                                <label for="">Terms </label></br>
                                    <textarea  name="terms" rows="4"class="form-control" cols="50" value="{{ old('terms') }}"> {{$leasedetails->terms}}</textarea>
                                  @if ($errors->has('terms'))
                                            <span class="text-danger" style="font-size:12px">{{ $errors->first('terms') }}</span>
                                            @endif
                  
                          </div>        

                         
                          

             
           
                    <div class="form-group mb-3" style="float:right">
                          <button type="submit" class="btn btn-primary">Edit Lease</button>
                      </div>
                </form>
              </div>
   
      </div>
   </div>

@endsection
