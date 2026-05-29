@extends('admin.layout.master')

@section('content')
    <div class="row">
        <div class="col-10 offset-1 ">

            <div class="">
                        <div class="row mb-3">
                            <div class="col-4 offset-8">
                              <form action="{{ route('admin#orderList') }}" method="get">
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
                      <a href="{{ route('admin#orderList','') }}"> <span class=" btn btn-sm btn-outline-success">Order List</span></a>
                  <a href="{{ route('admin#orderList','reject') }}"> <span class=" btn btn-sm btn-outline-danger">Reject List</span></a>
                </div>
                <div class="card-body">
                    <table class="table table-hover shadow-sm "><span class="d-flex justify-content-center text-dark">Order List</span>
                        <thead class="text-white" style=" background-color: #542344;">
                            <tr>
                                <th>Order Code</th>
                                <th class="col-4">Date</th>
                                <th>Customer Name </th>
                                <th>Status</th>
                                 <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($orderList) != 0)
                                @foreach ($orderList as $item)
                                    <tr>
                                        <td><a href="{{ route('admin#orderdetails',$item->order_code) }}">{{ $item->order_code }}</a> </td>
                                        <td class="col-4">{{ $item->created_at->format('d-F-Y') }}</td>
                                        <td>{{ $item->customer_name }}</td>
                                        <td>
                                            @if ($item->status == 'preparing')
                                                <span class="text-warning"> Pending <i
                                                        class="fa-solid fa-circle-clock"></i></span>
                                            @elseif ($item->status == 'rejected')
                                                <span class="text-danger"> Rejected <i
                                                        class="fa-solid fa-circle-xmark"></i></span>
                                            @elseif ($item->status == 'success')
                                                <span class="text-success"> Accepted <i
                                                        class="fa-solid fa-circle-check"></i></span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">There is no order!</td>
                                </tr>
                            @endif
                        </tbody>

                        <span class="d-flex justify-content-end">{{$orderList->links()}}</span>

                </div>

            </div>



        @endsection
