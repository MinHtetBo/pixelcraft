@extends('user.layout.master')

@section('content')
    <div class="container " style="margin-top: 150px">
        <div class="row">
            <div class="card col-12 shadow-sm">
                <div class="card-body">
                    <div class="row">

                        <div class="col-5">
                            <h5 class="mb-4">Payment methods</h5>


                            @foreach ($paymentAccount as $item)
                                <div class="">
                                    <b></b> ( Name : {{ $item->account_name }} )
                                </div>

                                Account : {{ $item->account_number }} <br>
                                {{ $item->account_type }}

                                <hr>
                            @endforeach

                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    Payment Info (<span class="text-success">{{ $orderCode }}</span>) <br>
                                    Total Amount is :  <span class="text-success fw-bold">{{ $total }} mmk</span>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <form action="{{ route('user#payment') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <input type="text" id="" class="form-control "
                                                        value="{{ auth()->user()->name }}" readonly>
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="phone" id=""
                                                        class="form-control  @error('phone') is-invalid @enderror"
                                                        placeholder="09xxxxxxxx"  value="{{ old('phone') }}">
                                                    @error('phone')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="address" id=""
                                                        class="form-control  @error('address') is-invalid @enderror"
                                                        placeholder="Address..."  value="{{ old('address') }}">
                                                    @error('address')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <select name="paymentType" id=""
                                                        class=" form-select  @error('paymentType') is-invalid @enderror">
                                                        <option value="">Choose Payment methods...</option>
                                                        @foreach ($paymentAccount as $item)
                                                            <option value="{{ $item->id }}" @if (old('paymentType') == $item->id) selected  @endif>{{ $item->account_type }}

                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('paymentType')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <input type="file" name="payslipImage" accept="image/*"
                                                        class="form-control  @error('payslipImage') is-invalid @enderror">
                                                    @error('payslipImage')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col">

                                                </div>
                                                <div class="col">

                                                </div>
                                            </div>

                                            <div class="row mt-4 mx-2">
                                                <button type="submit" class="btn w-100"
                                                    style="background-color:#542344; "><i class="fa-solid fa-cart-shopping "
                                                        style="color:#BFD1E5;"></i> Order
                                                    Now...</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (Session::has('paymentSuccess'))
    @section('script-code')
        <script>
            Swal.fire({
                title: "Payment Successful",
                icon: "success",
                draggable: true,
                timer: 1300,
                timerProgressBar: true
            });
             setInterval(() => {
                location.reload();
          }, 1300)

        </script>
    @endsection
@endif
