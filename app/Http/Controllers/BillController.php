<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Employee;
use App\Models\bill;
use App\Models\Product;
use App\Models\Sell;
use App\Models\ShippingDetails;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    public function makeBill(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'add-sell', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to make bill']);
        }

//        dd($request->payment_same);
        $bill = new Sell();
        $bill->user_id = isset($request->user_id)?$request->user_id:null;
        $bill->employee_id = session()->get('auth_employee')->employee_id;

        $total = 0;
        if ($_COOKIE['bill'] != null){
            $index = 0;
            $product = [];
            foreach(json_decode($_COOKIE['bill'] ) as $bill_item){
                $item = Product::select('quantity')
                    ->where('product_id', '=', $bill_item->product_id)
                    ->first();
                if ($item->quantity < $bill_item->quantity){
                    return redirect()->back()->with(['notify_error' => 'No Stock available, only available '. $item->quantity .' products.']);
                }
            }
            foreach(json_decode($_COOKIE['bill'] ) as $bill_item){
                $item = Product::where('product_id', '=', $bill_item->product_id)
                    ->first();
                    if ($item->quantity >= $bill_item->quantity){
                    $total+=$item->unit_price * $bill_item->quantity;

                    $bill_item->unit_price = $item->unit_price;
                    $bill_item->name = $item->name;
                    $product[$index]=$bill_item;
                    $index++;
                    $item->quantity -= $bill_item->quantity;
                    $item->save();
                }
            }
            $bill->total = $total;
            $bill->bill = json_encode($product);
        }else{
            return redirect()->back()->with(['notify_error' => 'Can not find bill details']);
        }
        $bill->save();
        setcookie('bill', '', time() + (86400 * 30), "/");
        $user = User::where('user_id', '=', $bill->user_id)->first();
        $pdf = PDF::loadView('pdf/bill-download', ['bill' => $bill, 'user' => $user]);
        return $pdf->download('Bill-'.$bill->bill_id.'.pdf');
        return redirect()->back()->with(['success' => 'New Bill make successfully...!']);
    }

    public function  deleteBill(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'delete-sell', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to delete bill']);
        }
        $validator = Validator::make($request->all(),[
            'bill_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('bill_id')){
                return redirect()->back()->with(['notify_error' => 'Not available this quantity']);
            }
        }
        $validated = $validator->validated();
        try {
            $bill = Sell::where('bill_id', '=',$validated['bill_id'] )->first();
            if ($bill == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify customer']);
            }
            $bill->delete();
            return redirect()->back()->with(['success' => 'Bill Deleted Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }
}
