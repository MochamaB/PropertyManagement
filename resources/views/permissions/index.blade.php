@extends('layouts.admin')

@section('content')
    
<div class="container-fluid">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Settings</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Permissions</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Permissions</span></a> </li>
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
                        <button type="button" class="btn-success float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
				@endif
                <br />
                       <button class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/permissions/create") }}'">
                         <i class="mdi mdi mdi-file-document"></i>Create New Permission</button>
                       <br />
                    <h4>List of All Permissions</h4>
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
                                   data-page-list="[50, 100, 200, 250, 500, ALL]"
                                   data-page-size="50"
                                   data-show-footer="false"
                                   data-side-pagination="client"
                                   
                                   class="table table-hover table-striped"
                                   style="font-size:12px">
                                <thead style="" class="sticky-header">
                                    <tr class="tableheading">
                                        <th data-sortable="true"></th>
                                        <th data-sortable="true">Permission Name</th>
                                        <th>Created On</th>
                                        <th>Updated On</th>
                                        <th>Actions</th>
                                        
                                    </tr>

                                </thead>
                                <tbody style="padding-left:0; padding-right:0px;">
                                @foreach ($permissions as $key => $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td> 
                                <td>{{\Carbon\Carbon::parse($permission->created_at)->format('d M Y') }}</td>
                                <td>{{\Carbon\Carbon::parse($permission->updated_at)->format('d M Y') }}</td>
                                <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('permissions.edit', $permission->id) }}"><i class="mdi mdi-lead-pencil"></i></a>
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
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
