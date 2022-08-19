@extends('layouts.admin')

@section('content')
    <div class="container">
    	<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Invoices</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Create Invoice</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>


<!---------  breadcrumbs ---------------->
    <div class="col-12 grid-margin">
                    @if (session('status'))
                        <h6 class="alert alert-success">{{ session('status') }}</h6>
                     @endif
                     @if (session('statuserror'))
                        <h6 class="alert alert-danger">{{ session('statuserror') }}</h6>
                     @endif
             <div class="card">
                     <div class="card-header">
                        <br />
                        <a href="{{ url('invoices') }}" class="btn btn-danger float-end">Back to Invoice List</a><br/>
                        <h4>Prepare Invoice</h4>
                    </div>

                <div class="card-body">
                        <form action="{{ url('add-invoice') }}" method="POST">
                                @csrf             
                                    <h2 style="text-align: center;">Invoice #</h2>
                                 <div class="row">
                                         <div class="col-6">
                                            <div class="form-group col-md-6 mb-3"
                                                <label for="">Select House Number <span style="color:red;font-size:20px">*</span></label>
                                                    <select  id="housenumber" class="form-control">
                                                      <option>Select House Number</option>
                                                        @foreach ($rent as $rent)
                                                        <option value="{{$rent->id}}">
                                                            {{$rent->housenumber}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                            </div>

                                             <div class="form-group col-md-5 mb-3">
                                                <label for="">Lease ID <span style="color:red;font-size:20px">*</span></label>
                                                <select id="leaseidone" class="form-control" style="color:black" name="lease_id" readonly>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                                    <div class="row" >
                                                            <div class="form-group col-md-3 mb-1">
                                                                <img class="rounded-circle mt-2" width="100px" height="120px"  src="{{ asset('template/images/profilepic.jpg') }}">
                                                            </div>
                                                            <div class="form-group col-md-6 mb-3"><br/>
                                                            <span class="font-weight-bold">Tenant Name: </span></br>
                                                            <span class="text-black-50">Email:</span>
                                                            <span> </span>
                                                            </div>
                                                    </div>
                                        </div>
                                 </div>
                                 
                                
                                  <hr/>
                                  <div class="row">
                                     <div class="col-6">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Invoice Date <span style="color:red;font-size:20px">*</span></label>
                                                <input type="date" id ="invoicedate" name="invoicedate" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="">Status <span style="color:red;font-size:20px">*</span></label>
                                                  <input type="text" name="status" class="form-control"  value="UNPAID" required readonly>
                                                     
                                            </div>
                                             <div class="form-group col-md-6 mb-3">
                                                 <label for="">Invoice Raised By <span style="color:red;font-size:20px">*</span></label>
                                                 <input type="text" name="raised_by" class="form-control" value="{{ Auth::user()->name }}" required readonly>
                                            </div>
                                     </div>
                                     <div class="col-6">
                                             <div class="form-group col-md-6 mb-3">
                                                 <label for="">Invoice Due Date <span style="color:red;font-size:20px">*</span></label>
                                                 <input type="date" name="duedate" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                 <label for="">Expense Type <span style="color:red;font-size:20px">*</span></label>
                                                 <input type="text" name="expensetype" class="form-control" value="Income" required readonly>
                                                 
                                            </div>
                                           
                                     </div>  
                                  </div>
                                  <hr/>
                                        <table class="table" id="dynamicAddRemove">
                                        <button type="button" name="add" id="dynamic-ar" class="btn btn-primary float-end"><i class="mdi mdi-library-plus"></i> Add Invoice Item</button>
                                            <tr>
                                                <th>#</th>
                                                                    <th>Item & Description</th>
                                                                    <th class="text-right">Amount Due</th>
										                            <th class="text-right">Previous Balance</th>
                                                                    <th class="text-right">Total Amount</th>
                                            </tr>
                                            <tr><td>1</td>
                                                <td>
                                               
						                            <input list="invoiceitems" id="invoiceitem"  name="itemname[]" placeholder="Type or select Item" class="form-control " />
                                                    <datalist id="invoiceitems">
                                                            <option value="Rent">
                                                        @foreach($utilities as $row)
                                                            <option value="{{$row->name}}">
                                                            @endforeach
                                                    </datalist>
                                                </td>
					                            <td><input type="text" name="amountdue[]" id="qty" class="form-control" />
                                                </td>
					                            <td><input  type="text" name="amountpaid[]" id="qty" class="form-control" placeholder="0" />
                                                </td>
					                            <td><input type="number" name="total" id="total" class="form-control" />

                                                    <a href="javascript:sumInputs()" name="total" id="total" >GetTotal</a>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>

                                                                       
                                        <div class="row">
                                <div class="col-md-6">
                                     <p class="lead">Add Notes:</p>
                                      <textarea class="form-control">Some text...</textarea>
                                </div>
                                <div class="col-md-1">
                                        
                                </div>
                                <div class="col-md-4">
                                        <p class="lead"><b>Total due</b></p>
                                        <table class="table">
                                          <tbody>
                                            <tr>
                                              <td>Sub-Total Amount</td>
                                              <td class="text-right">KSH 14,900.00</td>
                                            </tr>
                                            <tr>
                                              <td>Previous Balance</td>
                                              <td class="text-right">KSH 1,788.00</td>
                                            </tr>
                                            <tr>
                                              <td class="text-bold-800">Total</td>
                                              <td class="text-bold-800 text-right"> KSH 16,688.00</td>
                                            </tr>
                                           
                                          </tbody>
                                        </table>
                                </div>
                            </div>
                                         
                                    
                                  
                            </form>       
                                    
                            Qty1 : <input type="text" name="qty1" id="qty"/><br>
Qty2 : <input type="text" name="qty2" id="qty"/><br>
Qty3 : <input type="text" name="qty3" id="qty"/><br>
Qty4 : <input type="text" name="qty4" id="qty"/><br>
Qty5 : <input type="text" name="qty5" id="qty"/><br>
Qty6 : <input type="text" name="qty6" id="qty"/><br
Qty7 : <input type="text" name="qty7" id="qty"/><br>
Qty8 : <input type="text" name="qty8" id="qty"/><br>
<br><br>
Total : <input type="text" name="total" id="total"/>

<a href="javascript:sumInputs()" name="total" id="total" >Total</a>   

<table width="300px" border="1" style="border-collapse:collapse;background-color:#E8DCFF">
	<tr>
		<td width="40px">1</td>
		<td>Butter</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr>
		<td>2</td>
		<td>Cheese</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr>
		<td>3</td>
		<td>Eggs</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr>
		<td>4</td>
		<td>Milk</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr>
		<td>5</td>
		<td>Bread</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr>
		<td>6</td>
		<td>Soap</td>
		<td><input class="txt" type="text" name="txt"/></td>
	</tr>
	<tr id="summation">
		<td>&nbsp;</td>
		<td align="right">Sum :</td>
		<td align="center"><span id="sum">0</span></td>
	</tr>
</table>       

                               
                               <button type="submit" class="btn btn-primary float-end" >Create Invoice</button>
                               
                            
                               
                       
                               
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
                    $("#dynamicAddRemove").append('<tr><td>' + i +'</td><td>  <input list="invoiceitems" id="invoiceitem"  name="itemname[]" placeholder="Type or select Item" class="form-control " /><datalist id="invoiceitems"><option value="Rent">@foreach($utilities as $row)<option value="{{$row->name}}"> @endforeach</datalist></td><td><input type="text" name="amountpaid[]" class="form-control" /></td><td>0</td><td><button type="button" class="btn btn-danger remove-input-field">Delete</button></td></tr>'
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
///////////////////////////////// SUM ////////////////////////////////////
                $(document).ready(function(){

                            //iterate through each textboxes and add keyup
                            //handler to trigger sum event
                    $("#txt").each(function() {

                                $(this).keyup(function(){
                                    calculateSum();
                                });
                            });

                            });

                            function calculateSum() {

                            var sum = 0;
                            //iterate through each textboxes and add the values
                            $("#txt").each(function() {

                                //add only if the value is number
                                if(!isNaN(this.value) && this.value.length!=0) {
                                    sum += parseFloat(this.value);
                                }

                            });
                            //.toFixed() method will roundoff the final sum to 2 decimal places
                            $("#sum").html(sum.toFixed(2));
                            }
                        
                                                                        
                                </script>
                                
                                <script type="text/javascript">
                            window.sumInputs = function() {
                                var inputs = document.getElementsByTagName('input'),
                                    result = document.getElementById('total'),
                                    sum = 0;            
                                
                                for(var i=0; i<inputs.length; i++) {
                                    var ip = inputs[i];
                                
                                    if (ip.name && ip.name.indexOf("total") < 0) {
                                        sum += parseInt(ip.value) || 0;
                                    }
                                
                                }
                                
                                result.value = sum;
                            }
</script>
          
</body>

@endsection
