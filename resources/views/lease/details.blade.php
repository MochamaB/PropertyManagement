
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
	<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Lease</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Lease Details</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    <div class="col-12 grid-margin">
        @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
             <div class="card">
                 <div class="card-header">
                    <br />
                    <a href="{{ url('leases') }}" class="btn btn-danger float-end">Back to Lease view</a><br/>
                    <h4>Lease Details</h4>
                </div>

                <div class="card-body">
   
                            <div class="row">
   
                                <div class="col-md-7 border-right">
                                    <div class="p-3 py-5">
                                    
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                            <label class="labels">House Category</label>
                                            <p class="profile-labels">{{$leasedetails->type}}</p>
                                             </div>
                                            <div class="col-md-6">
                                            <label class="labels">House Number</label><p class="profile-labels">{{$leasedetails->housenumber}}</p>
                                             </div>                </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12"><label class="labels">Lease Number</label><p class="profile-labels">{{$leasedetails->leaseno}}</p>
                                             </div>
                                                                <div class="col-md-12"><label class="labels">Tenant Names</label><p class="profile-labels">{{$leasedetails->firstname}} {{$leasedetails->lastname}}</p>
                                             </div>
                                                                <div class="col-md-12"><label class="labels">Rent</label><p class="profile-labels">{{$leasedetails->actualrent}}</p>
                                             </div>
                                                                <div class="col-md-12"><label class="labels">Deposit</label><p class="profile-labels">{{$leasedetails->actualdeposit}}</p>
                                             </div>
                                                                <div class="col-md-12"><label class="labels">Date lease started</label><p class="profile-labels">{{$leasedetails->created_at}}</p>
                                            </br>
          
                                             </div>
                                        
                   
                                        </div>

                                        <div class="vol-md-4 mt-5 text-center">
                                        <a href="{{ url('edit-lease/'.$lease->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"> Edit Lease</i></a>
                                       
                                        </div>

                                    </div>
                                </div>
                                
                            </div>
</div>
</div>
</div>

</div>
@endsection
