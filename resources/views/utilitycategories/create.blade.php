
@extends('layouts.admin')

@section('content')

<div class="container">
<div class="container">
    	<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="https://img.icons8.com/offices/30/000000/double-right.png" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Utility Categories</span></a><img class="ml-md-3" src="https://img.icons8.com/offices/30/000000/double-right.png" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Add Category</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    <div class="row justify-content-center">
        <div class="col-md-6">
        @include('layouts.partials.messages')	

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
                            <label for="">Utility Prefix<span style="color:red;font-size:20px">*</span></label>
                            <input type="text" name="prefix" class="form-control" placeholder="Prefix on documents Eg. Invoice" value="{{ old('prefix') }}" />
                            @if ($errors->has('prefix'))
                                            <span class="text-danger" style="font-size:12px">{{ $errors->first('prefix') }}</span>
                                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Create Invoice For Category: <span style="color:red;font-size:20px">*</span></label>
                            <select name="create_invoice" id="createinvoice" class="formcontrol2" required>
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group mb-3" id="parentname" style="display:none">
                        <label for=""><span style="color:red;font-size:20px">*</span>Select Parent Invoice Place Utility:<span style="color:red;font-size:20px">*</span></label>
                            <select name="parent_utility"  class="formcontrol2">
                                <option value="">Select</option>
                            @foreach($parentutility as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Bill Cycle/Type:<span style="color:red;font-size:20px">*</span> </label>
                            <select name="billcycle" id="billcycle" class="formcontrol2">
                                <option value="">Select the Billing cycle/ Bill Type</option>
                                <option value="Permonth" id="Permonth">Per month</option>
                                <option value="Units" id="Units">Units Used</option>
                                <option value="Maintenance" id="Maintenance">Maintenance Costs</option>
                                <option value="Fromlease" id="Fromlease">Charges Drawn From Lease -(Rent, Deposit etc)</option>
                              
                       
                            </select>
                            
                        </div>
                        <div class="form-group mb-3" id="rate">
                            <label for=""><span style="color:red;font-size:20px">*</span>Rate <span style="color:red;font-size:20px">*</span></label>
                            <input type="text" name="rate"  class="form-control" value="{{ old('rate') }}"/>
                            @if ($errors->has('rate'))
                                            <span class="text-danger" style="font-size:12px">{{ $errors->first('rate') }}</span>
                                            @endif
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
    jQuery("#createinvoice").change(function() {
        if (jQuery(this).val() === '0'){ 
            jQuery('#parentname').show();   
            jQuery('#Units').hide();
            jQuery('#Fromlease').hide();
        } else {
            jQuery('#parentname').hide();
           
        }
    });
    
    jQuery("#billcycle").change(function() {
        if (jQuery(this).val() === 'Fromlease'||
            jQuery(this).val() === 'Maintenance'){ 
            jQuery('#rate').hide();   
        } else {
            jQuery('#rate').show(); 
        }
    });

    
    
});
</script>


@endsection
