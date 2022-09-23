@extends('layouts.admin')

@section('content')
    
    

<div class="container">
    <!---------  breadcrumbs ---------------->
    <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Properties Information</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Apartments</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Apartments</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>
     <div class="row justify-content-center">
        <div class="col-md-8">
        @include('layouts.partials.messages')

            <div class="card">
                <div class="card-header">
                    <a href="{{ url('apartments') }}" class="btn btn-danger float-end">BACK</a>
                    <br />
                    <h4>Add Apartments</h4>

                </div>
                <div class="card-body">

                    <form action="{{ url('add-apartments') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Name of Apartment</label>
                            <input type="text" name="name" value="{{ old('name') }}"class="form-control" />
                                @if ($errors->has('name'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('name') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Apartment Number</label>
                            <input type="text" name="apartmentno" value="{{ old('apartmentno') }}" class="form-control" />
                                @if ($errors->has('apartmentno'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('apartmentno') }}</span>
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
                            <input type="text" name="postalcode" value="{{ old('postalcode') }}" class="form-control" />
                                @if ($errors->has('postalcode'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('postalcode') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Telephone Number</label>
                            <input type="text" name="tel" value="{{ old('tel') }}" class="form-control" />
                                @if ($errors->has('tel'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('tel') }}</span>
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
                            <label for="">Name of Manager</label>
                            <input type="text" name="authorized_person" value="{{ old('authorized_person') }}" class="form-control" />
                                @if ($errors->has('authorized_person'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('authorized_person') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Add Signature</label>
                            <input type="file" name="signature_photo" value="{{ old('signature_photo') }}" class="form-control" id="signature" />
                            <img id="signature-image-before-upload" src="{{ url('uploads/Images/noimage.jpg') }}"
                                            style="height: 100px; width: 150px;">    
                            @if ($errors->has('signature_photo'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('signature_photo') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save Apartment</button>
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

   $('#signature').change(function(){
            
            let reader = new FileReader();
         
            reader.onload = (e) => { 
         
              $('#signature-image-before-upload').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
           
           });
   
});
 
</script>
@endsection