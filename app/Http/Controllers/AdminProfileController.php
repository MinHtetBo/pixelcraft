<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AdminProfileController extends Controller
{
    // profile details
    public function details()
    {
        return view('admin.profile.details');
    }

    public function edit()
    {
        return view('admin.profile.edit');
    }

    // change password page
    public function changePasswordPage()
    {
        return view('admin.profile.changePassword');
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

    // delete account
    public function delete($id){
        User::where('id', $id)->delete();
         return back();
    }

    // add new admin account page
    public function addNewAdminPage()
    {
        return view('admin.profile.addNewAdminAccount');
    }

    // add new admin
    public function addNewAdmin(Request $request)
    {
        $this->adminAccountValidationCheck($request);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'provider' => 'simple',
            'role' => 'admin'
        ]);
         return back()->with(['success' => 'password change success.']);
    }

    // admin account validation check
    private function adminAccountValidationCheck($request)
    {
        $request->validate([
            'name' => 'required|min:1|max:20',
            'email' => 'required|min:5|max:20|unique:users,email',
            'password' => 'required|min:5|max:20',
            'confirmPassword' => 'required|min:5|max:20|same:password'
        ]);
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

    // admin list page
    public function accountList($accountType) {

        $accounts = User::select('id', 'name', 'email', 'address', 'phone', 'role', 'created_at', 'provider');

       if($accountType == 'admin'){
             $accounts =  $accounts->whereIn('role', ['admin','superadmin']);
         }
        else if($accountType == 'user'){
             $accounts =  $accounts->whereIn('role', ['user']);
        }

        if(request('searchKey')){
            $key = request('searchKey');
            $accounts->where(function($query) use($key){
                $query->whereAny(['name','email','address','phone','role'],'like','%'.$key.'%');
            });
        }

        $accounts = $accounts ->get();

        return view( $accountType == 'admin' ? 'admin.profile.adminList': 'admin.profile.userList', compact('accounts'));


    }


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
                if (file_exists(public_path('adminProfile/' . $oldImage))) {
                    unlink(public_path('adminProfile/' . $oldImage));
                }
            }

            // new profile image upload
            $newImage = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->image->move(public_path('adminProfile/'), $newImage);

            $updateData['profile'] = $newImage;
        }

        User::find($id)->update($updateData);

        return to_route('profile#details');
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

    // payment page
    public function paymentPage(){
        return view('admin.profile.payment');
    }

    // payment create
    public function payment(Request $request){
        $this->passwordValidationCheck($request);
         Payment::create([
                'account_name'=> $request->accName,
                'account_number' => $request->accNumber,
                'account_type' => $request->accType
         ]);
       return back()->with(['success'=>' payment create successfully']);
    }

    // payment validation
     private function paymentValidationCheck($request)
    {
        $request->validate([
            'account_name' => 'required',
            'account_number' => 'required',
            'account_type' => 'required'
        ]);
    }


}
