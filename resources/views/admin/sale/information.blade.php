@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-10 offset-1 ">

            <div class="">
                        <div class="row mb-3">
                            <div class="col-4 offset-8">
                              <form action="{{ route('admin#saleInformation') }}" method="get">
                                  <div class="input-group">
                                   <input type="text" name="orderCode" value="{{ request('orderCode') }}" class="form-control" placeholder="Enter Order Code...">
                                   <button type='submit' class="btn bg-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                              </form>
                            </div>
                        </div>
                    </div>

            <div class="card">
                <div class="card-header" style="margin-right: 10px">
                </div>
                <div class="card-body">
                    <table class="table table-hover shadow-sm "><span class="d-flex justify-content-center text-dark">Sale Information ( Total Amount - <span class="text-success"> {{ $total }} </span> mmk )</span>
                        <thead class="text-white" style=" background-color: #542344;">
                            <tr>
                                <th>Date</th>
                                <th>Order Code </th>
                                <th>Total Amount</th>

                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $item->created_at->format('d-F-Y') }}</td>
                                    <td><a href="{{ route('admin#orderdetails',$item->order_code) }}">{{ $item->order_code }}</a> </td>
                                    <td>{{ $item->total_price }} mmk</td>
                                </tr>
                           @endforeach
                        </tbody>



                </div>

            </div>



        @endsection
