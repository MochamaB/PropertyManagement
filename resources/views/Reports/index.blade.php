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


     </div>
     @include('layouts.partials.messages')
     <div class="card">
                     <div class="card-header">
                        <br />
                        
                        <h4>Generate Report</h4>
                    </div>

                <div class="card-body">
                <form action="{{ url('view-report') }}" method="GET">
                @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group row">
                                <label for="category" class="col-sm-4 pt-0 col-form-label">Available Reports<span style="color:red;font-size:20px">*</span></label>
                                <div class="col-sm-8">
                                    <select class="formcontrol2" name="category" id="" placeholder="">
                                        <option value=""> Select Report</option>
                                        @foreach($category as $item)
                                        <option value="{{$item}}">{{$item}} Reports</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('category') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label for="category" class="col-sm-4 pt-0 col-form-label">Start Date<span style="color:red;font-size:20px">*</span></label>
                            <div class="col-sm-8">
                            <input type=date name="startdate" class="form-control"/>
                            @if ($errors->has('startdate'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('startdate') }}</span>
                                    @endif
                            </div>
                           
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group row">
                            <label for="category" class="col-sm-3 pt-0 col-form-label">End Date<span style="color:red;font-size:20px">*</span></label>
                            <div class="col-sm-8">
                            <input type=date name="enddate" class="form-control"/>
                            @if ($errors->has('enddate'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('enddate') }}</span>
                                    @endif
                            </div>
                          
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning float-end">Generate  Report</button>
                </div>
     </div>

    
@endsection