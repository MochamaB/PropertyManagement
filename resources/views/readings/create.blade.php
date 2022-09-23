
@extends('layouts.admin')

@section('content')

<div class="container">
    <!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Utilities</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Create New Reading</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    <div class="col-8 grid-margin">
    @include('layouts.partials.messages')	
             <div class="card">
                     <div class="card-header">
                        <br />
                          <a href="{{ url('readings') }}" class="btn btn-danger float-end">BACK</a>
                    <br />
                    <h4>Record Readings</h4>
                    </div>

                <div class="card-body">
                        <form action="{{ url('add-reading') }}" method="POST">
                                @csrf
                                
                                   <div class="form-group  mb-3">
                                    <label for="">Utility Category <span style="color:red;font-size:20px">*</span></label>
                                            <select  name="utilitycategory_id" class="formcontrol2" required />
                                                <option value> Select Utility </option>
                                                @foreach($utilitycategories as $item)
                                                <option value="{{$item->id}}">{{$item->name}} </option>
                                                @endforeach
                                                </select>
                                                @if ($errors->has('utilitycategory_id'))
                                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('utilitycategory_id') }}</span>
                                                @endif
                                    </div>  
                               
                                         
                                            <div class="form-group  mb-3">
                                                <label for="">Select House Number <span style="color:red;font-size:20px">*</span></label>
                                                    <select name="lease_id" id="housenumber" class="formcontrol2" style="-prefix-appearance">
                                                      <option>Select House Number</option>
                                                        @foreach ($house as $house)
                                                        <option value="{{$house->id}}">
                                                            {{$house->housenumber}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="form-group  mb-3">
                                            <label for="">Billing Start Date <span style="color:red;font-size:20px">*</span></label>
                                        @if( Auth::user()->can('Reading.edit'))
                                            <input type="date" name="fromdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" />
                                        @else
                                        <input type="date" name="fromdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly />
                                        @endif
                                                @if ($errors->has('fromdate'))
                                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('fromdate') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group  mb-3">
                                            <label for="">Billing End Date <span style="color:red;font-size:20px">*</span></label>
                                        @if( Auth::user()->can('Reading.edit'))   
                                            <input type="date" name="todate" value="<?php echo date('Y-m-d'); ?>"  class="form-control" />
                                        @else
                                        <input type="date" name="todate" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly />
                                        @endif
                                                @if ($errors->has('todate'))
                                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('todate') }}</span>
                                                @endif
                                            </div>
                                            
                                         <div class="form-group  mb-3">
                                        <label for="">Initial Reading (Reading when Lease was created) <span style="color:red;font-size:20px">*</span></label>
                                        @if( Auth::user()->can('Reading.edit'))  
                                             <input id = "initialreading" type="text" name="initialreading" class="form-control" />
                                        @else
                                            <input id = "initialreading" type="text" name="initialreading" class="form-control" readonly />
                                        @endif
                                            @if ($errors->has('initialreading'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('initialreading') }}</span>
                                            @endif
                                        </div>
                                         <div class="form-group  mb-3">
                                        <label for="">Last Reading <span style="color:red;font-size:20px">*</span></label>
                                        @if( Auth::user()->can('Reading.edit'))  
                                        <input type="text" id = "lastreading" name="lastreading" class="form-control" />
                                        @else
                                        <input type="text" id = "lastreading" name="lastreading" class="form-control" readonly/>
                                        @endif
                                            @if ($errors->has('lastreading'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('lastreading') }}</span>
                                            @endif
                                        </div>
                                         <div class="form-group  mb-3">
                                        <label for="">Current Reading <span style="color:red;font-size:20px">*</span></label>
                                        <input type="text" name="currentreading" class="form-control" />
                                            @if ($errors->has('currentreading'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('currentreading') }}</span>
                                            @endif
                                        </div>
                                        
                                         
                                       <button type="submit" class="btn btn-primary float-end" >Add Reading</button>
                                        
                               
                            </div>
                                         
                </div>
    </div>
                 
    <script>
        $(document).ready(function () {
            $('.card-body').on('change','#housenumber', function () {
                 var query = this.value;
                 $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }   
                        });
                $.ajax({
                    url: "{{url('api/fetch-id')}}",
                    type: "POST",
                    data: {
                        lease_id: query,
             
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (response) {
                        $.each(response, function (index, value) {
                            ///// clear the input filed before populating it
                            $("#initialreading").val(''); 
                            //// Populate input field with this #id with value of the initialreading query
                            $("#initialreading").val($("#initialreading").val() + value.initialreading);
                            $("#lastreading").val('');
                            $("#lastreading").val($("#lastreading").val() + value.currentreading);
                     
                     });
                        
                              
                    }
                });

            });
      
                
        });

    </script>          


@endsection
