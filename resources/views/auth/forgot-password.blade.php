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
        <div class="mb-4 text-sm text-gray-600">
        Forgot your password? No problem. Type your email address and we will email you a password reset link. 
        </div><br/>

        <!-- Session Status -->
        @if (session('status'))
        <div class="alert alert-sucess" role="success">
                    <span class="invalid-feedback">
                    <strong>{{ session('status') }}</strong>
                    </span>
        </div>
         @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email">Email</label>

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus />
                @if ($errors->has('email'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('email') }}</span>
                                @endif
                                <br/>    
            <button type="submit" class="btn btn-primary">
                    Email Password Reset Link
                <button>
            </div>
        </form>
        </div>
                        </div>
                </div>
                    </div>
            </div>
        </div>


@endsection

