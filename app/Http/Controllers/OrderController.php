<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment_History;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
      //order list
    public function orderList($state = ''){

        $orderList = Order::select('orders.id as order_id','orders.created_at','orders.order_code','orders.status','users.name as customer_name')
                            ->leftJoin('users','orders.user_id','users.id')
                            ->when(request('orderCode'),function($query){
                            $query->where('orders.order_code','like','%'.request('orderCode').'%');
                        });

                    if($state == 'reject'){
                            $orderList = $orderList->where('orders.status','=','rejected');
                    }else{
                             $orderList = $orderList->where('orders.status','!=','rejected');
                    }
                           $orderList = $orderList->groupBy('orders.order_code')
                            ->orderBy('orders.created_at','desc')
                            ->paginate('5');

        return view('admin.order.orderList', compact('orderList'));
    }

    // order details
    public function orderdetails($orderCode){
        $orderData = Order::select('products.id as product_id','products.name','products.price','products.image','products.stock as current_stock','orders.count as order_count','users.name','users.phone','users.address','orders.order_code','orders.status','orders.created_at','orders.total_price')
                            ->leftJoin('users','orders.user_id','users.id')
                            ->leftJoin('products','orders.product_id','products.id')
                            ->where('orders.order_code',$orderCode)
                            ->get();

        $paymentHistory = Payment_History::select('*')
                                            ->where('order_code',$orderCode)
                                            ->first();



        $totalAmt = 5000;
        foreach($orderData as $item){
            $totalAmt += $item['total_price'];
        }

        return view('admin.order.details',compact('orderData','totalAmt','paymentHistory'));
    }

    // reject
    public function orderReject($orderCode){
        Order::where('order_code',$orderCode)->update([
            'status' => 'rejected'
        ]);
        return to_route('admin#orderList');
    }

    // accept order
    public function orderAccept(Request $request){

        Order::where('order_code',$request['orderCode'])->update([
                'status' => 'success'
            ]);

        //reduce order count
        foreach($request['data'] as $item){
            Product::where('id',$item['productId'])->decrement('stock',$item['orderCount']);
        }

        return response()->json([
            'status' => 200,
            'message' => 'order comfirm'
        ]);
    }


}
