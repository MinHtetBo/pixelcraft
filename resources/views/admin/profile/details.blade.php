@extends('admin.layout.master')

@section('content')


     <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 col">
                        <div class="card-header py-3">
                            <div class="">
                                <div class="">
                                    <h6 class="m-0 font-weight-bold text-primary">Admin Profile ( Role - <span class="text-danger"> {{ Auth()->user()->role }} </span> ) </h6>
                                </div>
                            </div>
                        </div>


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">

                                        <img class="img-profile img-thumbnail" id="output" src="{{ asset(Auth()->user()->profile == null ? 'defaultImage/defaultProfile.jpg' : 'adminProfile/'. auth()->user()->profile) }}">

                                    </div>
                                    <div class="col">

                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">

                                                    <i class="bi bi-pencil-square me-2"></i> Name</label>
                                                    <h5>{{ Auth()->user()->name }}</h5>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label"><i class="bi bi-envelope"></i>
                                                        Email</label>
                                                    <h5>{{ Auth()->user()->email }}</h5>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label"> <i class="bi bi-telephone"></i>
                                                        Phone</label>
                                                    <h5>{{ Auth()->user()->phone }}</h5>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label"> <i class="bi bi-geo-alt"></i>
                                                        Address</label>
                                                    <h5>{{ Auth()->user()->address }}</h5>
                                                </div>
                                            </div>
                                        </div>


                                         <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label"> <i class="bi bi-clock"></i>
                                                        Created Date</label>
                                                    <h5>{{ Auth()->user()->created_at->format('d-M-Y')}}</h5>
                                                </div>
                                            </div>
                                         </div>

                                         <a href="{{ route('change#passwordPage') }}">Change Password</a><br>


                                       <a href="{{ route('profile#edit') }}"> <input type="button" value="Edit" class="btn btn-primary mt-3"></a>
                                    </div>
                                </div>
                            </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

@endsection
