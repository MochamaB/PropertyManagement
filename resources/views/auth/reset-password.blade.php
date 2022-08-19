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
												<b>MJ. Hinga Propert Agency System</b>
											</b><br /><br />Reset Password
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
 
        
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label>Email</label>

                <input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
            </div>

            <!-- Password -->
            <div>
            <label for="Password">Password</label>

                <input id="password" class="form-control" type="password" name="password" required />
                @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
            </div>

            <!-- Confirm Password -->
            <div>
                <label>Confirm Password</label>

                <input id="password_confirmation" class="form-control"
                                    type="password"
                                    name="password_confirmation" required />
                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
            </div>

</br>
            <button type="submit" class="btn btn-primary">
                    Reset Password
                <button>
            
        </form>
    </div>
    </div>
                
    </div>  
            </div>  
</div>


@endsection
