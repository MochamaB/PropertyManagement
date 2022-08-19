@extends('layouts.admin')

@section('content')


<div class="container">
<!---------  breadcrumbs ---------------->
     <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Operations</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Utilities</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">View All Utility Categories</span></a> </li>
                 </ol>
             </nav>
         </div>
    <div class="row">
        <div class="col-md-12">
                    @include('layouts.partials.messages')
            <div class="card">
                                                                   
                <div class="card-header">
                     <div style="align-items:end">
                        <br />
                       <button class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/add-utilitycategories") }}'">
                         <i class="mdi mdi-account-plus"></i>Add new Utility</button>
                       </div><br />
                    <h4>List of Utility Types</h4>
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Bill Cycle:</th>
                                <th>Rate</th>
                                <th>Invoicable</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($utilitycategories as $key=> $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->billcycle }}</td>
                                @if( $item->rate == null)
                                <td>None</td>
                                @else
                                <td>{{ $item->rate }}</td>
                                @endif
                                @if( $item->create_invoice == 1)
                                <td>Yes</td>
                                @else<td>No</td>
                                @endif
                                <td>
                                @if( $item->billcycle == 'Units') 
                                <a href="{{ url('add-reading/') }}" class="btn btn-dark btn-sm">Readings</a>
                                @endif   
                                <a href="{{ url('edit-utilitycategories/'.$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ url('delete-utilitycategories/'.$item->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
