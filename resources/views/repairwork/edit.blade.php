
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
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Edit Work Order </span></a> </li>
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
                          <a href="{{ url('YearViewrepairwork') }}" class="btn btn-danger float-end">BACK</a>
                    <br />
                    <h4>Edit Repair Request</h4>
                    </div>

                <div class="card-body">
                        <form action="{{ url('update-workorder/'.$repairwork->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label for="">Date Repair Done</label>
                                <input type="date" name="dateofrepair" value="<?php echo date('Y-m-d'); ?>" class="form-control" />
                                    @if ($errors->has('dateofrepair'))
                                        <span class="text-danger" style="font-size:13px;font-weight:700">{{ $errors->first('dateofrepair') }}</span>
                                    @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Amount Paid to Worker</label>
                                <input type="text" name="amountpaid" class="form-control" placeholder="Not set" value="{{$repairwork->amountpaid}}" placeholder="" />
                                    @if ($errors->has('amountpaid'))
                                        <span class="text-danger" style="font-size:13px;font-weight:700">{{ $errors->first('amountpaid') }}</span>
                                    @endif
                            </div>
                        </div>
                        <div class="col-6">
                             <div class="form-group mb-3">
                                <label for="">Work ID</label>
                                <input type="text" name="Workid" value="{{$repairwork->Workid}}"  class="form-control" readonly/>
                                    @if ($errors->has('Workid'))
                                        <span class="text-danger" style="font-size:12px">{{ $errors->first('Workid') }}</span>
                                    @endif
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Amount spent on supplies</label>
                                <input type="text" name="amountspent" placeholder="Not set"  class="form-control" value="{{$repairwork->amountspent}}" />
                                    @if ($errors->has('amountspent'))
                                        <span class="text-danger" style="font-size:12px">{{ $errors->first('amountspent') }}</span>
                                    @endif
                            </div>
                          
                        
                        </div>
                    </div>            
              
                                        <div class="form-group col-md-6 mb-3">
                                        <label for="">List of supplies Used</label>
                                        <textarea name="suppliesused" class="form-control" placeholder="Name of product/tool and amount">{{$repairwork->suppliesused}}</textarea>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                        <label for="">Description of work done</label>
                                        <textarea name="descworkdone" class="form-control" placeholder="Give details of actual work done">{{$repairwork->descworkdone}}</textarea>
                                        </div>  
                                        <div class="form-group col-md-6 mb-3">
                                        <label for="">Recommendations</label>
                                        <textarea name="recommendations" class="form-control" placeholder="Type Some Text.." >{{$repairwork->recommendations}}</textarea>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                        <label for="">Status <span style="color:red;font-size:20px">*</span></label>
                                        <select  class="formcontrol2" style="color:black"value="{{$repairwork->status}}" name="status" >
                                                <option value="{{$repairwork->status}}">{{$repairwork->status}}</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Ongoing">Ongoing</option>
                                                <option value="Out of supplies">Out of supplies</option>
                                                <option value="Stopped">Stopped</option>
                                                </select>
                                            @if ($errors->has('billtype'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('billtype') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                        <label for="">Assigned To Employee <span style="color:red;font-size:20px">*</span></label>
                                        <select  class="formcontrol2" style="color:black" name="assignedto" value="{{$repairwork->assignedto}}">
                                                <option value="{{$repairwork->assignedto}}">{{$repairwork->assignedto}}</option>
                                                @foreach($roles as $role)
                                                    @foreach($role->users as $user)
                                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                                    @endforeach
                                                @endforeach
                                                </select>
                                            @if ($errors->has('assignedto'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('assignedto') }}</span>
                                            @endif
                                        </div>                    
                     
                                           

                                        
                                       
                                       <button type="submit" class="btn btn-primary float-end" >Edit Work Order</button>
                                       </form> 
                            </div>
                                         
                                    
                                  
                                    
                                    
                                    
              

                </div>
    </div>
                 
    
          
</body>

@endsection
