<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Category;
use App\Models\Comments;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Payment_History;
use App\Models\Product;
use App\Models\Ratings;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    //direct user home page
    public function home(){


        $products = Product::select('products.id','products.name','products.price','products.image','products.description','categories.name as category_name')
                            ->leftJoin('categories','products.category_id','categories.id')
                            // when user click category tag
                            ->when(request('categoryId'), function($query){
                                $categoryId = request('categoryId');
                                $query->where('products.category_id',$categoryId);
                            })
                            // when user search products by name
                            ->when(request('searchKey'), function($query){
                                $key = request('searchKey');
                                $query->where('products.name','like','%'.$key.'%');
                            })
                            // min > products < max
                            ->when(request('minPrice')|| request('maxPrice'), function($query){
                                $min = request('minPrice');
                                $max = request('maxPrice');

                                   if(request('minPrice')){
                                    $query->where('products.price','>=',$min);
                            }

                             if(request('maxPrice')){
                                    $query->where('products.price','<=',$max);
                            }
                            })

                            ->orderBy('products.created_at','desc')
                            ->get();

        $categories = Category::select('id','name')->get();

        return view('user.dashboard.home',compact('products','categories'));
    }

    //edit profile
    public function edit(){
        return view('user.profile.edit');
    }

    //profile update
   public function update(Request $request, $id)
    {
        $this->validationCheck($request);

        $updateData = $this->getAccountData($request);

        if ($request->hasFile('image')) {

            //null -> new image upload
            //not null -> old image delete -> new image upload

            if (auth()->user()->profile !== null) {
                $oldImage = auth()->user()->profile;

                // old profile image delete
                if (file_exists(public_path('userProfile/' . $oldImage))) {
                    unlink(public_path('userProfile/' . $oldImage));
                }
            }

            // new profile image upload
            $newImage = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('userProfile/'), $newImage);

            $updateData['profile'] = $newImage;
        }

        User::find($id)->update($updateData);

        return back()->with(['success' => 'profile update success.']);
    }

    private function getAccountData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }

    private function validationCheck($request)
    {
        $request->validate([
            'name' => 'required|min:2|max:30',
            'email' => 'required|min:4|max:50',
            'phone' => 'required|min:2',
            'address' => 'required|min:3|max:100'
        ]);
    }

    //change password page
     public function changePasswordPage()
    {
        return view('user.profile.changePassword');
    }

    // change password process
    public function changePassword(Request $request)
    {

        $this->passwordValidationCheck($request);

        $dbPasswordStatus = auth()->user()->password;

        $passwordCheckValidate = Hash::check($request->oldPassword, $dbPasswordStatus);

        if ($passwordCheckValidate) {
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->newPassword)]);
            return back()->with(['success' => 'password change success.']);
        }

        return back()->with(['fail' => 'password change fail.Try again!.']);
    }

     // password validation check
    private function passwordValidationCheck($request)
    {
        $request->validate([
            'oldPassword'  => 'required|min:5|max:20',
            'newPassword' => 'required|min:5|max:20',
            'confirmPassword' => 'required|min:5|max:20|same:newPassword'
        ]);
    }

    //products details
    public function productDetails($id){
        $products = Product::select('products.*','categories.name as category_name')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->where('products.id',$id)
                    ->first();

        $comments = Comments::select('comments.id as comment_id','comments.product_id','comments.user_id','users.profile','users.name','comments.message','comments.created_at')
                        ->leftJoin('users','comments.user_id','users.id')
                        ->where('comments.product_id',$id)
                        ->orderBy('comments.created_at','desc')
                        ->get();

        $rating = Ratings::where('product_id', $id)->where('user_id', auth()->user()->id)->value('count');

        $avgRating = ceil(Ratings::where('product_id',$id)->avg('count'));


       return view('user.product.details', compact('products','comments','rating','avgRating'));
    }

    //comment
    public function comment(Request $request){
        Comments::create([
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'message' => $request->comment
        ]);

        return back()->with(['success' => 'comment success.']);

    }

    //delete comment
        public function deleteComment($commentId){
        Comments::where('id',$commentId)->delete();
        return back();
    }

    //rating
     public function rating(Request $request){
        Ratings::updateOrCreate([
            'user_id' => $request->userId,
            'product_id' => $request->productId
            ],   [
            'count' => $request->productRating
        ]);
        return back()->with(['ratingSuccess' => 'rating success.']);

     }

    // cart
    public function cart(){
        $orderItems = Carts::select('carts.id','carts.user_id','carts.product_id','carts.quantity','products.name','products.price','products.image')
                            ->leftJoin('products','carts.product_id','products.id')
                            ->where('user_id', auth()->user()->id)
                            ->get();

        return view('user.cart.list', compact('orderItems'));
    }

    // add to cart
    public function addToCart(Request $request){
        Carts::create([
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'quantity' => $request->count
        ]);
         return back()->with(['cartSuccess' => 'cart success.']);
    }

    // delete cart
    public function deleteCart(Request $request){

        Carts::where('id',$request->deleteCartId)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'cart delete success'
        ]);
    }


    public function cartTemp(Request $request){
        Session::put('tempCart',$request->all());
       return response()->json([
        'status' => 200,
        'message' => 'session store success'
       ]);
    }

    // direct payment page
    public function paymentPage(Request $request){


        $order = Session::get('tempCart');
        $orderCode = $order[0]['order_code'];
        $total = 5000; //deli

        foreach($order as $item){
            $total += $item['total_price'];
        }

        $paymentAccount = Payment::orderBy('account_type','asc')->get();
        return view('user.cart.payment', compact('paymentAccount', 'orderCode','total'));
    }



    // payment
    public function payment(Request $request){

        // $request->validate([
        //     'name' => 'required',
        //     'phone' => 'required',
        //     'address' => 'required',
        //     'paymentType' => 'required',
        //     'payslipImage' => 'required'
        // ]);


        $order = Session::get('tempCart');
        $total = 5000 ;

        foreach($order as $item){
            Order::create($item);
            $total += $item['total_price'];
        }


        $paymentHistoryData = [
            'user_id' => auth()->user()->id,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->paymentType,
            'order_code' => $order[0]['order_code'],
            'total_amount' => $total
        ];


        if($request->hasFile('payslipImage')){
                    $fileName = uniqid() . $request->file('payslipImage')->getClientOriginalName();
                    $request->file('payslipImage')->move(public_path('payslip/'), $fileName);
                    $paymentHistoryData['payslip_image'] = $fileName;
                }


         Payment_History::create($paymentHistoryData);

        Carts::where('user_id', auth()->user()->id)->delete(); //clear cart

        return to_route('user#myOrder');

    }


       // direct myOrder page
    public function myOrder(){
        $orderLists = Order::select('created_at','status','order_code')
                        ->where('user_id',auth()->user()->id)
                        ->groupBy('order_code')
                        ->orderBy('order_code','desc')
                        ->get();

        return view('user.cart.myOrder', compact('orderLists'));
    }

    // direct contact page
    public function contactPage(){
        return view('user.cart.contact');
    }

    // contact create
    public function contact(Request $request){
        // $this->contactFormValidation($request);
        Contact::create([
            'user_id' => auth()->user()->id,
            'user_name' => $request->accName,
            'user_email' => $request->email,
            'title' => $request->title,
            'message' => $request->contactMessage
        ]);
        return back()->with(['success'=>'Message sent Successfully']);
    }

    // contact form validation
    //  private function contactFormValidation($request)
    // {
    //     $request->validate([
    //         'user_name' => 'required|min:1|max:20',
    //         'user_email' => 'required',
    //         'message' => 'required'
    //     ]);
    // }


}
