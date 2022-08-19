
@extends('layouts.admin')

@section('content')

<div class="container-fluid">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Invoice</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Invoices</span></a> </li>
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
                        <button type="button" class="btn-danger float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
				@endif           
                <br />

                           
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                      <ul class="nav nav-tabs" role="tablist">
                      @foreach($invoiceitems as $item)
                            <li class="nav-item">
                              <a class="nav-link  {{ (request()->segment(5) == $item->name) ? 'active' : '' }} " id="{{$item->name}}-tab" data-bs-toggle="tab" href="#{{$item->name}}" role="tab" aria-controls="overview" aria-selected="false">{{$item->name}} Invoices</a>
                            </li>
                          @endforeach  
                           
                          
                      </ul>
                </div>

                  <div class="tab-content">
                  <h4>List of All {{ $invoice->invoicetype}} Invoices</h4>
                 
            <!-------------------/////////////////////////-------------Rent Invoice------ --------------------------------- ////////////////////// ------------------------------------>
            <div class=" table-responsive"> 
                <a href="{{ url('invoices') }}" class="btn btn-danger text-white mb-0 me-0 float-end"><i class="mdi mdi-keyboard-return">Back To Invoice List</i></a>
   
                                   <table id="table"
                                   
                                        data-toggle="table"
                                        data-icon-size="sm"
                                        data-show-export="true"
                                        data-buttons-class="primary"
                                        data-toolbar-align="right"
                                        data-buttons-align="left"
                                        data-search-align="left"
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
                                        data-show-columns="true"
                                        data-show-refresh='true'
                                   
                                        class="table table-hover table-striped"
                                        style="font-size:12px">
                                        <thead  class="sticky-header">
                                                <tr class="tableheading">
                                                    <th>No.</th>
                                                    <th data-sortable="true">Tenant</th>
                                                    <th data-sortable="true">Invoice Date</th>
                                                    <th data-sortable="true">Due Date</th>
                                                    <th>Amount Due</th>
                                                    <th>Amount Paid</th>
                                                    
                                                    <th>Balance</th>
                                                    <th data-sortable="true">Status</th>
                                                    <th>Actions</th>
                                
                                                </tr>
                                            </thead>
                                            <tbody style="padding-left:0; padding-right:0px">
                                                  @foreach ($details as $key => $item)       
                                                <tr>
                                                     <td>{{ $key+1 }}</td>
                                                      
                                                     <td>                                       <!------Tenant -->
                                                              <div class="d-flex ">
                                         
                                                                <img src="https://invoices.infyom.com/assets/images/avatar.png" alt="">
                                                                <div>
                                                                  <h6>{{ $item->firstname }} {{ $item->lastname }} - <a href="{{ url('details-invoice/'.$item->id. '/' . $item->lease_id. '/' . $item->invoicedate. '/' . $item->invoicetype) }}"  style="font-size:12px; color:blue">
                                                                  {{ $item->invoiceno }}</a></h6>
                                                                  <p>{{ $item->email }}</p>
                                                                  
                                                                </div>
                                                              </div>
                                                     </td>
                                                     <td>{{\Carbon\Carbon::parse($item->invoicedate)->format('d M Y') }}</td> <!------Invoice Date -->
                                                     <td>{{\Carbon\Carbon::parse($item->duedate)->format('d M Y') }}</td> <!------Due Date -->
                                                     <td><h6 style="color:blue">{{$item->invoicetype}}<h6>
                                                        <p><span style="font-size:14px;font-weight:700">KSH:{{ $item->amountdue }}</span></p> <!------Amount Due -->
                                      
                            
                                                     </td>
                                                     
                                                        @if( $item->payments->count() == null)
                                                            <td><div class="badge badge-opacity-warning">NONE</div></td>  <!------Amount Paid -->                                
                                                        @else
                                                     <td><b style="">KSH: {{$item->payments->sum('amountpaid')}}</b></td>
                                                        @endif
                                                       
                                                     <!------Previous Balance -->
                                                     <td>KSH: {{ $item->amountdue - $item->payments->sum('amountpaid')  }}</td> <!------Balance -->
                                                     
                                                     @if( $item->amountdue -$item->payments->sum('amountpaid') == 0 )
                                                     <td><div style="background-color:green" class="badge badge-opacity-warning"> PAID</div></td> <!------Status -->
                                                     @elseif( $item->amountdue - $item->payments->sum('amountpaid') < 0  )
                                                     <td><div style="background-color:darkorange" class="badge badge-opacity-warning"> OVER PAID</div></td>
                                                     
                                                     @elseif ( $item->payments->count()  != null)
                                                     <td><div style="background-color:blue" class="badge badge-opacity-sucess"> PARTIALLY PAID</div></td>
                                                    @else
                                                     <td><div  class="badge badge-opacity-warning">UNPAID </div></td>
                                                     
                                                     @endif
                                                     <td>
                                                                <a href="{{ url('details-invoice/'.$item->id. '/' . $item->lease_id. '/' . $item->invoicedate. '/' . $item->invoicetype) }}" class="btn btn-success btn-sm"><i class="mdi mdi-clipboard-text"></i>Invoice</a>
                                                            @if( $item->amountdue - $item->payments->sum('amountpaid') == 0)
                                                                <a style="background-color:green" class="btn btn-warning btn-sm"><i class="mdi mdi-cash-usd"></i></i>PAID</a>
                                                            @else
                                                            <a href="{{ url('add-payment/'.$item->id. '/' . $item->lease_id. '/' . $item->invoicedate. '/' . $item->invoicetype) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-cash-usd"></i></i>Pay</a>
                                                            @endif
                                                            @if($item->payments->count()  == null )
                                                                <a class="btn btn-dark btn-sm"><i class="mdi mdi-cash-usd"> </i> No Receipt Available<i class=""> ({{$item->payments->count()}})</i></a>
                                                            @else
                                                            <a href="{{ url('details-receipt/'.$item->id. '/' . $item->lease_id. '/' . $item->invoicedate. '/' . $item->invoicetype) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-cash-usd"></i></i>Receipt<i class="mdi mdi-cash-usd"> {{$item->payments->count()}}</i></a>
                                                            @endif
                                                            <a href="{{ url('edit-invoice/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i></a>
                                
                                                            <a href="{{ url('delete-invoice/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                                     </td>
                                                     @endforeach
                                                </tr>
                        
                                            </tbody>
                                       
</table>

                    
                  </div>
                
               
          
     
</div>

@endsection
