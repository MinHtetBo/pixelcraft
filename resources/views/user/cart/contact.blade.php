@extends('user.layout.master')

@section('content')

     <div class="container mt-5 pt-5">
        <div class="row">
        <div class="col-8 offset-2">
            <div class="card p-4">

                <div class="card-body">
                    <form action="{{ route('user#contact') }}" method="post" >
                        @csrf

                    <input type="text" name="accName" class="form-control px-2 my-3 @error('accName') is-invalid @enderror" placeholder="Enter Name..." value="{{ old('accName') }}">
                    @error('accName')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                    <input type="text" name="email" class="form-control px-2 my-3 @error('email') is-invalid @enderror" placeholder="Enter email..." value="{{ old('email') }}">
                    @error('email')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                     <input type="text" name="title" class="form-control px-2 my-3 @error('title') is-invalid @enderror" placeholder="Enter title..." value="{{ old('title') }}">
                    @error('title')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                    <textarea name="contactMessage" id="" cols="30" rows="7"  class="form-control px-2 my-3 @error('contactMessage') is-invalid @enderror" placeholder="Enter Message...">{{ old('contactMessage') }}</textarea>
                        @error('contactMessage')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                    <input type="submit" value="Send" class="btn w-100 text-white" style=" background-color: #542344;">
                    </form>
                </div>
            </div>
        </div>
    </div>
     </div>



@endsection

@if (Session::has('success'))
    @section('script-code')
        <script>

                Swal.fire({
                title: "Message sent Successfully",
                icon: "success",
                draggable: true,
                timer: 1300,
                timerProgressBar: true
                });
        </script>
    @endsection
@endif
