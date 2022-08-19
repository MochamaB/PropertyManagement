@extends('layouts.admin')

@section('content')
    
<div class="container-fluid">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Settings</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Roles</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Roles</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    
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
                <br />
                       <button class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/roles/create") }}'">
                         <i class="mdi mdi mdi-file-document"></i>Create New Role</button>
                       <br />
                    <h4>List of All Roles</h4>
                <div class="table-responsive"> 
                    <table id="table"
                                   
                                   data-toggle="table"
                                   data-icon-size="sm"
                                   data-toolbar-align="right"
                                   data-buttons-align="left"
                                   data-search-align="left"
                                   data-maintain-selected="true"
                                   data-sort-name="First Name"
                                   data-sort-order="asc"
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
                                        <th data-sortable="true"></th>
                                        <th data-sortable="true">Role Name</th>
                                        <th>User Level</th>
                                        <th>Created On</th>
                                        <th>No of Permissions</th>
                                        <th>Actions</th>
                                        
                                    </tr>

                                </thead>
                                <tbody style="padding-left:0; padding-right:0px;">
                                @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $role->name }}</td> 
                                <td></td>
                                <td>{{\Carbon\Carbon::parse($role->created_at)->format('d M Y') }}</td>
                                <td></td>
                                <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}"><i class="mdi mdi-lead-pencil"></i></a>
                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}   
                                </td>
                                  </tr>
                                  @endforeach
                        </tbody>
                    </table>
                </div>

              
          
     
</div>
@endsection
