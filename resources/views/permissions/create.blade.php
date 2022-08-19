@extends('layouts.admin')

@section('content')
<div class="container-fluid">

<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Settings</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Permissions</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Create Permissions</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
      

<div class="col-8 grid-margin">
                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                 @endif
                @if($errors->all())
                <h6 class="alert alert-danger">Check Error messages in the form!</h6>
                @endif
            <div class="card">
                 <div class="card-header">
                    <br />
                    <a href="{{ url('permissions') }}" class="btn btn-danger float-end">View All Permissions</a><br/>
                    <h4>Add Permission</h4>
                </div>
                <div class="card-body">
                <form method="POST" action="{{ route('permissions.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name of Permissions</label>
                    <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                
                <button type="submit" class="btn btn-primary">Save Permission</button>
              
                </form>
                </div>
            </div>

    </div>
@endsection
