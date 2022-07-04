<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function loginView(){
        $employees = Employee::all();
        if(count($employees) <= 0){
            return view('login',['no_employees' => true]);
        }
        return view('login');
    }

    public function loginSubmit(Request $request){
        $validator =  Validator::make($request->all(),[
            'email' => 'required|email|max:255',
            'password' => 'required|max:32|min:8',
        ]);
        if ($validator->fails()){
            if($validator->errors()->has('email')){
                return redirect()->route('login')->withErrors( ['email' => 'Please Check you entered Email again']);
            }elseif($validator->errors()->has('password')){
                return redirect()->route('login')->withErrors( ['password' => 'Please Check you entered password again']);
            }
        }
        $validated = $validator->validated();
        try{
            $employee = Employee::where('email','=', $validated['email'])->first();
            if($employee != null){
                if( Hash::check($validated['password'], $employee->password)){
                    if (lcfirst($employee->status) == 1) {
                        if ($employee->approved_by != null){
                            if ($request->remember == 'on'){
                                setcookie('email', $validated['email'], time() + (86400 * 30), "/");
                                setcookie('password', $validated['password'], time() + (86400 * 30), "/");
                            }
                            session()->put('auth_employee', $employee);
                            return redirect()->route('dashboard', ['state' => 'dashboard']);
                        }else{
                            return redirect()->back()->with(['notify_error' => 'Your Account Not Approved yet..! Please wait to approve']);
                        }
                    }else{
                        return redirect()->back()->with(['notify_error' => 'Your Account not ACTIVATED...!' ]);
                    }
                }else{
                    return redirect()->route('login')->withErrors(['password' => 'Dear '. $validated['email'] .', you entered password is wrong']);
                }
            }else{
                return redirect()->route('login')->withErrors(['email' => 'You entered email address not registered']);
            }
        }catch (Exception $e){
            return redirect()->back()->with(['notify_error', $e->getMessage()]);
        }
    }

    public function logout(){
        if (session()->has('auth_employee')){
            $name = session()->get('auth_employee')->name;
            session()->forget(['auth_employee']);
            session()->flash('auth_employee');
            return redirect()->route('login')
                ->with([
                    'success' => 'Dear '.$name.', You are logged out successfully...! Welcome back again...'
                ]);
        }
    }
}
