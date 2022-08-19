
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="col-12 grid-margin">
        @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
             <div class="card">
                 <div class="card-header">
                    <br />
                    <a href="{{ url('tenants') }}" class="btn btn-danger float-end">Back to Tenant view</a><br/>
                    <h4>Profile Details</h4>
                </div>

                <div class="card-body">
             
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{$tenants->firstname}}{{$tenants->lastname}}</span><span class="text-black-50">{{$tenants->email}}</span><span> </span></div>
                            </div>
                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                        <label class="labels">First Name</label>
                                        <p class="profile-labels">{{$tenants->firstname}}</p>
                                         </div>
                                        <div class="col-md-6">
                                        <label class="labels">Last Name</label><p class="profile-labels">{{$tenants->lastname}}</p>
                                         </div>                </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12"><label class="labels">Email</label><p class="profile-labels">{{$tenants->email}}</p>
                                         </div>
                                                            <div class="col-md-12"><label class="labels">Id Number</label><p class="profile-labels">{{$tenants->idnumber}}</p>
                                         </div>
                                                            <div class="col-md-12"><label class="labels">Phone Number</label><p class="profile-labels">{{$tenants->phonenumber}}</p>
                                         </div>
                                                            <div class="col-md-12"><label class="labels">Occupation</label><p class="profile-labels">{{$tenants->occupation}}</p>
                                         </div>
                                                            <div class="col-md-12"><label class="labels">Company</label><p class="profile-labels">{{$tenants->company}}</p>
                                        </br>
                                         <div class="d-flex justify-content-between align-items-center mb-3">
                     
                                        <h5 class="text-right">Emergency Details</h5>
                                        </div>
                                         </div>
                                                            <div class="col-md-12"><label class="labels">Name or Relationship</label><p class="profile-labels">{{$tenants->emergencyname}}</p>
                                         </div>
                                                            <div class="col-md-12"><label class="labels">Phone Number</label><p class="profile-labels">{{$tenants->emergencynumber}}</p>
                                         </div>
                   
                                    </div>

                                    <div class="mt-5 text-center"><a href="{{ url('edit-tenants/'.$tenants->ID) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"> Edit Tenant</i></a></div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    </div>
                 </div>
                     
            </div>
    </div>
</div>
@endsection
