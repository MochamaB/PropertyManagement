
@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Properties</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Tenants</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Tenants</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    
@if (session('status'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Sucess! </strong> {{ session('status') }}.  <a href="{{ url('Invoices/') }}" class="alert-link">  ->Go to Houses section</a>
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
            @if( Auth::user()->can('Tenants.create'))
                       <button class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/add-tenants") }}'">
                         <i class="mdi mdi-account-plus"></i>Add new Tenant</button>
            @endif
                       <br />
                    <h4>List of Tenants</h4>
                
                <div class=" table-responsive"> 
                    <table id="table"
                                   
                                   data-toggle="table"
                                   data-icon-size="sm"
                                   data-toolbar-align="right"
                                   data-buttons-align="left"
                                   data-buttons-class="primary"
                                   data-search-align="left"
                                   data-maintain-selected="true"
                                   data-search="true"
                                   data-show-pagination-switch="true"
                                   data-sticky-header="true"
                                   data-pagination="true"
                                   data-page-list="[100, 200, 250, 500, ALL]"
                                   data-page-size="100"
                                   data-show-footer="false"
                                   data-side-pagination="client"
                                   
                                   class="table table-hover table-striped"
                                   style="font-size:12px">
                                <thead style="" class="sticky-header">
                                    <tr class="tableheading">
                                        <th data-sortable="true">ID</th>
                                        <th data-sortable="true">First Name</th>
                                        <th>Last Name</th>
                                        <th>Id Number</th>
                                        <th >Email </th>
                                        <th>Phone Number </th>
                                        @if( Auth::user()->can('Apartments.create'))
                                        <th>Apartments</th>
                                    @endif   
                                        <th>Profile</th>
                                        <th>Actions</th>
                                        
                                       
                                    </tr>

                                </thead>
                                
        
                  
                    <tbody style="padding-left:0; padding-right:0px">
                    @role('Tenant')
                            @foreach ($tenantview  as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                
                                <td>{{ $item->firstname }}</td>
                                <td>{{ $item->lastname }}</td>
                                <td>{{ $item->idnumber }}</td>
                                <td>{{ $item->email }}</td>                        
                                <td>{{ $item->phonenumber }}</td>
                                <td><a href="{{ url('profile-tenants/'.$item->ID) }}" class="btn btn-danger btn-sm"><i class="mdi mdi-account-card-details"></i></a></td>
                                <td></td>    
                            </tr>
                            @endforeach
                    @else        
                            @foreach ($managerview  as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                
                                <td>{{ $item->firstname }}</td>
                                <td>{{ $item->lastname }}</td>
                                <td>{{ $item->idnumber }}</td>
                                <td>{{ $item->email }}</td>                        
                                <td>{{ $item->phonenumber }}</td>
                            @if( Auth::user()->can('Apartments.create'))
                                <td>{{ $item->apartment->name }}</td>
                            @endif
                                <td><a href="{{ url('profile-tenants/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="mdi mdi-account-card-details"></i></a></td>
                                <td>
                                @if( Auth::user()->can('Tenants.attach_managers'))
                                    <a href="{{ url('attach-tenantmanagers/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-account-multiple"></i>Managers</a>
                                @endif
                                @if( Auth::user()->can('Tenants.create'))    
                                    <a href="{{ url('edit-tenants/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i></a>
                                    <a href="{{ url('delete-tenants/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a></td>
                                @endif    
                            </tr>
                            @endforeach
                    @endrole        
    

                           
                        </tbody>
             
                    </table>
                </div>
          
     
</div>

@endsection
