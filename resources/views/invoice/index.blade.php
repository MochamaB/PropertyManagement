
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
    
@include('layouts.partials.messages')	        
                <br />
                     
                       <br />
                           
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                      <ul class="nav nav-tabs" role="tablist">
                     
                      <li class="nav-item">
                              <a class="nav-link  {{ (request()->segment(1) == 'invoices') ? 'active' : '' }} " id="home-tab" data-bs-toggle="tab" href="#all" role="tab" aria-controls="overview" aria-selected="false">All Invoices</a>
                            </li>
                @if (Route::currentRouteName() == 'Invoices.view')
                          @foreach($categoryitems as $item)
                            <li class="nav-item">
                              <a class="nav-link  {{ (request()->segment(3) == '$item->name') ? 'active' : '' }} " id="{{$item->name}}-tab" data-bs-toggle="tab" href="#{{$item->name}}" role="tab" aria-controls="overview" aria-selected="false">{{$item->name}} Invoices</a>
                            </li>
                          @endforeach    
                      </ul>
                @elseif (Route::currentRouteName() == 'Invoices.view_month')
                @foreach($categoryitems as $item)
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
            @foreach($categoryitems as $item)

                    <div id="{{$item->name}}" class="tab-pane fade show {{ (request()->segment(3) == $item->name) ? 'active' : '' }} ">

                            <h4>List of {{$item->name}}  Invoices</h4>

                    @if($task->status == 0)
                          <form action="{{ url('generateinvoice') }}" method="POST">
                              @csrf
                                        </br></br>
                                        
                                  <div class="input-group " >
                                        <div style="width:120px;border-right:5px solid #ffaf00;" ></div>
                                        <p style="font-weight:600;font-size:14px; border:0px" class="form-control">Invoice Month:&nbsp;&nbsp; </p>
                                            <div class="col-xs-3">
                                             <input type="hidden" name="utilcateg" class="form-control" value="{{$item->name}}" required/>
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
                    @else
                      <div class="alert alert-success alert-dismissible fade show" id="welcomemessage" role="alert" style="border-left:5px solid #34B1AA;">
                     <h4><strong>Invoice Auto Generation is Active </strong><h4>  
                        <button type="button" class="btn-success float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h6>Go to <a href="{{ url('tasks/') }}" class="alert-link">tasks module to disable</a> <h6>
                </div>
                  @endif  
                                   <!-- partial -->
                                    
                                     @include('invoice.indexGroupInvoice')
                     
                                     
                                      <!-- partial:partials/_sidebar.html -->
                                        
                          </div>
            @endforeach     
 
                  </div>
                
               
          
     
</div>

@endsection
