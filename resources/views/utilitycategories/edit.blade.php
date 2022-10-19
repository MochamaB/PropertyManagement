@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>utilities</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Edit Utilities</span></a> </li>
                 </ol>
             </nav>
         </div>

        <div class="col-md-8">
        @include('layouts.partials.messages')	

            <div class="card">
                <div class="card-header">
                    <h4>
                        Edit & Update Utility Categories
                        <a href="{{ url('utilitycategories') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('update-utilitycategories/'.$utilitycategories->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{$utilitycategories->name}}" class="form-control" readonly/>
                        </div>

                         <div class="form-group mb-3">
                            <label for="">Bill Cycle:<span style="font-style:italic"> (Per Month or Per Unit)</span> </label>
                            <select name="billcycle" value="{{$utilitycategories->billcycle}}" class="formcontrol2">
                                <option value="">Select</option>
                                <option value="Permonth">Per month</option>
                                <option value="Units">Units Used</option>
                       
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Rate</label>
                            <input type="text" name="rate" value="{{$utilitycategories->rate}}" class="form-control" />
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update utility Category</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
