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
                                <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Edit Users</span></a> </li>
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
                            <a href="{{ url('users') }}" class="btn btn-danger float-end">View All Users</a><br/>
                            <h4>Edit User</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('users.update', $user->id) }}">
                                @method('patch')
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input value="{{ $user->name }}" 
                                        type="text" 
                                        class="form-control" 
                                        name="name" 
                                        placeholder="Name" required>

                                    @if ($errors->has('name'))
                                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input value="{{ $user->email }}"
                                        type="email" 
                                        class="form-control" 
                                        name="email" 
                                        placeholder="Email address" required>
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
                                        @if ($errors->has('apartment_id'))
                                            <span class="text-danger text-left">{{ $errors->first('apartment_id') }}</span>
                                        @endif
                                    </div>
                                    @else
                                    <input type="hidden" name="apartment_id" value="{{$user->apartment_id}}"/>
                                    @endif
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-control" 
                                        name="role" required>
                                        <option value="">Select role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ in_array($role->name, $userRole) 
                                                    ? 'selected'
                                                    : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Update user</button>
                                
                            </form>
                        </div>
                </div>            
        </div>

    </div>
@endsection
