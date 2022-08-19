@extends('layouts.admin')

@section('content')
    
    

<div class="container">
    <!---------  breadcrumbs ---------------->
    <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;User Pages</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Users</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Users</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>

     <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-end">Add new user</a></br>
                    <h4>List of Users</h4> 
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
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>
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
                        <thead  class="sticky-header">
                            <tr class="tableheading">
                            <th data-sortable="true">#</th>
                            <th data-sortable="true">Name</th>
                            <th>Email</th>
                            <th data-sortable="true">Roles</th>
                            <th>Actions</th>    
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <span class="badge bg-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
  
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i></a>
                                   
                                   
                                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
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
