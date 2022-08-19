@extends('layouts.admin')

@section('content')


<div class="container">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Properties</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>House Categories</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Categories</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    
     @if (session('status'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Sucess! </strong> {{ session('status') }}.  <a href="{{ url('house/') }}" class="alert-link">  ->Go to Houses section</a>
                        <button type="button" class="btn-success float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>    
            @endif
            @if (session('statuserror'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error! </strong> {{ session('statuserror') }}.  <a href="{{ url('house/') }}" class="alert-link">  ->Go to Houses section</a>
                        <button type="button" class="btn-danger float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>    
            @endif
     
   
                     <div style="align-items:end">
                        <br />
                        <a href="{{ url('/add-housecategories') }}" class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right"><i class="mdi mdi-account-plus"></i>Add new Category</a>
                       </div><br />
                        <h4>List of House Categories</h4>
                     
                <div class="table-responsive">

                   <table id="table"
                                   
                                   data-toggle="table"
                                   data-icon-size="sm"
                                   data-toolbar-align="right"
                                   data-buttons-align="left"
                                   data-buttons-class="primary"
                                   data-search-align="left"
                                   data-show-export="true"
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
                                        <th>ID</th>
                                        @if( Auth::user()->can('Apartments.create'))
                                        <th data-sortable="true">Apartment</th>
                                        @endif
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Deposit</th>
                                        <th>Actions</th>
                                     </tr>
                                </thead>
                                <tbody>
                                    @foreach ($housecategories as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        @if( Auth::user()->can('Apartments.create'))
                                        <td>{{$item->apartment->name}}</td>
                                        @endif
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->setdeposit }}</td>
                                        <td style=>
                                        @if( Auth::user()->can('Housecategories.edit'))
                                            <a href="{{ url('edit-housecategories/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i></a>
                                        @endif
                                        @if( Auth::user()->can('Housecategories.destroy'))
                                            <a href="{{ url('delete-housecategories/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                    </table>
                </div>

    
</div>
@endsection
