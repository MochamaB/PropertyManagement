
@extends('layouts.admin')

@section('content')

<div class="container">
    <!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Maintenance</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Repairs</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Edit Request </span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    <div class="col-12 grid-margin">
            @if($errors->all())
            <h6 class="alert alert-danger">Check Error messages in the form!</h6>
            @endif
             <div class="card">
                     <div class="card-header">
                        <br />
                          <a href="{{ url('YearViewmaintenance') }}" class="btn btn-danger float-end">BACK</a>
                    <br />
                    <h4>Record New Repair Request</h4>
                    </div>

                <div class="card-body">
                        <form action="{{ url('update-maintenance/'.$maintenance->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                                      
                                         
                     
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Priority <span style="color:red;font-size:20px">*</span></label>
                                                <select  class="form-control" style="color:black" name="priority" value="{{$maintenance->priority}}">
                                                <option value="{{$maintenance->billtype}}">{{$maintenance->priority}}</option>
                                                <option value="Extreme">Extreme (Must be Adressed in 24 hours)</option>
                                                <option value="High">High</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Low">Low</option>
                                                </select>
                                            @if ($errors->has('priority'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('priority') }}</span>
                                            @endif
                                        </div>
                                      <div class="form-group col-md-6 mb-3">
                                        <label for="">Bill Type <span style="color:red;font-size:20px">*</span></label>
                                        <select  class="form-control" style="color:black" name="billtype" placeholder="{{$maintenance->billtype}}" value="{{$maintenance->billtype}}">
                                                <option value="{{$maintenance->billtype}}">{{$maintenance->billtype}}</option>
                                                <option value="Expense">Expense</option>
                                                <option value="Income">Income</option>
                                                </select>
                                            @if ($errors->has('billtype'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('billtype') }}</span>
                                            @endif
                                        </div>
                                         <div class="form-group col-md-6 mb-3">
                                        <label for="">Short Description <span style="color:red;font-size:20px">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{$maintenance->name}}" placeholder="Bathroom,Kitchen,staircase" />
                                            @if ($errors->has('name'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

        
                                        <div class="form-group col-md-6 mb-3">
                                        <label for="">Description <span style="color:red;font-size:20px">*</span></label>
                                        <textarea name="description" class="form-control"  placeholder="Type Some Text.." required>{{$maintenance->description}}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>

                                        
                                         
                                       <button type="submit" class="btn btn-primary float-end" >Edit Record</button>
    
                            </div>
                                         
                                    
                                  
                                    
                                    
                                    
              

                </div>
    </div>
                 
    
          
</body>

@endsection
