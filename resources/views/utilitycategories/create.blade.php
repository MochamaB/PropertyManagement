
@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
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
                    <a href="{{ url('utilitycategories') }}" class="btn btn-danger float-end">BACK</a>
                    <br />
                    <h4>Add Utility Categories</h4>

                </div>
                <div class="card-body">

                    <form action="{{ url('add-utilitycategories') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Utility Name<span style="color:red;font-size:20px">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                            @if ($errors->has('name'))
                                            <span class="text-danger" style="font-size:12px">{{ $errors->first('name') }}</span>
                                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Bill Cycle:<span style="font-style:italic"> (Per Month or Per Unit)</span><span style="color:red;font-size:20px">*</span> </label>
                            <select name="billcycle" class="formcontrol2">
                                <option value="">Select cycle</option>
                                <option value="Permonth">Per month</option>
                                <option value="Units">Units Used</option>
                       
                            </select>
                            
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Rate <span style="font-style:italic"> (Optional)</span></label>
                            <input type="text" name="rate" class="form-control" value="{{ old('rate') }}"/>
                            @if ($errors->has('rate'))
                                            <span class="text-danger" style="font-size:12px">{{ $errors->first('rate') }}</span>
                                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Create Invoice For Category: <span style="color:red;font-size:20px">*</span></label>
                            <select name="create_invoice" id="attachto" class="formcontrol2" required>
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                       
                            </select>
   
                      
                            
                        </div>
                        <div class="form-group mb-3" id="attach_to" style="display:none">
                        <label for="">Select Parent Invoice Place Utility:</label>
                            <select name="parent_utility" id="attachto" class="formcontrol2" required>
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                       
                            </select>

                              
                           
                        </div>
                        <div class="form-group mb-3" id="input_to" style="display:none">
                        <input type="text" id="attachinput" name="parent_utility" />
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save Utility Type</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function() {
    jQuery("#attachto").change(function() {
        if (jQuery(this).val() === '0'){ 
            jQuery('#attach_to').show();   
        } else {
            jQuery('#attach_to').hide(); 
        }
    });
    jQuery("#attachto").change(function() {
        if (jQuery(this).val() === '1'){ 
            jQuery('#input_to').show();   
        } else {
            jQuery('#input_to').hide(); 
        }
    });
});
</script>


@endsection
