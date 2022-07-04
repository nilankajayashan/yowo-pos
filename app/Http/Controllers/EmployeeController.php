<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function add(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'add-employee', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to add employee']);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('name')){
                return redirect()->back()->with(['notify_error' => 'Employee Name is Required'])->withErrors(['name' => 'Employee Name Required']);
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
            $exist_employee = Employee::where('email', '=', $validated['email'])->first();
            if ($exist_employee != null){
                return redirect()->back()->with(['notify_error' => 'Email Address Already Registered'])->withErrors(['email' => 'Your Email Already have account, please try login now']);
            }
            $employee = new Employee();
            $employee->name = $validated['name'];
            $employee->email = $validated['email'];
            $employee->password = Hash::make($validated['password']);
            $employee->mobile = isset($request->mobile)?$request->mobile:null;
            $employee->status = 0;
            $employee->added_by = session()->get('auth_employee')->employee_id;
            //insert permissions
            $permission_list = ['dashboard'];
            //category permissions
            isset($request->view_category)?array_push($permission_list,'view-category'):'';
            isset($request->add_category)?array_push($permission_list,'add-category'):'';
            isset($request->edit_category)?array_push($permission_list,'edit-category'):'';
            isset($request->delete_category)?array_push($permission_list,'delete-category'):'';
            isset($request->approve_category)?array_push($permission_list,'approve-category'):'';
            (isset($request->add_category) || isset($request->edit_category) || isset($request->delete_category) || isset($request->approve_category))?(!in_array('view-category', $permission_list))?array_push($permission_list,'view-category'):'':'';

            //product permissions
            isset($request->view_product)?array_push($permission_list,'view-product'):'';
            isset($request->add_product)?array_push($permission_list,'add-product'):'';
            isset($request->edit_product)?array_push($permission_list,'edit-product'):'';
            isset($request->delete_product)?array_push($permission_list,'delete-product'):'';
            isset($request->approve_product)?array_push($permission_list,'approve-product'):'';
            (isset($request->add_product) || isset($request->edit_product) || isset($request->delete_product) || isset($request->approve_product))?(!in_array('view-product', $permission_list))?array_push($permission_list,'view-product'):'':'';

            //sell permissions
            isset($request->view_sell)?array_push($permission_list,'view-sell'):'';
            isset($request->add_sell)?array_push($permission_list,'add-sell'):'';
            isset($request->edit_sell)?array_push($permission_list,'edit-sell'):'';
            isset($request->delete_sell)?array_push($permission_list,'delete-sell'):'';
            (isset($request->add_sell) || isset($request->edit_sell) || isset($request->delete_sell))?(!in_array('view-sell', $permission_list))?array_push($permission_list,'view-sell'):'':'';

            //order permissions
            isset($request->view_order)?array_push($permission_list,'view-order'):'';
            isset($request->add_order)?array_push($permission_list,'add-order'):'';
            isset($request->edit_order)?array_push($permission_list,'edit-order'):'';
            isset($request->delete_order)?array_push($permission_list,'delete-order'):'';
            isset($request->manage_order)?array_push($permission_list,'manage-order'):'';
            (isset($request->add_order) || isset($request->edit_order) || isset($request->delete_order) || isset($request->manage_order))?(!in_array('view-order', $permission_list))?array_push($permission_list,'view-order'):'':'';

            //customer permissions
            isset($request->view_customer)?array_push($permission_list,'view-customer'):'';
            isset($request->add_customer)?array_push($permission_list,'add-customer'):'';
            isset($request->edit_customer)?array_push($permission_list,'edit-customer'):'';
            isset($request->delete_customer)?array_push($permission_list,'delete-customer'):'';
            (isset($request->add_customer) || isset($request->edit_customer) || isset($request->delete_customer))?(!in_array('view-customer', $permission_list))?array_push($permission_list,'view-customer'):'':'';

            //employee permissions
            isset($request->view_employee)?array_push($permission_list,'view-employee'):'';
            isset($request->add_employee)?array_push($permission_list,'add-employee'):'';
            isset($request->edit_employee)?array_push($permission_list,'edit-employee'):'';
            isset($request->delete_employee)?array_push($permission_list,'delete-employee'):'';
            isset($request->approve_employee)?array_push($permission_list,'approve-employee'):'';
            (isset($request->add_employee) || isset($request->edit_employee) || isset($request->delete_employee) || isset($request->approve_employee))?(!in_array('view-employee', $permission_list))?array_push($permission_list,'view-employee'):'':'';

            //cart permissions
            isset($request->view_cart)?array_push($permission_list,'view-cart'):'';
            isset($request->add_cart)?array_push($permission_list,'add-cart'):'';
            isset($request->edit_cart)?array_push($permission_list,'edit-cart'):'';
            isset($request->delete_cart)?array_push($permission_list,'delete-cart'):'';
            (isset($request->add_cart) || isset($request->edit_cart) || isset($request->delete_cart))?(!in_array('view-cart', $permission_list))?array_push($permission_list,'view-cart'):'':'';

            //website permissions
            isset($request->site_setting)?array_push($permission_list,'site-setting'):'';
            //end insert permissions
            $employee->permissions = json_encode($permission_list);
            $employee->save();
            return redirect()->back()->with(['success' => 'Employee Added Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }


    public function changeStatus(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'approve-employee', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to Active/De-active employee']);
        }
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('employee_id')){
                return redirect()->back()->with(['notify_error' => 'Employee id required to Active/De-active employee']);
            }
            return redirect()->back()->with(['notify_error' => 'Something went wrong...!']);
        }
        $validated = $validator->validated();
        try{
            $employee = Employee::where('employee_id', '=', $validated['employee_id'])->first();
            if ($employee == null){
                return redirect()->back()->with(['notify_error' => 'Not exist employee with this employee id']);
            }
            if ($employee->status == 1){
                $employee->status = 0;
                $employee->approved_by = session()->get('auth_employee')->email;
                $employee->save();
                return redirect()->back()->with(['success' => 'Employee De-active Successfully']);
            }else{
                $employee->status = 1;
                $employee->approved_by = session()->get('auth_employee')->email;
                $employee->save();
                return redirect()->back()->with(['success' => 'Employee Active Successfully']);
            }
        }catch (Exception $exception){
            return redirect()->back()->with(['notify_error' => 'Something went wrong...!']);
        }
    }

    public function delete(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'delete-employee', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to delete employee']);
        }
        $validator = Validator::make($request->all(),[
            'employee_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('employee_id')){
                return redirect()->back()->with(['notify_error' => 'Employee ID is Required to delete employee']);
            }
        }
        $validated = $validator->validated();
        try {
            $category = Employee::where('employee_id', '=', $validated['employee_id'])->first();
            if ($category == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify employee']);
            }
            $category->delete();
            return redirect()->back()->with(['success' => 'Employee Deleted Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function edit(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'edit-employee', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to edit employee']);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'employee_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('name')){
                return redirect()->back()->with(['notify_error' => 'Employee Name is Required'])->withErrors(['name' => 'Employee Name Required']);
            }
            if ($validator->errors()->has('email')){
                return redirect()->back()->with(['notify_error' => 'Email Address is Required'])->withErrors(['email' => 'Email Address is Required']);
            }
            if ($validator->errors()->has('employee_id')){
                return redirect()->back()->with(['notify_error' => 'Employee ID is Required'])->withErrors(['password' => 'Employee ID is Required']);
            }
        }
        $validated = $validator->validated();
        try {
            $employee = Employee::where('email', '=', $validated['email'])->where('employee_id', '=', $validated['employee_id'])->first();
            if ($employee == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify employee account']);
            }
            $employee->name = $validated['name'];
            $employee->email = $validated['email'];
            if (isset($request->password)){
                $employee->password = Hash::make($request->password);
            }
            $employee->mobile = isset($request->mobile)?$request->mobile:null;
            $employee->status = 0;
            //insert permissions
            $permission_list = ['dashboard'];
            //category permissions
            isset($request->view_category)?array_push($permission_list,'view-category'):'';
            isset($request->add_category)?array_push($permission_list,'add-category'):'';
            isset($request->edit_category)?array_push($permission_list,'edit-category'):'';
            isset($request->delete_category)?array_push($permission_list,'delete-category'):'';
            isset($request->approve_category)?array_push($permission_list,'approve-category'):'';
            (isset($request->add_category) || isset($request->edit_category) || isset($request->delete_category) || isset($request->approve_category))?(!in_array('view-category', $permission_list))?array_push($permission_list,'view-category'):'':'';

            //product permissions
            isset($request->view_product)?array_push($permission_list,'view-product'):'';
            isset($request->add_product)?array_push($permission_list,'add-product'):'';
            isset($request->edit_product)?array_push($permission_list,'edit-product'):'';
            isset($request->delete_product)?array_push($permission_list,'delete-product'):'';
            isset($request->approve_product)?array_push($permission_list,'approve-product'):'';
            (isset($request->add_product) || isset($request->edit_product) || isset($request->delete_product) || isset($request->approve_product))?(!in_array('view-product', $permission_list))?array_push($permission_list,'view-product'):'':'';

            //sell permissions
            isset($request->view_sell)?array_push($permission_list,'view-sell'):'';
            isset($request->add_sell)?array_push($permission_list,'add-sell'):'';
            isset($request->edit_sell)?array_push($permission_list,'edit-sell'):'';
            isset($request->delete_sell)?array_push($permission_list,'delete-sell'):'';
            (isset($request->add_sell) || isset($request->edit_sell) || isset($request->delete_sell))?(!in_array('view-sell', $permission_list))?array_push($permission_list,'view-sell'):'':'';

            //order permissions
            isset($request->view_order)?array_push($permission_list,'view-order'):'';
            isset($request->add_order)?array_push($permission_list,'add-order'):'';
            isset($request->edit_order)?array_push($permission_list,'edit-order'):'';
            isset($request->delete_order)?array_push($permission_list,'delete-order'):'';
            isset($request->manage_order)?array_push($permission_list,'manage-order'):'';
            (isset($request->add_order) || isset($request->edit_order) || isset($request->delete_order) || isset($request->manage_order))?(!in_array('view-order', $permission_list))?array_push($permission_list,'view-order'):'':'';

            //customer permissions
            isset($request->view_customer)?array_push($permission_list,'view-customer'):'';
            isset($request->add_customer)?array_push($permission_list,'add-customer'):'';
            isset($request->edit_customer)?array_push($permission_list,'edit-customer'):'';
            isset($request->delete_customer)?array_push($permission_list,'delete-customer'):'';
            (isset($request->add_customer) || isset($request->edit_customer) || isset($request->delete_customer))?(!in_array('view-customer', $permission_list))?array_push($permission_list,'view-customer'):'':'';

            //employee permissions
            isset($request->view_employee)?array_push($permission_list,'view-employee'):'';
            isset($request->add_employee)?array_push($permission_list,'add-employee'):'';
            isset($request->edit_employee)?array_push($permission_list,'edit-employee'):'';
            isset($request->delete_employee)?array_push($permission_list,'delete-employee'):'';
            isset($request->approve_employee)?array_push($permission_list,'approve-employee'):'';
            (isset($request->add_employee) || isset($request->edit_employee) || isset($request->delete_employee) || isset($request->approve_employee))?(!in_array('view-employee', $permission_list))?array_push($permission_list,'view-employee'):'':'';

            //cart permissions
            isset($request->view_cart)?array_push($permission_list,'view-cart'):'';
            isset($request->add_cart)?array_push($permission_list,'add-cart'):'';
            isset($request->edit_cart)?array_push($permission_list,'edit-cart'):'';
            isset($request->delete_cart)?array_push($permission_list,'delete-cart'):'';
            (isset($request->add_cart) || isset($request->edit_cart) || isset($request->delete_cart))?(!in_array('view-cart', $permission_list))?array_push($permission_list,'view-cart'):'':'';

            //website permissions
            isset($request->site_setting)?array_push($permission_list,'site-setting'):'';
            //end insert permissions
            $employee->permissions = json_encode($permission_list);
            $employee->save();
            return redirect()->back()->with(['success' => 'Employee Edited Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function ProfileUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'profile' => 'required',
        ]);
        if ($validator->fails()) {
            if ($validator->errors()->has('profile')) {
                return redirect()->back()->with(['notify_error' => 'Please Select image']);
            }
        }
        $validated = $validator->validated();
        try {
            $employee = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
            if ($employee == null) {
                return redirect()->back()->with(['notify_error' => 'Can not identify your account']);
            }
            if($request->hasfile('profile')){
                $name = time().rand(1,50).'.'.$validated['profile']->extension();
                if( !file_exists(public_path('employee_profile'))){
                    mkdir(public_path('employee_profile'), 0777);
                }if( !file_exists(public_path('employee_profile/'.$employee->employee_id))){
                    mkdir(public_path('employee_profile/'.$employee->employee_id), 0777);
                }
                $validated['profile']->move(public_path('employee_profile/'.$employee->employee_id), $name);
                $employee->profile = json_encode($name);
            }
            $employee->save();
            return redirect()->back()->with(['success' => 'Profile image changed Successfully']);
        } catch (Exception $exception) {
            return redirect()->back()->with(['error' => 'Something Went Wrong' . $exception->getMessage()]);
        }
    }

    public function accountUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            if ($validator->errors()->has('name')) {
                return redirect()->back()->with(['notify_error' => 'Employee Name is Required'])->withErrors(['name' => 'Employee Name Required']);
            }
        }
        $validated = $validator->validated();
        try {
            $employee = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
            if ($employee == null) {
                return redirect()->back()->with(['notify_error' => 'Can not identify your account']);
            }
            $employee->name = $validated['name'];
            if (isset($request->password)) {
                $employee->password = Hash::make($request->password);
            }
            $employee->mobile = isset($request->mobile) ? $request->mobile : null;
            $employee->save();
            return redirect()->back()->with(['success' => 'Account Updated Successfully']);
        } catch (Exception $exception) {
            return redirect()->back()->with(['error' => 'Something Went Wrong' . $exception->getMessage()]);
        }
    }
}
