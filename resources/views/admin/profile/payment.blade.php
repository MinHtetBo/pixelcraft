@extends('admin.layout.master')

@section('content')


  <div class="row">
        <div class="col-8 offset-2">
            <div class="card p-4">

                <div class="card-body">
                    <form action="{{ route('profile#payment') }}" method="post" >
                        @csrf

                    <input type="text" name="accName" class="form-control px-2 my-2 @error('accName') is-invalid @enderror" placeholder="Enter Account Name...">
                    @error('accName')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                    <input type="text" name="accNumber" class="form-control px-2 my-2 @error('accNumber') is-invalid @enderror" placeholder="Enter Account Number...">
                    @error('accNumber')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                     <input type="text" name="accType" class="form-control px-2 my-2 @error('accType') is-invalid @enderror" placeholder="Enter Account Type...">
                    @error('accType')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror

                    <input type="submit" value="Create" class="btn w-100 text-white" style=" background-color: #542344;">
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@if (Session::has('success'))
    @section('script-code')
        <script>

                Swal.fire({
                title: "Payment Created Successfully !",
                icon: "success",
                draggable: true,
                timer: 1300,
                timerProgressBar: true
                });
        </script>
    @endsection
@endif
