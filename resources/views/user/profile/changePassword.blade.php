@extends('user.layout.master')

@section('content')

 <div class="container-fluid">

        <!-- Page Heading -->
        <div class="">
            <div class="row mt-5">
                <div class="col-8 offset-2">

                    <div class="card ">
                        <div class="card-body shadow mt-5">
                            <form action="{{ route('user#changePassword') }}" method="post" class="p-3 rounded">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Old Password</label>
                                    <input type="password" name="oldPassword"
                                        class="form-control @error('oldPassword') is-invalid @enderror"
                                        placeholder="Enter Old Password...">

                                    @error('oldPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="newPassword"
                                        class="form-control @error('newPassword') is-invalid @enderror"
                                        placeholder="Enter New Password...">

                                    @error('newPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="confirmPassword"
                                        class="form-control @error('confirmPassword') is-invalid @enderror"
                                        placeholder="Enter Confirm Password...">

                                    @error('confirmPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="">
                                    <input type="submit" value="Change" class="btn bg-dark text-white">
                                </div>
                            </form>
                        </div>
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
                title: "Success",
                html: "Passsword Change Successfully",
                icon: "success",
                timer: 2000,
                timerProgressBar: true
                });

        </script>
    @endsection
@endif

@if (Session::has('fail'))
    @section('script-code')
        <script>

                Swal.fire({
                title: "Failed",
                html: "Old Password Does Not Match In Our Record.Try Again!",
                icon: "error",
                timer: 2000,
                timerProgressBar: true
                });

        </script>
    @endsection
@endif

