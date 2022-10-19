@extends('layouts.admin')

@section('content')


<div class="container">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Utilties</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Readings</span></a> </li>
                 </ol>
             </nav>
         </div>
    <div class="row">
        <div class="col-md-12">
                @include('layouts.partials.messages')	
            <div class="card">
                                                                   
                <div class="card-header">
                     <div style="align-items:end">
                        <br />
                       <button class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/add-reading") }}'">
                         <i class="mdi mdi-account-plus"></i>Add new Reading</button>
                       </div><br />
                    <h4>List of Readings</h4>
                </div>
                <div class="card-body">
                
                <div class="table-responsive">
                 @if (Route::currentRouteName() == 'Readings.view')
                       @include('readings.indexGroupReadings')
                                        @endif
                    
                      @if (Route::currentRouteName() == 'Readings.view_list')
                       @include('readings.indexreadings')
                                        @endif
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
