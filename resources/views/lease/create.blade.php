@extends('layouts.admin')

@section('content')


<div class="container-fluid">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;PROPERTIES INFORMATION</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Lease</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Assign Tenants</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
      <div class="col-12 grid-margin">

      @include('layouts.partials.messages')

          <div class="card">
                <div class="card-header">
                    <br />
                    <a href="{{ url('leases') }}" class="btn btn-danger float-end">View All Leases</a><br/>
                    <h4>Assign House/ Add Lease</h4>
                </div>
              
                <div class="card-body">
                
                  <form action="{{ url('add-lease') }}" method="POST">
                        @csrf
                     
                        <div class="form-group col-md-6 mb-3">
                        @if( Auth::user()->can('Apartments.create'))
                                                <label  style="font-size:13px;font-weight:500;">Apartment</label></br>
                                                <select class="formcontrol2" name="apartment_id" required>
                                                    <option value="">Select Apartment</option>
                                                    @foreach($apartment as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                    <select>
                                
                                                    
                                        @else
                                            <input type="hidden" name="apartment_id" value="{{ Auth::user()->apartment_id}}"/>            
                                        @endif

                          </div>  
                        <div class="form-group col-md-6 mb-3">
                            <label for="">Select House Number <span style="color:red;font-size:20px">*</span></label></br>
                                <select  id="housenumber" class="formcontrol2" name="house_id" required>
                                  <option>Select House Number</option>
                                    @foreach ($house as $houses)
                                    <option value="{{$houses->id}}">
                                        {{$houses->housenumber}}
                                        @if( Auth::user()->can('Apartments.create')) - {{$houses->apartment->name}} @endif
                                    </option>
                                    @endforeach
                                </select>
                          </div>  
                          <div class="form-group col-md-6 mb-3">
                                        <label for="">Tenant <span style="color:red;font-size:20px">*</span></label></br>
                                        <select  id="Tenant" class="formcontrol2" name="tenant_id" required>
                                          <option>Select Tenant </option>
                                            @foreach ($tenant as $tenant)
                                            <option value="{{$tenant->id}}">
                                                {{$tenant->firstname}} {{$tenant->lastname}}
                                                @if( Auth::user()->can('Apartments.create')) - {{$tenant->apartment->name}} @endif
                                            </option>
                                          @endforeach
                                        </select>
                          </div> 
                          <div class="form-group col-md-6 mb-3">
                                        <label for="">Rent Amount <span style="color:red;font-size:20px">*</span></label></br>
                                        <input type= "text"  id="actualrent" class="form-control" name="actualrent" value="{{ old('actualrent') }}">
                                        @if ($errors->has('actualrent'))
                                            <span class="text-danger" style="font-size:12px">{{ $errors->first('actualrent') }}</span>
                                            @endif
                          </div>  
                          <div class="form-group col-md-6 mb-3">
                                        <label for="">Deposit Amount <span style="color:red;font-size:20px">*</span></label></br>
                                        <input type= "text"  id="actualdeposit" class="form-control" name="actualdeposit" value="{{ old('actualdeposit') }}">
                                        @if ($errors->has('actualdeposit'))
                                            <span class="text-danger" style="font-size:12px">{{ $errors->first('actualdeposit') }}</span>
                                            @endif
                          </div>
                          <div class="form-group col-md-6 mb-3">
                                        <label for="">Status <span style="color:red;font-size:20px">*</span></label></br>
                                        <input type= "text"  id="housenumber" class="form-control" value="active" name="status" readonly>
                                        @if ($errors->has('status'))
                                            <span class="text-danger" style="font-size:12px">{{ $errors->first('status') }}</span>
                                            @endif
                          </div>   
                         
                          <div class="form-group col-md-6 mb-3">
                                  <label for="">Terms </label></br>
                                      <textarea  name="terms" rows="4"class="form-control" cols="50" value="{{ old('terms') }}"></textarea>
                                    @if ($errors->has('terms'))
                                              <span class="text-danger" style="font-size:12px">{{ $errors->first('terms') }}</span>
                                              @endif
                    
                            </div>        

                           
                            

               
             
                      <div class="form-group mb-3" style="float:right">
                            <button type="submit" class="btn btn-primary">Create Lease</button>
                        </div>
                  </form>
                </div>
            </div>
      </div>
</div>

@endsection
