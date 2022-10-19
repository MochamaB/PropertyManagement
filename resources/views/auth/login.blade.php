@extends('layouts.client')

@section('content')


   
        <div class="container">
            <div class="row justify-content-center">
                <div class="row">
                    <div class="col-md-6"></div>
                <div class="col-md-6">
                    			<div class="text-center">
										<br /><br />
										<h1 class="h3 text-gray-900 mb-4">
											<b>
												<b>{{$settings->systemname}}</b>
											</b><br /><br />Login
										</h1>
									</div>
                    <div class="card">
                        <div class="card-body">
                            
                            @if ($errors->has('email'))
                            <div class="alert alert-danger" role="alert">
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            </div>
                                @endif
                                @if (session('status'))
                                <div class="alert alert-success" role="success">
                                            <span class="invalid-feedback">
                                            <strong>{{ session('status') }}</strong>
                                            </span>
                                </div>
                                @endif
                            
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus />

                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required />

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Remember Me -->



                                <div class="form-group row mb-4" align="right">
                                    <div class="col-md-10 offset-md-4">
                                        @if (Route::has('password.request'))
                                        <a class="btn btn-link" href=" {{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                        @endif

                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Log in') }}
                                        </button>
                                    </div>
                                </div>
                            </form><br /><br />
                        </div>
                        </div>
                </div>
                    </div>
            </div>
        </div>


@endsection
