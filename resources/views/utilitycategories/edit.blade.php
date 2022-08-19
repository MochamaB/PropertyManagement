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
                    <h4>
                        Edit & Update Utility Categories
                        <a href="{{ url('utilitycategories') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('update-utilitycategories/'.$utilitycategories->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                         <div class="form-group mb-3">
                            <label for="">Bill Cycle:<span style="font-style:italic"> (Per Month or Per Unit)</span> </label>
                            <select name="billcycle" value="{{$utilitycategories->billcycle}}" class="formcontrol2">
                                <option value="">Select</option>
                                <option value="Permonth">Per month</option>
                                <option value="Units">Units Used</option>
                       
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Rate</label>
                            <input type="text" name="rate" value="{{$utilitycategories->rate}}" class="form-control" />
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update utility Category</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
