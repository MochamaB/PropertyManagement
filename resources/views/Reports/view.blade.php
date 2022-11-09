@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="container-fluid">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;REPORTS</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Reports Page</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Filter Reports</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>


     <div class=" table-responsive"> 
                <a href="{{ url('reports') }}" class="btn btn-danger text-white mb-0 me-0 float-end"><i class="mdi mdi-keyboard-return">Back To Filter</i></a>
                <table id="table"
     
                                   
                data-toggle="table"
                data-icon-size="sm"
                data-toolbar-align="right"
                data-buttons-align="left"
                data-buttons-class="primary"
                data-search-align="left"
                data-maintain-selected="true"
                data-sort-name="Invoice Month"
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
                    @if($reportyype == 'Invoices')    
                        <th data-sortable="true"  ></th>
                        <th data-sortable="true"  >Invoice Date</th>
                        <th data-sortable="true"  >Invoice No</th>
                        <th data-sortable="true"  >Invoice Type</th>
                        <th data-sortable="true"  >House No</th>
                        <th data-sortable="true"  >Tenant Name</th>
                        <th data-sortable="true"  >Amout Due</th>
                        <th data-sortable="true"  >Amount Paid</th>
                        <th data-sortable="true"  >Status</th>
                    @elseif($reportyype == 'Payments')
                    <th data-sortable="true"  ></th>
                        <th data-sortable="true"  >Invoice Date</th>
                        <th data-sortable="true"  >Payment Date</th>
                        <th data-sortable="true"  >Invoice No</th>
                        <th data-sortable="true"  >Receipt No</th>
                        <th data-sortable="true"  >House No</th>
                        <th data-sortable="true"  >Tenant Name</th>
                        <th data-sortable="true"  >Payment Type</th>
                        <th data-sortable="true"  >Payment Code</th>
                        <th data-sortable="true"  >Payment For</th>
                        <th data-sortable="true"  >Amount Paid</th>
                    @endif
                      
                    </tr>
                    
                </thead>
                <tbody style="padding-left:0; padding-right:0px">
                
                @foreach($report as $key=> $row)
                    <!----------------Invoices ---------->
        @if($reportyype == 'Invoices')
                    <tr>
                    @if( ($row->amountdue + $parentutilsum->sum('amount')) -$row->payments->sum('amountpaid') == 0 )
                        <td style="border-left: 10px solid green"><b>{{$key+1}}</b></td>
                    @elseif( ($row->amountdue + $parentutilsum->sum('amount')) - $row->payments->sum('amountpaid') < 0  )
                        <td style="border-left: 10px solid darkorange"><b>{{$key+1}}</b></td>
                    @elseif ( $row->payments->count()  != null)
                        <td style="border-left: 10px solid blue"><b>{{$key+1}}</b></td>
                    @else
                        <td style="border-left: 10px solid red"><b>{{$key+1}}</b></td>
                    @endif
                        <td>{{\Carbon\Carbon::parse($row->invoicedate)->format('d M Y') }}</td>
                        <td>{{$row->invoiceno}}</td>  
                        <td>{{$row->invoicetype}}</td>  
                        <td>{{$row->housenumber}}</td>   
                        <td>{{$row->firstname}} {{$row->lastname}}</td>
                        <td>KSH: {{ $row->amountdue + $parentutilsum->sum('amount') }}</td>     
                        <td>KSH: {{$row->payments->sum('amountpaid')}}</td>
                        <!------Status -->
                        @if( ($row->amountdue + $parentutilsum->sum('amount')) -$row->payments->sum('amountpaid') == 0 )
                            <td><div style="background-color:green" class="badge badge-opacity-warning"> PAID</div></td> 
                        @elseif( ($row->amountdue + $parentutilsum->sum('amount')) - $row->payments->sum('amountpaid') < 0  )
                            <td><div style="background-color:darkorange" class="badge badge-opacity-warning"> OVER PAID</div></td>
                        @elseif ( $row->payments->count()  != null)
                            <td><div style="background-color:blue" class="badge badge-opacity-sucess"> PARTIALLY PAID</div></td>
                        @else
                            <td><div  class="badge badge-opacity-warning">UNPAID </div></td>
                    
                        @endif
                    </tr>
        @elseif($reportyype == 'Payments')
                    <tr>
                        <td><b>{{$key+1}}</b></td>
                        <td>{{\Carbon\Carbon::parse($row->invoicedate)->format('d M Y') }}</td>
                        <td>{{\Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</td>
                        <td>{{$row->invoiceno}}</td> 
                        <td>{{$row->receiptno}}</td>  
                        <td>{{$row->housenumber}}</td>   
                        <td>{{$row->firstname}} {{$row->lastname}}</td>
                        <td>{{ $row->paymentname }}</td>    
                        <td>{{ $row->payment_code }}</td>     
                        <td>{{$row->paymentitem}}</td>
                        <td>{{$row->amountpaid}}</td>
                    </tr>
                <!----------- Payments  ---------->
        @endif        
                    @endforeach 
                </tbody>
                </table>   
     </div>

  </div>
</div>
     @endsection