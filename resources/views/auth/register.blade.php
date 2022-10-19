@extends('layouts.client')

@section('content')

       
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-md-5"></div>
                <div class="col-md-7">
                <div class="text-center">
										
										<h1 class="h3 text-gray-900 mb-4">
											<b>
												<b>{{$settings->systemname}}</b>
											</b><br /><br />Register
										</h1>
									</div>
                    <div class="card">
                        <div class="card-header"></div>
                             <!-- Validation Errors -->
         @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                            <ul class="" style="color:red">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            </div>
        @endif
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus />

                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!------------------------ -------------->
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required />

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="color:red">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- Email Address -->
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required />

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="color:red">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- ConfirmPassword -->
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right"></label>

                                    <div class="col-md-6">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        
        

@endsection
