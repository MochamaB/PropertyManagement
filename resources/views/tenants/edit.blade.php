@extends('layouts.admin')

@section('content')

<div class="container">
            <div class="col-12 grid-margin">
            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
            <div class="card">
                 <div class="card-header">
                    <br />
                    <a href="{{ url('tenants') }}" class="btn btn-danger float-end">Back to Tenant view</a><br/>
                    <h4>Edit Tenant Information</h4>
                </div>
              
                <div class="card-body">
                    <p class="card-description">
                      Personal info
                    </p>
                    <form action="{{ url('update-tenants/'.$tenants->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">First Name</label>
                                  <div class="col-sm-9">
                                    <input type="text" name="firstname" value="{{$tenants->firstname}}" class="form-control" />
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
                            <input type="text" name="lastname" value="{{$tenants->lastname}}" class="form-control" />
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
                         <input type="text" name="email" value="{{$tenants->email}}" class="form-control" />
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
                            <input class="form-control" name="phonenumber" value="{{$tenants->phonenumber}}"  placeholder="+254"/>
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
                         <input type="text" name="idnumber" value="{{$tenants->idnumber}}"  class="form-control" />
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
                            <select class="form-control" value="{{$tenants->occupation}}"  name="occupation">
                              <option value="Health Sector">Health Sector</option>
                              <option value="Engineering">Engineering</option>
                              <option value="Finance">Finance</option>
                              <option value="Education">Education</option>
                              <option value="ICT">ICT</option>
                              <option value="Business">Business</option>
                              <option value="Self Employed">Self Employed</option>
                              <option value="Law">Law</option>
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
                            <input type="text" name="company" value="{{$tenants->company}}"  class="form-control" />
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    <p class="card-description">
                      Emergency Contacts
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Name</label>
                          <div class="col-sm-9">
                            <input type="text" name="emergencyname" value="{{$tenants->emergencyname}}"  class="form-control" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Phone Number</label>
                          <div class="col-sm-9">
                            <input type="text" name="emergencynumber" value="{{$tenants->emergencynumber}}"  class="form-control" placeholder="+254" />
                          </div>
                        </div>
                      </div>
                     
                    </div>
                    <div class="form-group mb-3" style="float:right">
                            <button type="submit" class="btn btn-primary">Update Tenant</button>
                        </div>
                  </form>
                </div>
              </div>
            </div>
   
</div>

@endsection

