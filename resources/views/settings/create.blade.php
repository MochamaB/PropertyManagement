@extends('layouts.admin')

@section('content')
    
    

<div class="container">
    <!---------  breadcrumbs ---------------->
    <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Settings</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>System Settings</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Create Settings</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>
     <div class="row justify-content-center">
        <div class="col-md-8">
        @include('layouts.partials.messages')

            <div class="card">
                <div class="card-header">
                    <a href="{{ url('settings') }}" class="btn btn-danger float-end">BACK</a>
                    <br />
                    <h4>Configure System</h4>

                </div>
                <div class="card-body">

                    <form action="{{ url('add-setting') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">System Name</label>
                            <input type="text" name="systemname" value="{{ old('systemname') }}"class="form-control" />
                                @if ($errors->has('systemname'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('systemname') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Company/ Developer/ Name</label>
                            <input type="text" name="companyname" value="{{ old('companyname') }}" class="form-control" />
                                @if ($errors->has('companyname'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('companyname') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control" />
                                @if ($errors->has('email'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('email') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Postal Code</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="form-control" />
                                @if ($errors->has('postal_code'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('postal_code') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Telephone Number</label>
                            <input type="text" name="phonenumber" value="{{ old('phonenumber') }}" class="form-control" />
                                @if ($errors->has('phonenumber'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('phonenumber') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Add Logo</label>
                            <input type="file" name="logo" value="{{ old('logo') }}" class="form-control" id="logo" />
                            <img id="logo-image-before-upload" src="{{ url('uploads/Images/noimage.jpg') }}"
                                            style="height: 100px; width: 150px;">
                                @if ($errors->has('logo'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('logo') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}" class="form-control" />
                                @if ($errors->has('location'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('location') }}</span>
                                @endif
                        </div>
        
                        <div class="form-group mb-3">
                            <label for="">Add Flavicon</label>
                            <input type="file" name="flavicon" value="{{ old('flavicon') }}" class="form-control" id="flavicon" />
                            <img id="flavicon-image-before-upload" src="{{ url('uploads/Images/noimage.jpg') }}"
                                            style="height: 100px; width: 150px;">    
                            @if ($errors->has('flavicon_photo'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('flavicon_photo') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save Configuration</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

     </div>
     <script type="text/javascript">
      
$(document).ready(function (e) {
 
   
   $('#logo').change(function(){
            
    let reader = new FileReader();
 
    reader.onload = (e) => { 
 
      $('#logo-image-before-upload').attr('src', e.target.result); 
    }
 
    reader.readAsDataURL(this.files[0]); 
   
   });

   $('#flavicon').change(function(){
            
            let reader = new FileReader();
         
            reader.onload = (e) => { 
         
              $('#flavicon-image-before-upload').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
           
           });
   
});
 
</script>
@endsection