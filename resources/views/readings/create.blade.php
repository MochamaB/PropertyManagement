
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
    <div class="col-12 grid-margin">
    @if (session('statuserror'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error! </strong> {{ session('statuserror') }}.  <a href="{{ url('invoices/') }}" class="alert-link">Back to Invoices</a>
                        <button type="button" class="btn-danger float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
				@endif
				
				  @if($errors->all())
            <h6 class="alert alert-danger">Check Error messages in the form!</h6>
            @endif
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
                                
                                   <div class="form-group col-md-6 mb-3">
                                    <label for="">Utility Category</label>
                                            <select  name="utilitycategory_id" class="form-control" />
                                                <option value> Select Utility </option>
                                                @foreach($utilitycategories as $item)
                                                <option value="{{$item->id}}">{{$item->name}} </option>
                                                @endforeach
                                                </select>
                                                @if ($errors->has('utilitycategory_id'))
                                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('utilitycategory_id') }}</span>
                                                @endif
                                    </div>  
                               
                                         
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Select House Number </label>
                                                    <select name="lease_id" id="housenumber" class="form-control" style="-prefix-appearance">
                                                      <option>Select House Number</option>
                                                        @foreach ($house as $house)
                                                        <option value="{{$house->id}}">
                                                            {{$house->housenumber}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="form-group col-md-4 mb-3">
                                            <label for="">Billing Start Date</label>
                                            <input type="date" name="fromdate" class="form-control" />
                                                @if ($errors->has('fromdate'))
                                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('fromdate') }}</span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 mb-3">
                                            <label for="">Billing End Date</label>
                                            <input type="date" name="todate" class="form-control" />
                                                @if ($errors->has('todate'))
                                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('todate') }}</span>
                                                @endif
                                            </div>
                                            
                                      <div class="form-group col-md-6 mb-3">
                                        <label for="">Meter Number</label>
                                        <input type="text" name="meternumber" class="form-control" />
                                            @if ($errors->has('meternumber'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('meternumber') }}</span>
                                            @endif
                                        </div>
                                         <div class="form-group col-md-4 mb-3">
                                        <label for="">Initial Reading</label>
                                        <input type="text" name="initialreading" class="form-control" />
                                            @if ($errors->has('initialreading'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('initialreading') }}</span>
                                            @endif
                                        </div>
                                         <div class="form-group col-md-4 mb-3">
                                        <label for="">Last Reading</label>
                                        <input type="text" name="lastreading" class="form-control" />
                                            @if ($errors->has('lastreading'))
                                                <span class="text-danger" style="font-size:12px">{{ $errors->first('lastreading') }}</span>
                                            @endif
                                        </div>
                                         <div class="form-group col-md-4 mb-3">
                                        <label for="">Current Reading</label>
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
