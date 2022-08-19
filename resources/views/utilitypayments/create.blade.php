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
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue"> Create Utility Bill</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>


<!---------  breadcrumbs ---------------->
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif
             @if (session('statuserror'))
                        <h6 class="alert alert-danger">{{ session('statuserror') }}</h6>
                     @endif

            <div class="card">
                <div class="card-header">
                    <br />
                    <a href="{{ url('utilitypayments') }}" class="btn btn-danger float-end">View All Utilities Bills & Payment</a><br/>
                    <h4>Add Utility Bill</h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('add-utilitypayments') }}" method="POST" id="form" name="form">
                                            @csrf
                                            <div class="form-group col-md-6 mb-3">
                                    <label for="">Select House Number <span style="color:red;font-size:20px">*</span></label>
                                        <select  id="housenumber" class="js-example-basic-single w-100">
                                          <option>Select House Number</option>
                                            @foreach ($rent as $rent)
                                            <option value="{{$rent->id}}">
                                                {{$rent->housenumber}}
                                            </option>
                                            @endforeach
                                        </select>
                                 </div>

                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Lease ID <span style="color:red;font-size:20px">*</span></label>
                                                <select  id="leaseid" class="form-control" name="" required>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Billing Date:<span style="color:red;font-size:20px">*</span></label>
                                                <input type="date"  id="created_atreadonly" name="created_atreadonly"  class="form-control" required />
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Due Date:<span style="color:red;font-size:20px">*</span></label>
                                                <input type="date"  id="duedatereadonly" name="duedatereadonly"  class="form-control" required/>
                                            </div>
                                            <div id ='payments'class="form-group col-md-6 mb-3">
                                               @if ($errors->has('utilityamountdue'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('utilityamountdue') }}</span>
                                                @endif
                                                
                                            </div>
                                    
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" >Save changes</button>
                                        </form>

                       

                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function () {
            $('#housenumber').on('change', function () {
                var query = this.value;
                $('#housenumber').html('<option value="">Select House Number</option>');
                $.ajax({
                    url: "{{url('api/fetch-rent')}}",
                    type: "POST",
                    data: {
                        houseID: query,
             
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (response) {

                   $('#leaseid').html('<option value="">Select Lease</option>');
                        $.each(response, function (key, value) {
                                $("#leaseid").append('<option value="' + value
                                .id + '">' + value.id + '</option>');
                        });
                              
                    }
                });
            });
 
        });

        $(document).ready(function () {
            $('#leaseid').on('change', function () {
                var query2 = this.value;
               
                $.ajax({
                    url: "{{url('api/fetch-utilities')}}",
                    type: "POST",
                    data: {
                        leaseid: query2,
             
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (response) {
                     $.each(response, function (index, value) {
                     $("#payments").append('<input type="hidden" name="created_at[]" class="created_at"/><input type="hidden" name="duedate[]" class="duedate"/><label>' +value.name+'</label><input type="hidden" name="leaseID[]" value="'+value
                     .leaseid+'"><input type="hidden" name="utilitycategoryid[]" value="'+value
                     .utilitycategoryid+'"><input name="utilityamountdue[]" class="form-control" required>');
                     
                     });
                        
                             
                    }
                });
            });
 
        });

    </script>
    
    <script>
       $('#created_atreadonly').change(function() {
                    $('.created_at').val($(this).val());
                        });
        $('#duedatereadonly').change(function() {
                    $('.duedate').val($(this).val());
                        });


    </script>

@endsection
