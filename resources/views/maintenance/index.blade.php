
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
                      <strong>Error! </strong> {{ session('statuserror') }}.  <a href="{{ url('leases/') }}" class="alert-link">Go to Leases</a>
                        <button type="button" class="btn-success float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
				@endif
            
               
                <br />
                       <button class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/add-maintenance") }}'">
                         <i class="menu-icon mdi mdi-broom"></i>New Repair Request </button>
                       <br />
    <!--------------   IF THERES NO DATA  ------------>
                    @if($maintenance == null)
                       <br /> <br /><br />
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong><i class="menu-icon mdi mdi-information"></i>No records available! </strong> <a href="{{ url('invoices/') }}" class="alert-link"> Create a Repair Request</a> 
                        <button type="button" class="btn-danger float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        @endif
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
                                <th data-sortable="true"></th>
                                <th data-sortable="true">Year</th>
                                <th data-sortable="true">No Of Repairs</th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                @if (Route::currentRouteName() == 'YearViewmaintenance')
                        <tbody>
                            
                        @foreach($maintenanceyeargroup as $key => $item)
                                       <tr>
                                           <td>{{ $key+1 }}</td>
                                           <td>{{$item->year}}</td>
                                           <td>{{$item->noofrepairs}}</td> 
                                           <td>
                                           <a href="{{ url('MonthViewmaintenance/'.$item->year) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-calendar-multiple"></i> Month View </a>
                    
                                           </td>
                                       </tr>
                        @endforeach
                        </tbody>
                    @endif
                    @if (Route::currentRouteName() == 'MonthViewmaintenance')
                        <tbody>
                            
                        @foreach($maintenancemonthgroup as $key => $item)
                                       <tr>
                                           <td>{{ $key+1 }}</td>
                                           <td>{{$item->year}} - {{$item->month}}</td>
                                           <td>{{$item->noofrepairs}}</td> 
                                           <td>
                                           <a href="{{ url('Viewmaintenance/'.$item->year. '/' . $item->month) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-calendar-multiple"></i>View Details</a>
                    
                                           </td>
                                       </tr>
                        @endforeach
                        </tbody>
                    @endif
                    </table>

                
            </div>
 
</div>

@endsection
