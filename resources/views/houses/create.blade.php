@extends('layouts.admin')

@section('content')

<div class="container">
    <!---------  breadcrumbs ---------------->
    <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Properties</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Houses</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Add Houses</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
    <div class="row justify-content-center">
        <div class="col-md-8">

       @include('layouts.partials.messages')

            <div class="card">
                <div class="card-header">
                <a href="{{ url('house') }}" class="btn btn-danger float-end">View Houses</a><br/>
                    <h4>Add Houses</h4>
                </div>
                <div class="card-body">
                <form action="{{ url('add-house') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">House Category</label></br>
                            <select name="housecategoryid" class="formcontrol2" />
                                <option value="">Select House Categories</option>
                                @foreach($housecategories as $item)
                                <option value="{{$item->id}}">{{$item->type}}
                        @if( Auth::user()->can('Apartments.create')) - {{$item->apartment->name}} @endif
                                </option>
                                @endforeach
                            </select>
                                @if ($errors->has('housecategoryid'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('housecategoryid') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">House Number</label>
                            <input type="text" name="housenumber" class="form-control" />
                                @if ($errors->has('housenumber'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('housenumber') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control" />
                                @if ($errors->has('title'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('title') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Meter Number</label>
                            <input type="text" name="meternumber" class="form-control" />
                                @if ($errors->has('meternumber'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('meternumber') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3"></br>
                            <label for="">Description</label>
                            <textarea class="form-control"  name="description" value="{{ old('description') }}" rows="4" cols="50"> </textarea>
                          
                                @if ($errors->has('description'))
                                    <span class="text-danger" style="font-size:12px;font-weight:700;">{{ $errors->first('description') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Status</label>
                            <input type="text" name="status" class="form-control" value="Empty" readonly />
                                @if ($errors->has('status'))
                                    <span class="text-danger" style="font-size:12px">{{ $errors->first('status') }}</span>
                                @endif
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Save House</button>
                        </div>

                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
