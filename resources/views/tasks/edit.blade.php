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
    <div class="col-md-8">
        @include('layouts.partials.messages')
            <div class="card">
                <div class="card-header"></br>
                    <h4>
                        Edit & Update Tasks
                        <a href="{{ url('tasks') }}" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">

                    <form action="{{ url('update-task/'.$tasks->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="">Title</label>
                            <input type="text" name="title" value="{{$tasks->title}}" class="form-control" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Type</label>
                            <input type="text" name="type" value="{{$tasks->type}}" class="form-control" readonly/>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Frequency</label>
                            <input type="text" name="frequency" value="{{$tasks->frequency}}" class="form-control" readonly/>
                        </div>
                         <div class="form-group col-md-6 mb-3">
                            <label for="">Select Date:</label>
                            <select name="date" value="" class="formcontrol2" required>
                                <option value="{{$tasks->date}}">Current Date: {{$tasks->date}}</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>

                       
                            </select>
                        </div>
                        <div class="form-group col-md-5 mb-3">
                            <label for="">Time</label>
                            <input type="time" name="time" value="{{$tasks->time}}" class="form-control" required/>
                        </div>
                        <div class="form-group col-md-5 mb-3">
                            <label for="">Status:</label>
                            <select name="status" value="" class="formcontrol2" required>
                                <option value="{{$tasks->status}}">Edit Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>    
                        
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Update Task </button>
                        </div>

                    </form>

                </div>
            </div>
    </div>

</div>



@endsection