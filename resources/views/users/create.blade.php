@extends('layouts.admin')

@section('content')
<div class="container-fluid">

<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;SETTINGS</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Users</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Create Users</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
      

<div class="col-8 grid-margin">
        @if($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                    <ul class="" style="color:red">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    </div>
                @endif

            <div class="card">
                 <div class="card-header">
                    <br />
                    <a href="{{ url('users') }}" class="btn btn-danger float-end">View All Users</a><br/>
                    <h4>Add User</h4>
                </div>
                <div class="card-body">
                    
                <form method="POST" action="{{ route('Users.store') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name </label>
                    <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input value="" type="email" class="form-control" name="email" placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                @if( Auth::user()->can('Apartments.create'))
                <div class="form-group mb-3">
                    <label for="apartment">Apartment</label>
                    <select class="form-control" name="apartment_id" required>
                        <option value="">Select Apartment</option>
                        @foreach($apartment as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                        <select>
    
                </div>
                @else
                    <input type="hidden" name="apartment_id" value="{{ Auth::user()->apartment_id}}"/>            
                @endif
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input value="{{ old('username') }}" type="password" class="form-control" name="password" placeholder="Username" required>
                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                </div>
                <div class="form-group mb-3">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required />
                
                </div>

                <button type="submit" class="btn btn-primary">Save user</button>
              
                </form>
                </div>
            </div>

    </div>
@endsection
