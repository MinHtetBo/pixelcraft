@extends('user.layout.master')

@section('content')

 <div class="container-fluid">


      <div class="mt-5">
          <div class="card shadow col">
             <a href="{{ route('user#home') }}"><button class="btn btn-sm btn-secondary mb-2">Back</button></a>
            <form action="{{ route('user#update', auth()->user()->id) }}"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">

                            <img class="img-profile img-thumbnail" id="output" src="{{ asset(Auth()->user()->profile == null ? 'defaultImage/defaultProfile.jpg' : 'userProfile/'. auth()->user()->profile) }}">


                            <input type="file" name="image" id="" class="form-control mt-1 " onchange="loadFile(event)">

                        </div>

                        <div class="col mt-5">
                            <div class="row">
                                <div class="col">

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name..."
                                            value="{{ old('name', Auth()->user()->name) }}">

                                             @error('name')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Email</label>
                                        <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', Auth()->user()->email) }}"
                                            placeholder="Email...">

                                             @error('email')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Phone</label>
                                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', Auth()->user()->phone) }}"
                                            placeholder="09xxxxxx">

                                             @error('phone')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Address</label>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', Auth()->user()->address) }}"
                                            placeholder="Enter your address...">

                                             @error('address')
                                                <small class="invalid-feedback">{{$message}}</small>
                                            @enderror

                                    </div>
                                </div>
                            </div>


                            <input type="submit" value="Update" class="btn btn-primary mt-3">
                        </div>

                    </div>
                </div>
            </form>
        </div>
      </div>

    </div>

@endsection

@if (Session::has('success'))
    @section('script-code')
        <script>

                Swal.fire({
                title: "Success",
                html: "Profile Update Successfully",
                icon: "success",
                timer: 2000,
                timerProgressBar: true
                });

        </script>
    @endsection
@endif
