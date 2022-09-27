
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
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Job Work Orders</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->

@include('layouts.partials.messages')	
            
               
                <br />
                       <button class="btn btn-danger btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/YearViewrepairwork") }}'">
                         <i class="menu-icon mdi mdi-broom"></i>All Repairs </button>
                       <br />
                   
                    <h4>List of Work Orders</h4>
                     
                
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
                                <th data-sortable="true">Workid</th>
                                <th data-sortable="true">Desc</th>
                                <th data-sortable="true">Date of Repair</th>
                                <th data-sortable="true">Amount spent</th>
                                <th data-sortable="true">Amount Paid</th>
                                <th data-sortable="true">Last Updated</th>
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
                                <td>{{$item->Workid}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{\Carbon\Carbon::parse($item->dateofrepair)->format('d M Y') }}</td>
                                
                                <td>{{$item->amountspent}}</td>
                                
                                
                                <td>{{$item->amountpaid}}</td>
                                
                                 <!------Invoice Date -->
                                <td>{{\Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</td> <!------Pay Date -->
                                
                                
                                
                                <td>{{$item->status}}</td>
                                
                                
                                <td>
                                <a  href="{{ url('show-workorder/'.$item->id) }}" style="background-color:green" class="btn btn-warning btn-sm"><i class="mdi mdi-cash-usd"></i></i>View WorkOrder</a>
                                <a href="{{ url('edit-workorder/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i>Add Comments</a>
                                <a href="" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
     
                                </td>
                              
                        </tr>
                            @endforeach
                    </tbody>

                    </table>

                
            </div>
 
</div>

@endsection
