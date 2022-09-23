@extends('layouts.admin')

@section('content')


<div class="container-fluid">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;PROPERTIES INFORMATION</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Lease</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Assign Tenants</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
<div class="row justify-content-center">
      <div class="col-md-7 ">

      @include('layouts.partials.messages')

          <div class="card">
                <div class="card-header">
                    <br />
                    <a href="{{ url('leases') }}" class="btn btn-danger float-end">View All Leases</a><br/>
                    <h4>Assign House/ Add Lease</h4>
                </div>
              
                <div class="card-body">
                
                  <form action="{{ url('add-lease') }}" method="POST">
                        @csrf
                     
                        <div class="form-group mb-3">
                        @if( Auth::user()->can('Apartments.create'))
                                                <label  for="">Apartment</label></br>
                                                <select class="formcontrol2" name="apartment_id" required>
                                                    <option value="">Select Apartment</option>
                                                    @foreach($apartment as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                    <select>           
                                        @endif

                          </div>  
                        <div class="form-group  mb-3">
                            <label for="">Select House Number <span style="color:red;font-size:20px">*</span></label></br>
                                <select  id="housenumber" class="formcontrol2" name="house_id" required>
                                  <option>Select House Number</option>
                                    @foreach ($house as $houses)
                                    <option value="{{$houses->id}}">
                                        {{$houses->housenumber}}
                                        @if( Auth::user()->can('Apartments.create')) - {{$houses->apartment->name}} @endif
                                    </option>
                                    @endforeach
                                </select>
                          </div>  
                          <div class="form-group mb-3">
                                        <label for="">Tenant <span style="color:red;font-size:20px">*</span></label></br>
                                        <select  id="Tenant" class="formcontrol2" name="tenant_id" required>
                                          <option>Select Tenant </option>
                                            @foreach ($tenant as $tenant)
                                            <option value="{{$tenant->id}}">
                                                {{$tenant->firstname}} {{$tenant->lastname}}
                                                @if( Auth::user()->can('Apartments.create')) - {{$tenant->apartment->name}} @endif
                                            </option>
                                          @endforeach
                                        </select>
                          </div> 
                          <div class="form-group  mb-3">
                                        <label for="">Rent Amount <span style="color:red;font-size:20px">*</span></label></br>
                                
                                        <input id = "rent" type="text" name="rent" class="form-control" />
                                        @if ($errors->has('rent'))
                                            <span class="text-danger" style="font-size:12px">{{ $errors->first('rent') }}</span>
                                            @endif
                          </div>  
                          <div class="form-group mb-3">
                                        <label for="">Deposit Amount <span style="color:red;font-size:20px">*</span></label></br>
                                        <input type= "text"  id="deposit" class="form-control" name="deposit" value="{{ old('deposit') }}">
                                        @if ($errors->has('deposit'))
                                            <span class="text-danger" style="font-size:12px">{{ $errors->first('deposit') }}</span>
                                            @endif
                          </div>
                          <div class="form-group mb-3">
                                            <label for="">Start Date <span style="color:red;font-size:20px">*</span></label>
                                            <input type="date" name="startdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" />
                                       
                                                @if ($errors->has('startdate'))
                                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('startdate') }}</span>
                                                @endif
                            </div>
                            <div class="form-group mb-3">
                                            <label for=""> End Date <span style="color:red;font-size:20px">*</span></label>
                                            <input type="date" name="enddate" value="<?php echo date('Y-m-d'); ?>"  class="form-control" />
                                                @if ($errors->has('todate'))
                                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('todate') }}</span>
                                                @endif
                                            </div>
                          <div class="form-group mb-3">
                                        <label for="">Status <span style="color:red;font-size:20px">*</span></label></br>
                                        <input type= "text"   class="form-control" value="Active" name="status" readonly>
                                        @if ($errors->has('status'))
                                            <span class="text-danger" style="font-size:12px">{{ $errors->first('status') }}</span>
                                            @endif
                          </div>   
                         
                          <div class="form-group  mb-3">
                                  <label for="">Terms </label></br>
                                      <textarea  name="terms" rows="4"class="form-control" cols="50" value="{{ old('terms') }}"></textarea>
                                    @if ($errors->has('terms'))
                                              <span class="text-danger" style="font-size:12px">{{ $errors->first('terms') }}</span>
                                              @endif
                    
                            </div>        

                           
                            

               
             
                      <div class="form-group mb-3" style="float:right">
                            <button type="submit" class="btn btn-primary">Create Lease</button>
                        </div>
                  </form>
                </div>
            </div>
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
                    url: "{{url('api/fetch-leaserent')}}",
                    type: "POST",
                    data: {
                        house_id: query,
             
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (response) {
                        $.each(response, function (index, value) {
                            $("#rent").val($("#rent").val() + value.rent);
                            $("#deposit").val($("#deposit").val() + value.setdeposit);
                            
                     
                     });
                        
                              
                    }
                });

            });
                 var i = 1;
                $("#dynamic-ar").click(function () {
               
                    ++i;
                    $("#dynamicAddRemove").append('<tr><td>' + i +'</td><td><select name="itemname[]" class="form-control invoiceitem" /></select></td><td><input type="text" name="amountdue[]" class="form-control" /></td><td><input type="text" name="amountpaid[]" class="form-control" /></td><td>0</td><td><button type="button" class="btn btn-danger remove-input-field">Delete</button></td></tr>'
                        );
                        var $options = $("#invoiceitem > option").clone();
                    $('.invoiceitem').append($options);
                        
                });
                $(document).on('click', '.remove-input-field', function () {
                    $(this).parents('tr').remove();
                });
        });


    </script>

@endsection
