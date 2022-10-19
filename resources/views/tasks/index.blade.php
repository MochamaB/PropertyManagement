@extends('layouts.admin')

@section('content')
<div class="container-fluid">
<div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Settings</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Tasks</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}" width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Tasks View</span></a> </li>
                 </ol>
             </nav>
         </div>
         <div>

        </div>
     </div></br>


<!---------  breadcrumbs ---------------->
<br />
                       <button class="btn btn-primary btn-lg text-white mb-0 me-0" style="float:right" type="button" onclick="window.location='{{ url("/tasks") }}'">
                         <i class="mdi mdi-calendar-clock"></i>Add Task</button>
                       <br />
                    <h4>List of Scheduled Tasks</h4>

    <div class="table-responsive">

    <table id="table"
                                   
                                   data-toggle="table"
                                   data-icon-size="sm"
                                   data-toolbar-align="right"
                                   data-buttons-align="left"
                                   data-search-align="left"
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
								   
								    data-show-export="true"
                                        data-buttons-class="primary"
								   
								   
								   data-buttons-class="primary"
                                   
                                   class="table table-hover table-striped"
                                   style="font-size:12px">
                                <thead  class="sticky-header">
                                    <tr class="tableheading">
                                        <th data-sortable="true">ID</th>
                                        <th data-sortable="true">Title</th>
                                        <th>Type</th>
                                        <th>Frequency</th>
                                        <th >Date </th>
                                        <th>Time </th>
                                        <th>Status </th>
                                        <th>Actions </th>
   
                                    </tr>

                                </thead>
                                <tbody style="padding-left:0; padding-right:0px">
                            
                            <tr>
                                @foreach($tasks as $item)
                                <td>{{$item->id}}</td>
                                
                                <td>{{$item->title}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->frequency}}</td>
                                <td>{{$item->date}}th</td>                        
                                <td>{{$item->time}}</td>
                                @if($item->status == 1)
                                <td><span style="color:green;font-weight:700">Active</span></td>
                                @else <td><span style="color:red;font-weight:700">In Active</span></td>
                                @endif
                                <td>
                                <a href="{{ url('edit-task/'.$item->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-lead-pencil"></i></a>
                                
                                    <a href="{{ url('delete-task/'.$item->id) }}" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
                                </td>
                               @endforeach
                            </tr>
                          
                        </tbody>
                    </table>

    </div>




</div>



@endsection