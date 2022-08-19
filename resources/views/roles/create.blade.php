@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!---------  breadcrumbs ---------------->
    <div class="row ">
         <div class="col-auto col-md-10 ">
             <nav aria-label="breadcrumb " class="first d-md-flex">
                 <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5 ">
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase " href="#" style="text-decoration: none !important;"><span>&nbsp;Settings</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"> </li>
                     <li class="breadcrumb-item font-weight-bold"><a class="black-text text-uppercase" href="#" style="text-decoration: none !important;" ><span>Roles</span></a><img class="ml-md-3" src="{{ asset('Templateassets/img/double-right.png') }}"  width="20" height="20"></li>
                     <li class="breadcrumb-item font-weight-bold mr-0 pr-0"><a class="black-text active-1" href="#" style="text-decoration: none !important;"><span style="color:blue">Create Roles</span></a> </li>
                 </ol>
             </nav>
         </div>
     </div>



<!---------  breadcrumbs ---------------->
       
    <div class="col-12 grid-margin">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
        <div class="card">
                 <div class="card-header">
                    <br />
                    <a href="{{ url('roles') }}" class="btn btn-danger float-end">View All Roles</a><br/>
                    <h4>Create Role & Permissions</h4>
                </div>
                <div class="card-body">
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            <div class="col-md-6 form-group mb-3">
                                <label for="">Name of Role</label>
                                <input value="{{ old('name') }}" 
                                    type="text" 
                                    class="col-md-6 form-control " 
                                    name="name" 
                                    placeholder="Enter Name of Role" required>

                                    <input value="web" 
                                    type="hidden" 
                                    class="col-md-6 form-control " 
                                    name="guard_name" 
                                    >
                            </div><hr><div id="wrapper">
                            
                            <div class="form-group mb-3">
                            <h6 for="permissions" >Assign Permissions</h6>
                            <span style="font-size:13px;font-weight:600"><input class="" type="checkbox" onclick="toggle(this);" />  &nbsp;&nbsp;Select All<br /><br />
                            </span>
                            <table id="table"
                                   
                                   data-toggle="table"
                                   data-icon-size="sm"
                                   data-toolbar-align="right"
                                   data-buttons-align="left"
                                   data-buttons-class="primary"
                                   data-search-align="left"
                                   data-maintain-selected="true"
                                   data-sort-name="First Name"
                                   data-sort-order="asc"
                                   data-search="true"
                                   data-show-pagination-switch="true"
                                   data-sticky-header="true"
                                   data-pagination="true"
                                   data-page-list="[25, 50, 100, 200, 250, 500, ALL]"
                                   data-page-size="500"
                                   data-show-footer="false"
                                   data-side-pagination="client"
                                   
                                   class="table table-hover table-striped"
                                   style="font-size:12px">
                                <thead style="" class="sticky-header">
                                    <tr class="tableheading">
                                        <th data-sortable="true">#</th>
                                        <th data-sortable="true">Permission</th>
                                    </tr>
                                </thead>
                                <tbody style="padding-left:0; padding-right:0px">
                                @foreach ($permissions as $key => $permission)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><input type="checkbox" name="permission[{{ $permission->name }}]"
                                            value="{{ $permission->name }}"
                                            class='permission'>  &nbsp;&nbsp;{{ $permission->name }}
                                        </td>
                                    </tr>
                              @endforeach
                        </tbody>
                    </table>             
                            </div>
                            <button type="submit" class="btn btn-primary float-end">Save Role</button>
                           
                        </form>
                </div>        
        </div>

    </div>
    <script type="text/javascript">
       function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
    </script>
@endsection

@section('scripts')
    
@endsection