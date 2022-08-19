
@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">

            @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
            @endif

            <div class="card">
                <div class="card-header">
                    <br /><a href="{{ url('house') }}" class="btn btn-danger float-end">BACK</a><br />
                    <h4>Edit & Update House
                        
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('update-house/'.$houses->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="">House Number</label>
                            <input type="text" name="housenumber" value="{{$houses->housenumber}}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                                <label>House Type</label>
                                <select name="housecategoryid" value="{{$houses->housenumber}}" class="js-example-basic-single w-100" >
                                @foreach($housecategories as $row)
                                <option value="{{ $row->ID }}">{{ $row->type }}</option>
                                @endforeach
                                </select>
                        </div>
                        
                          <div class="form-group mb-3">
                            <label for="">Status</label>
                            <input type="text" name="" class="form-control" value="{{$houses->status}}" readonly/>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update House</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
