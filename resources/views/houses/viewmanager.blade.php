@extends('layouts.admin')

@section('content')

<div class="container">
    <!---------  breadcrumbs ---------------->
    <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Properties</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Houses</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View House Managers</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>
<!---------  breadcrumbs ---------------->

                @if (session('status'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Sucess! </strong> {{ session('status') }}.  <a href="{{ url('leases/') }}" class="alert-link">Go to Leases</a>
                        <button type="button" class="btn-success float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
				@endif
				
				@if (session('statuserror'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error! </strong> {{ session('statuserror') }}.  <a href="{{ url('leases/') }}" class="alert-link">Go to Leases</a>
                        <button type="button" class="btn-success float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
				@endif
            
               
                
                <div class="col-md-7">
            <div class="card">
                <div class="card-header"><br />
                <a href="{{ url('house') }}" class="btn btn-danger float-end">Back to Houses</a><br/>
                    <h4> List Managers of House No. {{$houses->housenumber}}</h4>
                </div>
                <div class="card-body">
                <div class=" table-responsive">
                      <table id="table"
                                   class="table table-hover table-striped"
                                   style="font-size:12px">
                                <thead class="sticky-header">
                                    <tr class="tableheading">
                                        <th data-sortable="true">#</th>
                                        <th data-sortable="true">Current Managers</th>
                                       
                                    </tr>
                                </thead> 
                    <tbody style="padding-left:0; padding-right:0px">
                            @foreach ($managerview as $key => $item)    
                            <tr>
                                <td>{{$key+1}}</td>
                              
                                <td>{{ $item->name }}  
                                        </td>
                            </tr>
                            @endforeach
                        </tbody>          
                    </table></br>
                @if( Auth::user()->can('House.edit_managers'))
                    <div class="form-group mb-3">
                    <a href="{{ url('edit-housemanagers/'.$item->id) }}" class="btn btn-primary btn float-end">Add/Remove Managers</a>   
                        </div>
                </div>
                @endif
                

                </div>
            </div>
        
    </div>
   
                   

@endsection
