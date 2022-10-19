
@extends('layouts.admin')

@section('content')

<div class="container">
    <!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Properties</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>House Categories</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Create New Category</span></a> </li>
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
                    <a href="{{ url('housecategories') }}" class="btn btn-danger float-end">BACK</a>
                    <br />
                    <h4>Add House Categories</h4>

                </div>
                <div class="card-body">

                    <form action="{{ url('add-housecategories') }}" method="POST">
                        @csrf

                       
                        <div class="form-group mb-3">
                            <label for="">House Type <span style="color:red;font-size:20px">*</span></label>
                            <input type="text" name="type" value="{{ old('type') }}" class="form-control" />
                                @if ($errors->has('type'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('type') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Approximate Price of House</label>
                            <input type="text" name="price" value="{{ old('price') }}"  class="form-control" />
                                @if ($errors->has('price'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('price') }}</span>
                                @endif
                        </div>
                       
                        <div class="form-group mb-3">
                        @if( Auth::user()->can('Apartments.create'))
                                                <label  style="font-size:13px;font-weight:500;">Apartment <span style="color:red;font-size:20px">*</span></label></br>
                                                <select class="formcontrol2" name="apartment_id" required>
                                                    <option value="">Select Apartment</option>
                                                    @foreach($apartment as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                    <select>
                                
                                                    
                                        @else
                                            <input type="hidden" name="apartment_id" value="{{ Auth::user()->apartment_id}}"/>            
                                        @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Rent Payable <span style="color:red;font-size:20px">*</span></label>
                            <input type="text" name="rent" value="{{ old('rent') }}"  class="form-control" />
                                @if ($errors->has('rent'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('rent') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3"></br>
                            <label for="">Expected Deposit <span style="color:red;font-size:20px">*</span></label>
                            <input type="text" name="setdeposit" value="{{ old('setdeposit') }}"  class="form-control" />
                                @if ($errors->has('setdeposit'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('setdeposit') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3"></br>
                            <label for="">Description</label>
                            <textarea class="form-control"  name="description" value="{{ old('description') }}" rows="4" cols="50"> </textarea>
                          
                                @if ($errors->has('description'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('description') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save Category</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
