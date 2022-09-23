
@extends('layouts.admin')

@section('content')

<div class="container-fluid">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Lease</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Leases</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    
@include('layouts.partials.messages')	    
                <br />
                       <button class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/add-lease") }}'">
                         <i class="mdi mdi mdi-key"></i>Assign House</button>
                       <br />
                    <h4>List of Leases/ Tenancy</h4>
                
                <div class=" table-responsive"> 
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
                                <th>ID</th>
                                <th data-sortable="true">Lease Number</th>
                                <th data-sortable="true">House Number</th>
                                <th data-sortable="true">Tenant Name</th>
                                <th data-sortable="true">Rent</th>
                                <th>Deposit</th>
                                <th data-sortable="true">Assign Date</th>
                                <th data-sortable="true">Status</th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody style="padding-left:0; padding-right:0px">
                            @foreach ($lease as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->leaseno }}</td>
                                <td>{{ $item->house->housenumber }}</td>
                                <td>{{ $item->tenant->firstname }} {{ $item->tenant->lastname }}</td>
                                <td>{{ $item->rent }}</td>
                                <td>{{ $item->deposit }}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                <td>{{ $item->status }}</td>                         
                                <td>
                                <a href="{{ url('details-lease/'.$item->id) }}" class="btn btn-success btn-sm">Details</i></a>
                                <a href="{{ url('edit-lease/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i></a>
                                
                                 <a href="{{ url('delete-lease/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>

                                 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
          
     
</div>

@endsection
