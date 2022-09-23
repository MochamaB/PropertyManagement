
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
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Houses</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->

                @include('layouts.partials.messages')
            
               
                <br />
                @if( Auth::user()->can('House.create'))
                       <button class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/add-house") }}'">
                         <i class="mdi mdi-account-plus"></i>Add new House</button>
                       <br />
                @endif
                    <h4>List of Houses</h4>
                     
                
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
                                <th data-sortable="true">ID</th>
                                <th data-sortable="true">House Number</th>
                                <th data-sortable="true">Type</th>
                                <th data-sortable="true">Status</th>
                                <th>Rent</th>
                                @if( Auth::user()->can('Apartments.create'))
                                        <th data-sortable="true">Apartment</th>
                                        @endif
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($houses as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->housenumber }}</td>
                                <td>{{ $item->housecategories->type }}</td>
                                <td>{{ $item->status }}</td>                        
                                <td>{{ $item->housecategories->rent }}</td>
                                @if( Auth::user()->can('Apartments.create'))
                                        <td>{{$item->apartment->name}}</td>
                                        @endif
                                <td>
                                <a href="{{ url('add-lease/'.$item->id) }}" class="btn btn-info btn-sm">Details</a>
                                @if( Auth::user()->can('House.view_managers'))
                                    <a href="{{ url('view-housemanagers/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-account-multiple"></i>Managers</a>
                                @endif
                                <a href="{{ url('edit-house/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i></a>
                                
                                    <a href="{{ url('delete-house/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                
            </div>
 
</div>

@endsection
