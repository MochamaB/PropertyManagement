
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
                    <li class="nav-item">
                              <a class="nav-link {{ (request()->is('payments')) ? 'active' : '' }}" id="All-tab" data-bs-toggle="tab" href="#all" role="tab" aria-controls="overview" aria-selected="true">All Payments</a>
                            </li>
                         @foreach($paymentitems as $item)
                            <li class="nav-item">
                              <a class="nav-link {{ (request()->segment(3) == $item->paymentitem) ? 'active' : '' }}" id="{{$item->paymentitem}}-tab" data-bs-toggle="tab" href="#{{$item->paymentitem}}" role="tab" aria-controls="overview" aria-selected="true">{{$item->paymentitem}} Payments </a>
                            </li>
                          @endforeach
                      </ul>
                </div>

                  <div class="tab-content">
            
                  <div id="all" class="tab-pane fade show {{ (request()->is('payments')) ? 'active' : '' }} ">
                  <h4>List of All Payments </h4>
                  
                      @include('payments.indexGroupPayment')        
                
                  </div>
                  
            <!-------------------/////////////////////////-------------other Payments------ --------------------------------- ////////////////////// ------------------------------------>
            @foreach($paymentitems as $item)
                  
                    <div id="{{$item->paymentitem}}" class="tab-pane fade show {{ (request()->segment(3) == $item->paymentitem) ? 'active' : '' }} ">
                            <h4>List of All {{$item->paymentitem}} Payments </h4>

                            @include('payments.indexGroupPayment')          
                    </div>
            @endforeach
 
 <!-------------------/////////////////////////-------------other Payments----- --------------------------------- ////////////////////// ------------------------------------>
               
          
     
</div>

@endsection
