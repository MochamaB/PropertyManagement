
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
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Create Request </span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    <div class="col-7 grid-margin">
    @include('layouts.partials.messages')
             <div class="card">
                     <div class="card-header">
                        <br />
                          <a href="{{ url('YearViewmaintenance') }}" class="btn btn-danger float-end">BACK</a>
                    <br />
                    <h4>Record New Repair Request</h4>
                    </div>

                <div class="card-body">
                        <form action="{{ url('add-maintenance') }}" method="POST">
                                @csrf
                                      
                                         
                                            <div class="form-group  mb-3">
                                                <label for="">Select House Number <span style="color:red;font-size:20px">*</span></label>
                                                    <select  id="housenumber" class="formcontrol2" name="lease_id">
                                                      <option>Select House Number</option>
                                                        @foreach ($house as $house)
                                                        <option value="{{$house->id}}">
                                                            {{$house->housenumber}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="form-group  mb-3">
                                                <label for="">Priority <span style="color:red;font-size:20px">*</span></label>
                                                <select  class="formcontrol2" style="color:black" name="priority">
                                                <option value="">Select Priority Level</option>
                                                <option value="Extreme">Extreme (Must be Adressed in 24 hours)</option>
                                                <option value="High">High</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Low">Low</option>
                                                </select>
                                            @if ($errors->has('priority'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('priority') }}</span>
                                            @endif
                                        </div>
                                      <div class="form-group  mb-3">
                                        <label for="">Bill Type <span style="color:red;font-size:20px">*</span></label>
                                        <select  class="formcontrol2" style="color:black" name="billtype">
                                                <option value="">Select Bill Type</option>
                                                <option value="Expense">Expense</option>
                                                <option value="Income">Income</option>
                                                </select>
                                            @if ($errors->has('billtype'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('billtype') }}</span>
                                            @endif
                                        </div>
                                         <div class="form-group  mb-3">
                                        <label for="">Short Title <span style="color:red;font-size:20px">*</span></label>
                                        <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Bathroom,Kitchen,staircase" />
                                            @if ($errors->has('title'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>

                              
                                        <div class="form-group  mb-3">
                                        <label for="">Description <span style="color:red;font-size:20px">*</span></label>
                                        <textarea name="description"  class="form-control" placeholder="Type Some Text.." required>{{ old('description') }}</textarea>
                                            @if ($errors->has('description'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>

                                        
                                         
                                       <button type="submit" class="btn btn-primary float-end" >Add Record</button>
    
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
                    url: "{{url('api/fetch-rent')}}",
                    type: "POST",
                    data: {
                        houseID: query,
             
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (data) {
                    

                   $('#leaseid').html('<option value="">Select Lease</option>');
                   $('#invoiceitem').html('<option value="">Select Invoice Item</option><option value="Rent">Rent</option>');
                        $.each(data, function (key, value) {
                        $("#leaseidone").html("");
                        $("#leaseidone").append('<option value="' + value
                                .id + '">' + value.id + '</option>');

                                $("#invoiceitem").append('<option value="' + value
                                .name + '">' + value.name + '</option>');
                            $("#actualrent").append('<option value="' + value
                                .actualrent + '">' + value.actualrent + '</option>');
                                $("#leaseid").append('<option value="' + value
                                .id + '">' + value.id + '</option>');

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
    
    <script type="text/javascript">
   
</script>
          
</body>

@endsection
