@extends('layouts.admin')

@section('content')
<!-----  Top Bar ----------------->
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 

                  <div class="alert alert-success alert-dismissible fade show" id="welcomemessage" role="alert" style="border-left:5px solid #34B1AA;">
                     <h3><strong>Welcome To Hinga Properties </strong><h3>  
                        <button type="button" class="btn-success float-end" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h6>First time Login? Contact Administrator to gain access to the system<h6>
                </div>
                
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div>
                            <p class="statistics-title" >Number of Houses</p>
                            <h3 class="rate-percentage padding-left:5px;">{{$house->count()}}</h3>
                            <p class="text-success d-flex">Occupied<span>&nbsp;- {{$occupied}}</span>
                            </p>
                            <p class="text-danger d-flex">Vacant<span>&nbsp;- {{$vacant}}</span></p> 
                          </div>
                          <div>
                            <p class="statistics-title">Number of Tenants</p>
                            <h3 class="rate-percentage padding-left:5px;">{{$house->count()}}</h3>
                            <p class="text-success d-flex">Active <span>&nbsp;- {{$occupied}}</span>
                            </p>
                            <p class="text-danger d-flex">Dormant <span>&nbsp;- {{$vacant}}</span></p> 
                          </div>
                          <div>
                            <p class="statistics-title">Number of Users</p>
                            <h3 class="rate-percentage padding-left:5px;">{{$house->count()}}</h3>
                            <p class="text-success d-flex">Employees <span>&nbsp;- {{$occupied}}</span></p>
                            <p class="text-danger d-flex">Tenants <span>&nbsp;- {{$vacant}}</span></p> 
                          </div>
                          <div>
                            <p class="statistics-title">Total Revenue Collected</p>
                            <h3 class="rate-percentage padding-left:5px;">{{$house->count()}}</h3>
                            <p class="text-success d-flex">This Year <span>&nbsp;- {{$occupied}}</span></p>
                            <p class="text-danger d-flex">This Month <span>&nbsp;- {{$vacant}}</span></p> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>  

@endsection
