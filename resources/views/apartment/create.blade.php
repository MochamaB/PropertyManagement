@extends('layouts.admin')

@section('content')
    
    

<div class="container">
    <!---------  breadcrumbs ---------------->
    <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Properties Information</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Apartments</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Apartments</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>
     <div class="row justify-content-center">
        <div class="col-md-6">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Sucess! </strong> {{ session('status') }}. 
                        <button type="button" class="btn-success float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>    
            @endif
             @if (session('statuserror'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error! </strong> {{ session('statuserror') }}. 
                        <button type="button" class="btn-danger float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>    
            @endif
             @if($errors->all())
            <h6 class="alert alert-danger">Check Validation Errors in the form!</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <a href="{{ url('apartments') }}" class="btn btn-danger float-end">BACK</a>
                    <br />
                    <h4>Add Apartments</h4>

                </div>
                <div class="card-body">

                    <form action="{{ url('add-apartments') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Name of Apartment</label>
                            <input type="text" name="name" value="{{ old('name') }}"class="form-control" />
                                @if ($errors->has('name'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('name') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Apartment Number</label>
                            <input type="text" name="apartmentno" value="{{ old('apartmentno') }}" class="form-control" />
                                @if ($errors->has('apartmentno'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('apartmentno') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control" />
                                @if ($errors->has('email'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('email') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Postal Code</label>
                            <input type="text" name="postalcode" value="{{ old('postalcode') }}" class="form-control" />
                                @if ($errors->has('postalcode'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('postalcode') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Telephone Number</label>
                            <input type="text" name="tel" value="{{ old('tel') }}" class="form-control" />
                                @if ($errors->has('tel'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('tel') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save Apartment</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

     </div>
@endsection