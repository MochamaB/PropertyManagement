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

     @include('layouts.partials.messages')	
     
   
                     <div style="align-items:end">
                        <br />
                        <a href="{{ url('/add-apartments') }}" class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right"><i class="mdi mdi-account-plus"></i>Add new Apartment</a>
                       </div><br />
                        <h4>List of Apartments</h4>
                     
                <div class="table-responsive">

                   <table id="table"
                                   
                                   data-toggle="table"
                                   data-icon-size="sm"
                                   data-toolbar-align="right"
                                   data-buttons-align="left"
                                   data-buttons-class="primary"
                                   data-search-align="left"
                                   data-show-export="true"
                                   data-maintain-selected="true"
                                   data-sort-name="First Name"
                                   data-sort-order="asc"
                                   data-search="true"
                                   data-show-pagination-switch="true"
                                   data-sticky-header="true"
                                   data-pagination="true"
                                   data-page-list="[100, 200, 250, 500, ALL]"
                                   data-page-size="100"
                                   data-show-footer="false"
                                   data-side-pagination="client"
                                   
                                   class="table table-hover table-striped"
                                   style="font-size:12px">
                                <thead  class="sticky-header">
                                    <tr class="tableheading">
                                        <th></th>
                                        <th>Name</th>
                                        <th>Logo</th>
                                        <th>Apartment No</th>
                                        <th>Email</th>
                                        <th>Tel No</th>
                                        <th>Location</th>
                                        <th>Manager</th>
                                        <th>No of houses</th>
                                        <th>Signature</th>
                                        <th>Actions</th>
                                     </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apartments as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img src="{{ url('uploads/Images/'.$item->logo) }}"
                                            style="height: 100px; width: 150px;">
	                                    </td>
                                        <td>{{ $item->apartmentno }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->tel }}</td>
                                        <td>{{ $item->location }}</td>
                                        <td>{{ $item->authorized_person }}</td>
                                        
                                        <td>@foreach($item->house as $house)
                                            {{$house->housenumber}}
                                            @endforeach
                                        </td>
                                        <td>
                                            <img src="{{ url('uploads/Images/'.$item->signature_photo) }}"
                                            style="height: 100px; width: 150px;">
	                                    </td>
                                        
                                        <td >
                     
                                            <a href="{{ url('edit-apartments/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i></a>
                                
                                            <a href="{{ url('delete-apartments/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                    </table>
                </div>



</div>
@endsection