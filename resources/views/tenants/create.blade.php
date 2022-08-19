@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="container-fluid">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;PROPERTIES INFORMATION</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Tenants</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Create Tenants</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
            <div class="col-12 grid-margin">
            @if (session('status'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Sucess! </strong> {{ session('status') }}.  
                        <button type="button" class="btn-success float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
				@endif
				
				@if (session('statuserror'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error! </strong> {{ session('statuserror') }}.  
                        <button type="button" class="btn-danger float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
				@endif
				
				  @if($errors->all())
            <h6 class="alert alert-danger">Check Error messages in the form!</h6>
            @endif
          
            <div class="card">
                 <div class="card-header">
                    <br />
                    <a href="{{ url('tenants') }}" class="btn btn-danger float-end">View All Tenants</a><br/>
                    <h4>Add Tenant</h4>
                </div>
              
                <div class="card-body">
                    <p class="card-description">
                      Personal info
                    </p>
                    <form action="{{ url('add-tenants') }}" method="POST">
                        @csrf
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">First Name</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="firstname"class="form-control"  value="{{ old('firstname') }}"/>
                                     @if ($errors->has('firstname'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('firstname') }}</span>
                                    @endif
                                  </div>
                                </div>
                              </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }} "/>
                                @if ($errors->has('lastname'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('lastname') }}</span>
                                    @endif
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                         <input type="text" name="email" class="form-control" value="{{ old('email') }}" />
                                @if ($errors->has('email'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('email') }}</span>
                                    @endif
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone Number</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="phonenumber" placeholder="+254" value="{{ old('phonenumber') }}"/>
                                    @if ($errors->has('phonenumber'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('phonenumber') }}</span>
                                    @endif
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Id Number</label>
                          <div class="col-sm-9">
                         <input type="text" name="idnumber" class="form-control" value="{{ old('idnumber') }}"/>
                         @if ($errors->has('idnumber'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('idnumber') }}</span>
                                    @endif
                          </div>
                        </div>
                      </div>        

                    </div>
                    <p class="card-description">
                      Other Information
                    </p>
                    <div class="row">
                          <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Occupation</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="occupation">
                              <option value="Health Sector">Health Sector</option>
                              <option value="Engineering">Engineering</option>
                              <option value="Finance">Finance</option>
                              <option value="Education">Education</option>
                              <option value="ICT">ICT</option>
                              <option value="Business">Business</option>
                              <option value="Self Employed">Self Employed</option>
                              <option value="Law">Law</option>
                              <option value="Other">Other..</option>
                            </select>
                                @if ($errors->has('occupation'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('occupation') }}</span>
                                    @endif
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Company Employed</label>
                          <div class="col-sm-9">
                            <input type="text" name="company" class="form-control" value="{{ old('company') }}"/>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    <p class="card-description">
                      Emergency Contacts (Next of kin)
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="emergencyname" class="form-control" value="{{ old('emergencyname') }}" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone Number</label>
                          <div class="col-sm-9">
                            <input type="text" name="emergencynumber" class="form-control" value="{{ old('emergencynumber') }}" placeholder="+254" />
                          </div>
                        </div>
                      </div>
                    <div class="col-md-6">
                      @if( Auth::user()->can('Apartments.create'))
                        <label class="col-sm-3 col-form-label">Apartment</label>
                        <div class="col-sm-9">
                          <select class="formcontrol2" name="apartment_id" required>
                              <option value="">Select</option>
                              @foreach($apartment as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                              <select>
                                        @else
                                            <input type="hidden" name="apartment_id" value="{{ Auth::user()->apartment_id}}"/>            
                                        @endif
                          </div>
                      </div>
                     
                   
                     
                      
                        <div>
                         <input type="hidden" name="status" value="No Lease" />
                        </div>
    
                    <div class="form-group mb-3" style="float:right">
                            <button type="submit" class="btn btn-primary">Save Tenant</button>
                        </div>
                  </form>
                </div>
              </div>
            </div>
   
</div>

@endsection
