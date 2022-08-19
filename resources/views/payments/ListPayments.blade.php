
@extends('layouts.admin')

@section('content')

<div class="container-fluid">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Payments</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Payments</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    
                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Sucess! </strong> {{ session('status') }}.  <a href="{{ url('invoices/') }}" class="alert-link">Back to Invoices</a>
                        <button type="button" class="btn-success float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>          
                     @endif
                     @if (session('statuserror'))
                        <h6 class="alert alert-danger">{{ session('statuserror') }}</h6>
                     @endif           
                <br />
        
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                      <ul class="nav nav-tabs" role="tablist">
                         @foreach($paymentitems as $item)
                            <li class="nav-item">
                              <a class="nav-link {{ (request()->segment(5) == $item->paymentitem) ? 'active' : '' }}" id="{{$item->paymentitem}}-tab" data-bs-toggle="tab" href="#{{$item->paymentitem}}" role="tab" aria-controls="overview" aria-selected="true">{{$item->paymentitem}} Payments </a>
                            </li>
                          @endforeach
                      </ul>
                </div>

                  <div class="tab-content">      
            @foreach($paymentitems as $item)
                  
                    <div id="{{$item->paymentitem}}" class="tab-pane fade show {{ (request()->segment(5) == $item->paymentitem) ? 'active' : '' }} ">
                            <h4>List of All {{$item->paymentitem}} Payments </h4>
                            <div class=" table-responsive"> 
                <button class="btn btn-danger text-white mb-0 me-0 float-end" onclick="history.back()"><i class="mdi mdi-keyboard-return">Back To Invoice List</i></button>
   
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
                                                    <th data-sortable="true">Receipt No</th>
                                                    <th data-sortable="true">Invoice Date</th>
                                                    <th data-sortable="true">Payment Date</th>
                                                    <th data-sortable="true">Due Date</th>
                                                    <th>Payment Type</th>
                                                    <th>Amount Paid</th>
                                                    <th data-sortable="true">Received By</th>
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
                                                     <td>{{$item->receiptno}}</td>
                                                     <td>{{\Carbon\Carbon::parse($item->invoicedate)->format('d M Y') }}</td> <!------Invoice Date -->
                                                     <td>{{\Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td> 
                                                     <td>{{\Carbon\Carbon::parse($item->duedate)->format('d M Y') }}</td> <!------Due Date -->
                                                     <td>{{$item->paymentname}}</td>
                                                     
                                                     <td>{{$item->amountpaid}}  </td>
                                                     <td><b style="">{{Auth::user()->email}}</b></td>
                                                     <td>
                                                       
                                                     <a href="{{ url('details-receipt/'.$item->invoice_id. '/' . $item->lease_id. '/' . $item->invoicedate. '/' . $item->invoicetype) }}" class="btn btn-dark btn-sm"><i class="mdi mdi-cash-usd"></i></i>Receipt<i class="mdi mdi-cash-usd"></i></a>
            
                                                            <a href="{{ url('edit-payment/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i></a>
                                
                                                            <a href="{{ url('delete-payment/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                                     </td>
                                                     @endforeach
                                                </tr>
                        
                                            </tbody>
                                       
</table>
                            </div>


                              
                    </div>
            @endforeach
           
</div>

@endsection
