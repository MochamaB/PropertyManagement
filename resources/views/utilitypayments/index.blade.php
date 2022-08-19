@extends('layouts.admin')

@section('content')


<div class="container">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Utilities</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Utility Payments</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>


<!---------  breadcrumbs ---------------->

            @if (session('status'))
                <h6 class="alert alert-success alert-dismissible">{{ session('status') }}</h6>
            @endif
           
                                                                   
                
                     <div style="align-items:end">
                        <br />
                       <button class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/add-utilitypayments") }}'">
                         <i class="mdi mdi-layers-outline"></i>Add new Utility Payment</button>
                       </div><br />
                    <h4>List of All Utility Payments</h4>
                
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
                                <th data-sortable="true">Billing Month</th>
                                <th>House No</th>  
                                <th>Utility Paid</th>
                                <th>Tenant</th>                             
                                <th>Amount Due</th>
                                <th>Amount Paid</th>
                                <th>Current Balance</th>
                                <th>Details</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($Utilitypayments as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m') }}</td>
                                <td>{{ $item->housenumber }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->firstname }}{{ $item->lastname }}</td>
                                <td>{{ $item->utilityamountdue }}</td>
                                <td>{{ $item->amountpaid }}</td>
                                <td></td>
                                <td></td>
                                <td>
                                   
                                </td>
                                <td>
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            
   
</div>
@endsection
