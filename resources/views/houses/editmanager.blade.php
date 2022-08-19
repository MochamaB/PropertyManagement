@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Properties</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Houses</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Add House Managers</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>
     
     
     @if (session('status'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Sucess! </strong> {{ session('status') }}.  <a href="{{ url('tenants/') }}" class="alert-link">Back to tenants</a>
                        <button type="button" class="btn-success float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
				@endif

        @if($errors->all())
            <h6 class="alert alert-danger">Check Error messages in the form!</h6>
            @endif
            @if (session('statuserror'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error! </strong> {{ session('statuserror') }}. 
                        <button type="button" class="btn-danger float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
			@endif
        <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    </br>
                    <h4>Add Managers To Houses</h4>
                </div>
                <div class="card-body">
                <form action="{{ url('store-housemanagers/'.$houses->id) }}" method="POST">
                                @method('post')
                                @csrf
                        <table id="table"  class="table table-hover table-striped">
                        <thead  class="sticky-header">
                                    <tr class="tableheading">
                                        <th data-sortable="true"></th>
                                        <th data-sortable="true">Name (click to add)</th>
                                       
                                    </tr>
                                </thead>
                                <tbody style="padding-left:0; padding-right:0px">

                                    @foreach ($user as $item)
                                    <tr>
                                        <td></td>
                                        
                                        <td><input type="checkbox" name="user_id[{{ $item->id }}]"
                                            value="{{ $item->id }}"
                                            class='permission'>  &nbsp;&nbsp;{{ $item->name }}
                                        </td>
                                        
                                                         
                                    </tr>
                                    @endforeach
                                    </tbody>
                        </table></br>
                        
                        
                        @if( Auth::user()->can('House.store_managers'))
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save Managers</button>
                        </div>
                        @endif

                    </form>
                    

                </div>
            </div>
        
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                <a href="{{ url('house') }}" class="btn btn-danger float-end">Back to Houses</a><br/>
                    <h4> Remove Managers of Houses</h4>
                </div>
                <div class="card-body">
                <div class=" table-responsive">
                <form action="{{ url('update-housemanagers/'.$houses->id) }}" method="POST">
        @method('put')
        @csrf 
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
                                <thead class="sticky-header">
                                    <tr class="tableheading">
                                        <th data-sortable="true"></th>
                                        <th data-sortable="true">Current Managers (Click to remove)</th>
                                       
                                    </tr>
                                </thead> 
                    <tbody style="padding-left:0; padding-right:0px">

                            @foreach ($managerview as $item)
                          
                            <tr>
                                <td></td>
                              
                                <td><input type="checkbox" name="user_id[]"
                                            value="{{ $item->user_id }}" id="user_id"  
                                            class='permission'>  &nbsp;&nbsp;{{ $item->name }}
                                        
                                           
                                        </td>
                          
                                             
                            </tr>
                           
                            @endforeach
                        </tbody>
           
                    </table>
                @if( Auth::user()->can('House.store_managers'))
                    <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Managers</button>
                        </div>
                </div>
                @endif
                
                </form>

                </div>
            </div>
        
    </div>
    </div>


     </div>

@endsection