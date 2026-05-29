@extends('admin.layout.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <a href="{{ route('admin#orderList') }}" class=" text-black m-3" style="color: #542344;"> <i class="fa-solid fa-arrow-left-long" style="color: #542344;"></i> Back</a>

        <!-- DataTales Example -->


        <div class="row">
            <div class="card col-5 shadow-sm m-4 col">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5">Name :</div>
                        <div class="col-7">{{ $orderData[0]['name'] }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Phone :</div>
                        <div class="col-7">{{ $orderData[0]['phone'] }}

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Addr :</div>
                        <div class="col-7">{{ $orderData[0]['address'] }}

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Order Code :</div>
                        <div class="col-7 order-code">{{ $orderData[0]['order_code'] }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Order Date :</div>
                        <div class="col-7">{{ $orderData[0]['created_at']->format('d-F-y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Total Price :</div>
                        <div class="col-7">{{ $totalAmt }} mmk<br>
                            <small class=" text-danger ms-1">( Contain Delivery Charges )</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card col-5 shadow-sm m-4 col">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5">Contact Phone :</div>
                        <div class="col-7">{{ $paymentHistory['phone'] }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Payment Method :</div>
                        <div class="col-7">{{ $paymentHistory['payment_method'] }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Purchase Date :</div>
                        <div class="col-7">{{ $paymentHistory['created_at']->format('d-F-y') }}</div>
                    </div>

                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold" style="color: #542344;">Order Board</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-center">
                    <table class="table table-hover shadow-sm " id="productTable">
                        <thead class=" text-white " style=" background-color: #542344;">
                            <tr>
                                <th class="col-2">Image</th>
                                <th>Name</th>
                                <th>Order Count</th>
                                <th>Available Stock</th>
                                <th>Product Price (each)</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orderData as $item)
                                <tr>
                                    <input type="hidden" value="{{$item->product_id }}" class="productId">
                                    <td>
                                        <img src="{{ asset('productImage/'. $item['image']) }}" class=" w-50 img-thumbnail">
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td class="qty">{{$item->order_count}}</td>
                                    <td>
                                        {{$item->current_stock}}
                                        @if($item->order_count > $item->current_stock) <br>
                                        {{ $orderStatus = '' }}
                                        <small class="text-danger">( out of stock )</small>

                                        @endif
                                    </td>
                                    <td>{{$item->price}} mmk</td>
                                    <td>{{$item->order_count*$item->price}} mmk</td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>

            @if ($orderData[0]['status'] == 'rejected')
                <div class="card-footer d-flex justify-content-center">
                    <h5 class="text-danger">You has been rejected for this order !</h5>
            </div>
            @else
            <div class="card-footer d-flex justify-content-end">
                <div class="">
                   @if(!isset($orderStatus))<input type="button" id="btn-order-confirm" class="btn  btn-success rounded shadow-sm "  value="Confirm"> @endif

                   <a href="{{ route('admin#orderReject', $orderData[0]['order_code'] ) }}"> <input type="button" id="btn-order-reject" class="btn btn-danger rounded shadow-sm" value="Reject"></a>
                </div>
            </div>
            @endif
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('script-code')
<script>
    $(document).ready(function(){
        $('#btn-order-confirm').click(function(){

            orderCode = $('.order-code').text()

            orderProductList = []

            $('#productTable tbody tr').each(function(index,row){
                productId = $(row).find('.productId').val();
                qty = $(row).find('.qty').text()

                orderProductList.push({
                     'productId' : productId,
                    'orderCount' : qty,

                })
            })

            data = {
                'data' : orderProductList,
                 'orderCode' : orderCode
            }


            $.ajax({
                type : "GET",
                url : "{{ route('admin#orderAccept') }}",
                data : Object.assign({}, data),
                dataType : "json",
                success : function(res){
                    res.status == 200 ? location.href = "{{ route('admin#orderList') }}" : ""
                }
            });

        })
    })
</script>

@endsection
