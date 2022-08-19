
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
                     
                       <br />
                           
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                      <ul class="nav nav-tabs" role="tablist">
                     
                      <li class="nav-item">
                              <a class="nav-link  {{ (request()->segment(1) == 'invoices') ? 'active' : '' }} " id="home-tab" data-bs-toggle="tab" href="#all" role="tab" aria-controls="overview" aria-selected="false">All Invoices</a>
                            </li>
                @if (Route::currentRouteName() == 'invoices.view')
                          @foreach($invoiceitems as $item)
                            <li class="nav-item">
                              <a class="nav-link  {{ (request()->segment(3) == '$item->name') ? 'active' : '' }} " id="{{$item->name}}-tab" data-bs-toggle="tab" href="#{{$item->name}}" role="tab" aria-controls="overview" aria-selected="false">{{$item->name}} Invoices</a>
                            </li>
                          @endforeach    
                      </ul>
                @elseif (Route::currentRouteName() == 'invoices.view_month')
                @foreach($invoiceitems as $item)
                            <li class="nav-item">
                              <a class="nav-link  {{ (request()->segment(3) == $item->name) ? 'active' : '' }} " id="{{$item->name}}-tab" data-bs-toggle="tab" href="#{{$item->name}}" role="tab" aria-controls="overview" aria-selected="false">{{$item->name}} Invoices</a>
                            </li>
                          @endforeach  
                @endif
                </div>

                  <div class="tab-content">
                  <div id="all" class="tab-pane fade show {{ (request()->segment(1) == 'invoices') ? 'active' : '' }}">
                            <h4>List of All Invoices</h4>
                            @include('invoice.indexGroupInvoice')
                            
                            
                        </div>
            <!-------------------/////////////////////////-------------Invoice Tabs------ --------------------------------- ////////////////////// ------------------------------------>
            @foreach($invoiceitems as $item)
                    <div id="{{$item->name}}" class="tab-pane fade show {{ (request()->segment(3) == $item->name) ? 'active' : '' }} ">
                            <h4>List of {{$item->name}}  Invoices</h4>
                          @if($item->rate == null)
                                <form action="{{ url('Fromlease-invoice') }}" method="POST">
                          @elseif($item->billcycle =='Permonth')
                          <form action="{{ url('Permonth-invoice') }}" method="POST">
                          @else($item->billcycle =='Units')
                          <form action="{{ url('Units-invoice') }}" method="POST">
                          @endif
                                        @csrf
                                        </br></br>
                                        
                                        <div class="input-group " >
                                        <div style="width:120px;border-right:5px solid #ffaf00;" ></div>
                                        <p style="font-weight:600;font-size:14px; border:0px" class="form-control">Invoice Month:&nbsp;&nbsp; </p>
                                            <div class="col-xs-3">
                                             <input type="hidden" name="invoicetype" class="form-control" value="{{$item->name}}" required/>
                                            <input type="date" name="invoicedate" class="form-control" placeholder="Invoice" required/>
                                            </div>
                                            
                                             <p style="font-weight:600;font-size:14px;border:0px" class="form-control">Due Date:&nbsp;&nbsp; </p>
                                            <div class="col-xs-3">
                                            <input type="date" name="duedate" class="form-control" placeholder="duedate" required/>
                                            </div>
                                            <span style="width:15px">&nbsp;</span>
                                               <button type="submit" class="btn btn-warning float-end">Generate {{$item->name}} invoices</button>
                                        </div>
                                        <hr>
                                        
                                </form>
                                     <!-- partial -->
                                    
                                     @include('invoice.indexGroupInvoice')
                     
                                     
                                      <!-- partial:partials/_sidebar.html -->
                                        
                          </div>
            @endforeach     
 
                  </div>
                
               
          
     
</div>

@endsection
