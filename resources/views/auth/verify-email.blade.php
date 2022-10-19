@extends('layouts.client')

@section('content')

<div class="register-area" style="background-color: rgb(249, 249, 249);">
            <div class="container">

                <div class="col-md-6">
                    
                </div>

                <div class="col-md-6">
                                        <h1 class="h3 text-gray-900 mb-4">
												<b>{{$settings->systemname}}</b>
										</h1></b><br />

                        @if (session('status'))
                     
                        <div class="alert alert-success" role="alert">
                                <span class="invalid-feedback">
                                <strong>Sucess! </strong> {{ session('status') }}. 
                                </span>
                            </div>
                        @endif
                    <div class="box-for overflow">  
                    
                        <div class="col-md-12 col-xs-12 login-blocks" style="padding-left:25px ;">
                            <h2>Verify Email Address: </h2> 
                            <p> Thanks for signing up! Before getting started, 
                                could you verify your email address by clicking on the link we just emailed to you? </p>
                              <p>  If you didn't receive the email, we will gladly send you another.</p>
                                <br />
                                <div class="col-md-6">  
                                <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                
                                    <button type="submit" class="btn btn-primary float-left">
                                        Resend Verification Email
                                    </button>
                                
                                </form>
                                </div>
                                <div class="col-md-6 text-right">
                                <form method="POST" action="{{ route('logout') }}">
                               
                                    <button type="submit" class="btn btn-info float-end"> Log Out</button>
                                
                                </form>
                                </div>
                                <br />
                            <br>
                            
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>      


@endsection

