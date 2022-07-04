<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function add(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'add-customer', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to add customer']);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('name')){
                return redirect()->back()->with(['notify_error' => 'Customer Name is Required'])->withErrors(['name' => 'Customer Name Required']);
            }
            if ($validator->errors()->has('email')){
                return redirect()->back()->with(['notify_error' => 'Email Address is Required'])->withErrors(['email' => 'Email Address is Required']);
            }
            if ($validator->errors()->has('password')){
                return redirect()->back()->with(['notify_error' => 'Password is Required'])->withErrors(['password' => 'Password is Required']);
            }
        }
        $validated = $validator->validated();
        try {
            $exist_user = User::where('email', '=', $validated['email'])->first();
            if ($exist_user != null){
                return redirect()->back()->with(['notify_error' => 'Email Address Already Registered'])->withErrors(['email' => 'Your Email Already have account, please try login now']);
            }
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = Hash::make($validated['password']);
            $user->mobile = isset($request->mobile)?$request->mobile:null;
            $user->save();
            return redirect()->back()->with(['success' => 'Customer Added Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }
    public function edit(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'edit-customer', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to edit customer']);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'user_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('name')){
                return redirect()->back()->with(['notify_error' => 'Customer Name is Required'])->withErrors(['name' => 'Customer Name Required']);
            }
            if ($validator->errors()->has('email')){
                return redirect()->back()->with(['notify_error' => 'Email Address is Required']);
            }
            if ($validator->errors()->has('user_id')){
                return redirect()->back()->with(['notify_error' => 'User ID is Required']);
            }
        }
        $validated = $validator->validated();
        try {
            $exist_user = User::where('email', '=', $validated['email'])->first();
            if ($exist_user == null){
                return redirect()->back()->with(['notify_error' => 'Can not find Customer Account']);
            }
            $exist_user->name = $validated['name'];
            $exist_user->email = $validated['email'];
            if (isset($request->password) && $request->password != null){
                $exist_user->password = Hash::make($request->password);
            }
            $exist_user->mobile = isset($request->mobile)?$request->mobile:null;
            $exist_user->save();
            return redirect()->back()->with(['success' => 'Customer Updated Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }


    public function delete(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'delete-customer', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to delete customer']);
        }

        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('user_id')){
                return redirect()->back()->with(['notify_error' => 'User ID is Required to delete customer']);
            }
        }
        $validated = $validator->validated();
        try {
            $user = User::where('user_id', '=', $validated['user_id'])->first();
            if ($user == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify customer']);
            }
            $user->delete();
            return redirect()->back()->with(['success' => 'Customer Deleted Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }
}
