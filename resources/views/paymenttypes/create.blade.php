
@extends('layouts.admin')

@section('content')

<div class="container">
    <!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Payments</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Create New Payment Type</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    <div class="row justify-content-center">
        <div class="col-md-7">
        @include('layouts.partials.messages')	
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('paymenttypes') }}" class="btn btn-danger float-end">BACK</a>
                    <br />
                    <h4>Add Payment Types</h4>

                </div>
                <div class="card-body">

                    <form action="{{ url('add-paymenttype') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Payment Name</label>
                            <input type="text" name="paymentname" class="form-control" />
                                @if ($errors->has('paymentname'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('paymentname') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Account Number</label>
                            <input type="text" name="accountnumber" class="form-control" />
                                @if ($errors->has('accountnumber'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('accountnumber') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Account Name</label>
                            <input type="text" name="accountname" class="form-control" />
                                @if ($errors->has('accountname'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('accountname') }}</span>
                                @endif
                        </div>
                       
                        <div class="form-group mb-3">
                            <label for="">Provider / Bank</label>
                            <input type="text" name="bank" class="form-control" />
                                @if ($errors->has('bank'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('bank') }}</span>
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
