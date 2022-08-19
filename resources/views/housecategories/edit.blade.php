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
                                    <h4>
                                        Edit & Update House Categories
                                        <a href="{{ url('housecategories') }}" class="btn btn-danger float-end">BACK</a>
                                    </h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{ url('update-housecategories/'.$housecategories->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        
                                            <div class="form-group mb-3">
                                            @if( Auth::user()->can('Apartments.create'))
                                                <label for="apartment">Apartment</label>
                                                <select class="form-control" name="apartment_id" required>
                                                    <option value="{{$housecategories->apartment->id}}">{{$housecategories->apartment->name}}</option>
                                                    @foreach($apartment as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                    <select>
                                
                                                    
                                        @else
                                            <input type="hidden" name="apartment_id" value="{{ Auth::user()->apartment_id}}"/>            
                                        @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">House Type</label>
                                            <input type="text" name="type" value="{{$housecategories->type}}" class="form-control" />
                                                @if ($errors->has('type'))
                                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('type') }}</span>
                                                @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Price</label>
                                            <input type="text" name="price" value="{{$housecategories->price}}" class="form-control" />
                                            @if ($errors->has('price'))
                                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('price') }}</span>
                                                @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Expected Deposit</label>
                                            <input type="text" name="setdeposit" value="{{$housecategories->setdeposit}}" class="form-control" />
                                                @if ($errors->has('setdeposit'))
                                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('setdeposit') }}</span>
                                                @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <button type="submit" class="btn btn-primary">Update House Category</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
</div>
@endsection
