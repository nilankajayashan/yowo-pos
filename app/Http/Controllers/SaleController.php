<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Employee;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    public function addToBill(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'add-sell', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to add sell']);
        }

        $validator = Validator::make($request->all(),[
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('product_id')){
                return redirect()->route('dashboard', ['state' => 'add_bill'])->with(['notify_error' => 'Product ID is Required to add bill']);
            }
            if ($validator->errors()->has('quantity')){
                return redirect()->route('dashboard', ['state' => 'add_bill'])->with(['notify_error' => 'Product quantity is Required to add bill']);
            }
        }
        $validated = $validator->validated();
        $validated['product_id'] = explode('|',$request->product_id)[0];

        $product_quantity = Product::select('quantity')->where('product_id', '=', $validated['product_id'])->first();
        if ($product_quantity->quantity < $validated['quantity']){
            return redirect()->back()->with(['notify_error' => 'No Stock available, only available '. $product_quantity->quantity .' products.']);
        }
        if(!isset($_COOKIE['bill'])){
            $product = [
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity'],
            ];
            setcookie('bill', json_encode(array($product)), time() + (86400 * 30), "/");
            return redirect()->back();
        }else{
            $old_bill_list = json_decode($_COOKIE['bill']);
            $exist = false;
            foreach ($old_bill_list as $old_bill_product){
                if ($old_bill_product->product_id == $validated['product_id']){
                    if ($product_quantity->quantity < $old_bill_product->quantity + $validated['quantity']){
                        return redirect()->back()->with(['notify_error' => 'No Stock available, only available '. $product_quantity->quantity .' products. You can add '.$product_quantity->quantity-$old_bill_product->quantity. ' products']);
                    }
                    $old_bill_product->quantity+=$validated['quantity'];
                    $exist = true;
                    // array_push($updated_cart, $old_cart_product);
                }
            }
            if(!$exist){
                $product = [
                    'product_id' => $validated['product_id'],
                    'quantity' => $validated['quantity'],
                ];
                array_push($old_bill_list, json_decode(json_encode($product)));
            }
            setcookie('bill', json_encode($old_bill_list), time() + (86400 * 30), "/");
            return redirect()->back();
        }
    }

    public function removeFromBill(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'edit-sell', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to edit sell']);
        }
        $validator = Validator::make($request->all(),[
            'product_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('product_id')){
                return redirect()->route('dashboard', ['state' => 'add_bill'])->with(['notify_error' => 'Product ID is Required to delete bill']);
            }
        }
        $validated = $validator->validated();
        if(!isset($_COOKIE['bill'])){
            return redirect()->back()->with(['error' => 'Can not update empty bill']);
        }else{
            $old_bill_list = json_decode($_COOKIE['bill']);
            $index = 0;
            $bill_remove = false;
            foreach ($old_bill_list as $old_bill_product){
                if ($old_bill_product->product_id == $validated['product_id']){
                    unset($old_bill_list[$index]);
                    if (count($old_bill_list) == 0){
                        setcookie('bill', "", time()-1, "/");
                        $cart_remove = true;
                    }
                    break;
                }
                $index++;
            }
            if (!$bill_remove) {
                setcookie('bill', json_encode($old_bill_list), time() + (86400 * 30), "/");
            }
            $product_name = Product::select('name')
                ->where('product_id', '=', $validated['product_id'])
                ->first();
            return redirect()->back()->with(['notify_danger' => 'Dear Employee, '.$product_name->name.' removed from new bill successfully...!' ]);
        }
    }

    public function updateBill(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'edit-sell', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to edit sell']);
        }
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        if($validator->fails()){
            if($validator->errors()->has('product_id')){
                return redirect()->back()->withErrors(['notify_error' => 'You can not update this product']);
            }elseif( $validator->errors()->has('quantity')){
                return redirect()->back()->withErrors(['notify_error' => 'You can not add this product quantity to this bill']);
            }
        }
        $validated = $validator->validated();
        $product_quantity = Product::select('quantity')->where('product_id', '=', $validated['product_id'])->first();
        if ($product_quantity->quantity < $validated['quantity']){
            return redirect()->back()->with(['notify_error' => 'No Stock available, only available '. $product_quantity->quantity .' products.']);
        }
        if(!isset($_COOKIE['bill'])){
            return redirect()->back()->with(['error' => 'Can not update empty bill']);
        }else{
            $old_bill_list = json_decode($_COOKIE['bill']);
            foreach ($old_bill_list as $old_bill_product){
                if ($old_bill_product->product_id == $validated['product_id']){
                    $old_bill_product->quantity = $validated['quantity'];
                }
            }
            setcookie('bill', json_encode($old_bill_list), time() + (86400 * 30), "/");
            $product_name = Product::select('name')
                ->where('product_id', '=', $validated['product_id'])
                ->first();
            return redirect()->back()->with(['notify_success' => $validated['quantity'].' '.$product_name->name.' added to this bill successfully...!' ]);
        }
    }

    public function clearBill(Request $request){
        setcookie('bill', '', time() + (86400 * 30), "/");
        return redirect()->back()->with(['notify_success' => 'Bill Cleared']);
    }
}
