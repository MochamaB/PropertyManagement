
@extends('layouts.admin')

@section('content')

<div class="container">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Maintenance</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Repairs</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->

@include('layouts.partials.messages')	
            
               
                <br />
                       <button class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/add-maintenance") }}'">
                         <i class="menu-icon mdi mdi-broom"></i>New Repair Request </button>
                       <br />
                   
                    <h4>List of Repairs</h4>
                     
                
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
                                <thead class="sticky-header">
                                    <tr class="tableheading">
                                    <th></th>
                                <th data-sortable="true">Tenant</th>
                                <th data-sortable="true">Priority</th>
                                <th data-sortable="true">Type</th>
                                <th data-sortable="true">Raised On</th>
                                <th data-sortable="true">Assigned To</th>
                                <th data-sortable="true">Title</th>
                                <th data-sortable="true">Work ID</th>
                                <th data-sortable="true">Total Cost</th>
                                <th data-sortable="true">Status</th>

                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody style="padding-left:0; padding-right:0px">
                            @foreach ($maintenance as $key => $item)       
                        <tr>
                                <td>{{ $key+1 }}</td>
                                
                                <td>                                       <!------Tenant -->
                                        <div class="d-flex ">
                    
                                        <img src="https://invoices.infyom.com/assets/images/avatar.png" alt="">
                                        <div>
                                            <h6>{{ $item->firstname }} {{ $item->lastname }} - <a href=""  style="font-size:12px; color:blue">
                                            {{ $item->maintenanceno }} </a></h6>
                                            <p>{{ $item->email }}</p>
                                            
                                        </div>
                                        </div>
                                </td>
                                <td>{{$item->priority}}</td>
                                <td>{{$item->billtype}}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                @if($item->assignedto == null)
                                <td>NOT ASSIGNED</td>
                                @else
                                <td>{{$item->assignedto}}</td>
                                @endif

                                <td>{{$item->title}}</td>

                                @if($item->Workid == null)
                                <td><div  class="badge badge-opacity-warning">NOT STARTED </div></td>
                                @else
                                <td>{{$item->Workid}}</td>
                                @endif
                                 <!------Invoice Date -->
                                <td>{{$item->amountpaid + $item->amountspent}}</td> <!------Pay Date -->
                                
                                
                                @if($item->status == null)
                                <td><div  class="badge badge-opacity-warning">NOT STARTED </div></td>
                                @else
                                <td>{{$item->status}}</td>
                                @endif
                                
                                <td>
                                @if( $item->Workid  != null)
                                <a  href="{{ url('show-workorder/'.$item->id) }}" style="background-color:green" class="btn btn-warning btn-sm"><i class="mdi mdi-cash-usd"></i></i>View WorkOrder</a>
                                  @else
                                 <a href="{{ url('add-repairwork/'.$item->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-cash-usd"></i></i>Create Work Order</a>
                                @endif
                                <a href="{{ url('edit-maintenance/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i></a>
                                <a href="{{ url('delete-maintenance/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
     
                                </td>
                                @endforeach
                        </tr>

                    </tbody>

                    </table>

                
            </div>
 
</div>

@endsection
