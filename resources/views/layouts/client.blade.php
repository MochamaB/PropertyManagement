<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>{{$settings->systemname}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('Templateassets/assets/css/normalize.css') }}" />
    <link rel="stylesheet" href="Templateassets/assets/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="Templateassets/assets/css/fontello.css') }}" />
    <link href="{{ asset('Templateassets/assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
    <link href="{{ asset('Templateassets/assets/fonts/icon-7-stroke/css/helper.css') }}" rel="stylesheet" />
    <link href="{{ asset('Templateassets/assets/css/animate.css" rel="stylesheet') }}" media="screen" />
    <link rel="stylesheet" href="{{ asset('Templateassets/assets/css/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('Templateassets/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('Templateassets/assets/css/icheck.min_all.css') }}" />
    <link rel="stylesheet" href="{{ asset('Templateassets/assets/css/price-range.css') }}" />
    <link rel="stylesheet" href="{{ asset('Templateassets/assets/css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('Templateassets/assets/css/owl.theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('Templateassets/assets/css/owl.transitions.css') }}" />
    <link rel="stylesheet" href="{{ asset('Templateassets/assets/css/wizard.css') }}" />
    <link rel="stylesheet" href="{{ asset('Templateassets/assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('Templateassets/assets/css/responsive.css') }}" />

     <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('template/images/faviconnew.png') }}" />


</head>
<body>

    <!---- Top Header ----------->
    <div class="header-connect">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-8  col-xs-12">
                    <div class="header-half header-call">
                        <p>
                            <span>
                                <i class="pe-7s-call"></i><b>Call {{$settings->phonenumber}}</b>
                            </span>
                            <span>
                                <i class="pe-7s-mail"></i><b> {{$settings->email}}</b>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-2 col-md-offset-5  col-sm-3 col-sm-offset-1  col-xs-12">
                    <div class="header-half header-social">
                        <ul class="list-inline">
                            <li>
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-vine"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---------  End of Top Header ----------->
    <!---------  Start of Navbar Header ----------->
    <nav class="navbar navbar-default ">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                <img src="{{ url('uploads/Images/'.$settings->logo) }}"
                style="width:210px; height:100px;margin-top:-55px;" />
                    
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse yamm" id="navigation">

                <ul class="main-nav nav navbar-nav navbar-left">
                    <li class="dropdown ymm-sw " data-wow-delay="0.1s">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="wow fadeInDown" data-wow-delay="0.5s">

                        <a href="{{ url('/aboutus') }}">About</a>
                    </li>
                    <li class="wow fadeInDown" data-wow-delay="0.2s">
                        <a class="" href="properties.php">Properties</a>
                    </li>
                    <li class="wow fadeInDown" data-wow-delay="0.5s">
                        <a href="contact.php">Contact</a>
                    </li>
                    <li class="wow fadeInDown" data-wow-delay="0.5s">
                        <a href="{{ url('/terms') }}">Terms</a>
                    </li>
                </ul>
                <div class="button navbar-right">
                    <button class="navbar-btn nav-button wow bounceInRight login" onclick=" window.location.replace('{{ route('login') }}')" data-wow-delay="0.45s">Login</button>
                    <button class="navbar-btn nav-button wow fadeInRight" onclick=" window.location.replace('{{ route('register')}}')" data-wow-delay="0.48s">New Tenant Registration</button>
                </div>
            </div><!-- /.navbar-collapse --><br />
        </div><!-- /.container-fluid -->
    </nav>
    <!-- End of nav bar -->

    <div class="">
        @yield('content')
    </div>

     <!-- Footer area-->
        <div class="footer-area">


            <div class="footer-copy text-center">
                <div class="container">
                    <div class="row">
                        <div class="pull-left">
                            <span> (C) Created by <a href="http://www.bridgetech.co.ke"></a>Bridge Technologies , All rights reserved 2022  </span> 
                        </div> 
                        <div class="bottom-menu pull-right"> 
                            <ul> 
                                <li><a class="wow fadeInUp animated" href="index.php" data-wow-delay="0.2s">Home</a></li>
                                <li><a class="wow fadeInUp animated" href="property.php" data-wow-delay="0.3s">Property</a></li>
                                <li><a class="wow fadeInUp animated" href="login.php" data-wow-delay="0.4s">Login</a></li>
                                <li><a class="wow fadeInUp animated" href="contract.php" data-wow-delay="0.6s">Contact</a></li>
                            </ul> 
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script src="Templateassets/assets/js/modernizr-2.6.2.min.js"></script>

        <script src="Templateassets/assets/js/jquery-1.10.2.min.js"></script> 
        <script src="Templateassets/bootstrap/js/bootstrap.min.js"></script>
        <script src="Templateassets/assets/js/bootstrap-select.min.js"></script>
        <script src="Templateassets/assets/js/bootstrap-hover-dropdown.js"></script>

        <script src="Templateassets/assets/js/easypiechart.min.js"></script>
        <script src="Templateassets/assets/js/jquery.easypiechart.min.js"></script>

        <script src="Templateassets/assets/js/owl.carousel.min.js"></script>
        <script src="Templateassets/assets/js/wow.js"></script>
        <script src="Templateassets/assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
        <script src="Templateassets/assets/js/wizard.js"></script>
        <script src="Templateassets/assets/js/icheck.min.js"></script>
        <script src="Templateassets/assets/js/price-range.js"></script>

        <script src="Templateassets/assets/js/main.js"></script>
  </body>
</html>


</body>
</html>
