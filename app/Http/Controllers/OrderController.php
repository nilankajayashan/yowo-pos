<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function add(Request $request){
        $validator = validator::make($request->all(),[
            'user_id' => 'required',
            'shipping_name' => 'required',
            'shipping_email' => 'required',
            'shipping_mobile' => 'required',
            'shipping_country' => 'required',
            'shipping_district' => 'required',
            'shipping_city' => 'required',
            'shipping_address1' => 'required',
            'shipping_postal_code' => 'required',
            'shipping_method' => 'required',
            'payment_method' => 'required',
        ]);
        if ($validator->fails()){
            if($validator->errors()->has('shipping_name')){
                return redirect()->back()->withErrors(['shipping_name' => 'Please enter order receiver\'s name (ex: John Doe)'])->with(['notify_error' => 'Please enter order receiver\'s name (ex: John Doe)']);
            }elseif($validator->errors()->has('shipping_email')){
                return redirect()->back()->withErrors(['shipping_email' => 'Please enter order receiver\'s email address (ex: example@gmail.com)'])->with(['notify_error' => 'Please enter order receiver\'s email address (ex: example@gmail.com)']);
            }elseif($validator->errors()->has('shipping_mobile')){
                return redirect()->back()->withErrors(['shipping_mobile' => 'Please enter order receiver\'s contact number (ex: +94123456789)'])->with(['notify_error' => 'Please enter order receiver\'s contact number (ex: +94123456789)']);
            }elseif($validator->errors()->has('shipping_country')){
                return redirect()->back()->withErrors(['shipping_country' => 'Please select order receiver\'s country'])->with(['notify_error' => 'Please select order receiver\'s country']);
            }elseif($validator->errors()->has('shipping_address1')){
                return redirect()->back()->withErrors(['shipping_address1' => 'Please Enter order receiver\'s address (ex: 127/1 , sample road)'])->with(['notify_error' => 'Please Enter order receiver\'s address (ex: 127/1 , sample road)']);
            }elseif($validator->errors()->has('shipping_district')){
                return redirect()->back()->withErrors(['shipping_district' => 'Please select order receiver\'s district'])->with(['notify_error' => 'Please select order receiver\'s district']);
            }elseif($validator->errors()->has('shipping_city')){
                return redirect()->back()->withErrors(['shipping_city' => 'Please select order receiver\'s city'])->with(['notify_error' => 'Please select order receiver\'s city']);
            }

        }
        $validated = $validator->validated();
        if ($request->payment_same == 'on'){
            $validator = validator::make($request->all(),[
                'payment_name' => 'required',
                'payment_email' => 'required',
                'payment_mobile' => 'required',
                'payment_country' => 'required',
                'payment_city' => 'required',
                'payment_address' => 'required'
            ]);
            if ($validator->fails()){
                if($validator->errors()->has('payment_name')){
                    return redirect()->back()->withErrors(['payment_name' => 'Please enter order sender\'s name (ex: John Doe)'])->with(['notify_error' => 'Please enter order sender\'s name (ex: John Doe)']);
                }elseif($validator->errors()->has('payment_email')){
                    return redirect()->back()->withErrors(['payment_email' => 'Please enter order sender\'s name (ex: example@gmail.com)'])->with(['notify_error' => 'Please enter order sender\'s name (ex: example@gmail.com)']);
                }elseif($validator->errors()->has('payment_mobile')){
                    return redirect()->back()->withErrors(['payment_mobile' => 'Please enter order sender\'s contact number (ex: +94123456789)'])->with(['notify_error' => 'Please enter order sender\'s contact number (ex: +94123456789)']);
                }elseif($validator->errors()->has('payment_country')){
                    return redirect()->back()->withErrors(['payment_country' => 'Please select order sender\'s country'])->with(['notify_error' => 'Please select order sender\'s country']);
                }elseif($validator->errors()->has('payment_city')){
                    return redirect()->back()->withErrors(['payment_city' => 'Please enter order sender\'s city'])->with(['notify_error' => 'Please enter order sender\'s city']);
                }elseif($validator->errors()->has('payment_address')){
                    return redirect()->back()->withErrors(['payment_address' => 'Please enter order sender\'s address (ex: 127/1 , sample road)'])->with(['notify_error' => 'Please enter order sender\'s address (ex: 127/1 , sample road)']);
                }
            }
            $validated += $validator->validated();
        }
        $order = new Order();
        $order->shipping_method = $validated['shipping_method'];
        $order->shipping_name = $validated['shipping_name'];
        $order->shipping_email = $validated['shipping_email'];
        $order->shipping_mobile = $validated['shipping_mobile'];
        $order->shipping_country = $validated['shipping_country'];
        $order->shipping_district = $validated['shipping_district'];
        $order->shipping_city = $validated['shipping_city'];
        $order->shipping_postal_code = $validated['shipping_postal_code'];
        $order->shipping_address1 = $validated['shipping_address1'];
        $order->shipping_address2 = $request->shipping_address2;
        //shipping price
        if ($validated['shipping_method'] == '24_7_shipping'){
            $shipping_details = ShippingDetails::select('price')
                ->where('country', '=', strtolower($validated['country']))
                ->where('district', '=', strtolower($validated['district']))
                ->where('city', '=', strtolower($validated['city']))
                ->where('postal_code', '=', strtolower($validated['postal_code']))
                ->first();
            if($shipping_details == null){
                return redirect()->back()->with([['notify_error' => 'Can not find shipping details']]);
            }else{
                $order->shipping_price = $shipping_details->price;
            }
        }elseif($validated['shipping_method'] == 'free_shipping'){
            $order->shipping_price = 0;
        }
        //add shipping note
        if ($request->shipping_note != null){
            $order->shipping_note = $request->shipping_note;
        }
        $order->payment_method = $validated['payment_method'];
        if ($request->payment_same == 'on'){
            $order->payment_name = $validated['payment_name'];
            $order->payment_email = $validated['payment_email'];
            $order->payment_mobile = $validated['payment_mobile'];
            $order->payment_country = $validated['payment_country'];
            $order->payment_city = $validated['payment_city'];
            $order->payment_address = $validated['payment_address'];
        }else{
            $order->payment_name = $validated['shipping_name'];
            $order->payment_email = $validated['shipping_email'];
            $order->payment_mobile = $validated['shipping_mobile'];
            $order->payment_country = $validated['shipping_country'];
            $order->payment_city = $validated['shipping_city'];
            $order->payment_address = $validated['shipping_address1'];
        }

        //add cart
        $cart = Cart::select('cart')->where('user_id', '=', $validated['user_id'])->first();
        $total = 0;
        if ($cart != null){
            $index = 0;
            $product = [];
            foreach(json_decode($cart->cart) as $cart_item){
                $item = Product::where('product_id', '=', $cart_item->product_id)
                    ->first();
                if ($item->quantity >= $cart_item->quantity) {

                    $total += $item->unit_price * $cart_item->quantity;

                    $cart_item->unit_price = $item->unit_price;
                    $cart_item->name = $item->name;
                    $product[$index] = $cart_item;
                    $index++;
                    $item->quantity -= $cart_item->quantity;
                    $item->save();
                }
            }
            $order->total = $total;
            $order->cart = json_encode($product);
        }else{
            return redirect()->back()->with(['notify_error' => 'Can not find cart details']);
        }

        //add and get payment
        if ( $validated['payment_method'] == 'cod'){
            $order->payment_status = 'pending';
            $order->order_status = 'pending';
        }elseif ($validated['payment_method'] == 'payhere'){
            $order->payment_status = $this->payhereGateway($cart->total);
            $order->order_status = 'pending';
        }
        $order->user_id = $validated['user_id'];
        Cart::where('user_id', '=', $validated['user_id'])->delete();


        $order->save();
        return redirect()->back()->with(['success' => 'Order placed successfully...!']);
    }

    public function payhereGateway($total){
        return 'success';
    }

    public function delete(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'delete-order', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to delete order']);
        }
        $validator = Validator::make($request->all(),[
            'order_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('order_id')){
                return redirect()->back()->with(['notify_error' => 'Order ID is Required to delete order']);
            }
        }
        $validated = $validator->validated();
        try {
            $order = Order::where('id', '=', $validated['order_id'])->first();
            if ($order == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify order']);
            }
            $order->delete();
            return redirect()->back()->with(['success' => 'Order Deleted Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function edit(Request $request){
        $validator = validator::make($request->all(),[
            'order_id' => 'required',
            'shipping_name' => 'required',
            'shipping_email' => 'required',
            'shipping_mobile' => 'required',
            'shipping_country' => 'required',
            'shipping_district' => 'required',
            'shipping_city' => 'required',
            'shipping_address1' => 'required',
            'shipping_postal_code' => 'required',
            'shipping_method' => 'required',
            'payment_method' => 'required',
        ]);
        if ($validator->fails()){
            if($validator->errors()->has('shipping_name')){
                return redirect()->back()->withErrors(['shipping_name' => 'Please enter order receiver\'s name (ex: John Doe)'])->with(['notify_error' => 'Please enter order receiver\'s name (ex: John Doe)']);
            }elseif($validator->errors()->has('shipping_email')){
                return redirect()->back()->withErrors(['shipping_email' => 'Please enter order receiver\'s email address (ex: example@gmail.com)'])->with(['notify_error' => 'Please enter order receiver\'s email address (ex: example@gmail.com)']);
            }elseif($validator->errors()->has('shipping_mobile')){
                return redirect()->back()->withErrors(['shipping_mobile' => 'Please enter order receiver\'s contact number (ex: +94123456789)'])->with(['notify_error' => 'Please enter order receiver\'s contact number (ex: +94123456789)']);
            }elseif($validator->errors()->has('shipping_country')){
                return redirect()->back()->withErrors(['shipping_country' => 'Please select order receiver\'s country'])->with(['notify_error' => 'Please select order receiver\'s country']);
            }elseif($validator->errors()->has('shipping_address1')){
                return redirect()->back()->withErrors(['shipping_address1' => 'Please Enter order receiver\'s address (ex: 127/1 , sample road)'])->with(['notify_error' => 'Please Enter order receiver\'s address (ex: 127/1 , sample road)']);
            }elseif($validator->errors()->has('shipping_district')){
                return redirect()->back()->withErrors(['shipping_district' => 'Please select order receiver\'s district'])->with(['notify_error' => 'Please select order receiver\'s district']);
            }elseif($validator->errors()->has('shipping_city')){
                return redirect()->back()->withErrors(['shipping_city' => 'Please select order receiver\'s city'])->with(['notify_error' => 'Please select order receiver\'s city']);
            }elseif($validator->errors()->has('order_id')){
                return redirect()->back()->withErrors(['shipping_city' => 'Can not identify order'])->with(['notify_error' => 'Can not identify order']);
            }

        }
        $validated = $validator->validated();
        if ($request->payment_same == 'on'){
            $validator = validator::make($request->all(),[
                'payment_name' => 'required',
                'payment_email' => 'required',
                'payment_mobile' => 'required',
                'payment_country' => 'required',
                'payment_city' => 'required',
                'payment_address' => 'required'
            ]);
            if ($validator->fails()){
                if($validator->errors()->has('payment_name')){
                    return redirect()->back()->withErrors(['payment_name' => 'Please enter order sender\'s name (ex: John Doe)'])->with(['notify_error' => 'Please enter order sender\'s name (ex: John Doe)']);
                }elseif($validator->errors()->has('payment_email')){
                    return redirect()->back()->withErrors(['payment_email' => 'Please enter order sender\'s name (ex: example@gmail.com)'])->with(['notify_error' => 'Please enter order sender\'s name (ex: example@gmail.com)']);
                }elseif($validator->errors()->has('payment_mobile')){
                    return redirect()->back()->withErrors(['payment_mobile' => 'Please enter order sender\'s contact number (ex: +94123456789)'])->with(['notify_error' => 'Please enter order sender\'s contact number (ex: +94123456789)']);
                }elseif($validator->errors()->has('payment_country')){
                    return redirect()->back()->withErrors(['payment_country' => 'Please select order sender\'s country'])->with(['notify_error' => 'Please select order sender\'s country']);
                }elseif($validator->errors()->has('payment_city')){
                    return redirect()->back()->withErrors(['payment_city' => 'Please enter order sender\'s city'])->with(['notify_error' => 'Please enter order sender\'s city']);
                }elseif($validator->errors()->has('payment_address')){
                    return redirect()->back()->withErrors(['payment_address' => 'Please enter order sender\'s address (ex: 127/1 , sample road)'])->with(['notify_error' => 'Please enter order sender\'s address (ex: 127/1 , sample road)']);
                }
            }
            $validated += $validator->validated();
        }
        try{
            $order = Order::where('id', '=', $validated['order_id'])->first();
            if ($order == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify order']);
            }
            $order->shipping_method = $validated['shipping_method'];
            $order->shipping_name = $validated['shipping_name'];
            $order->shipping_email = $validated['shipping_email'];
            $order->shipping_mobile = $validated['shipping_mobile'];
            $order->shipping_country = $validated['shipping_country'];
            $order->shipping_district = $validated['shipping_district'];
            $order->shipping_city = $validated['shipping_city'];
            $order->shipping_postal_code = $validated['shipping_postal_code'];
            $order->shipping_address1 = $validated['shipping_address1'];
            $order->shipping_address2 = $request->shipping_address2;
            //shipping price
            if ($validated['shipping_method'] == '24_7_shipping'){
                $shipping_details = ShippingDetails::select('price')
                    ->where('country', '=', strtolower($validated['shipping_country']))
                    ->where('district', '=', strtolower($validated['shipping_district']))
                    ->where('city', '=', strtolower($validated['shipping_city']))
                    ->where('postal_code', '=', strtolower($validated['shipping_postal_code']))
                    ->first();
                if($shipping_details == null){
                    return redirect()->back()->with([['notify_error' => 'Can not find shipping details']]);
                }else{
                    $order->shipping_price = $shipping_details->price;
                }
            }elseif($validated['shipping_method'] == 'free_shipping'){
                $order->shipping_price = 0;
            }
            //add shipping note
            if ($request->shipping_note != null){
                $order->shipping_note = $request->shipping_note;
            }
            $order->payment_method = $validated['payment_method'];
            if ($request->payment_same == 'on'){
                $order->payment_name = $validated['payment_name'];
                $order->payment_email = $validated['payment_email'];
                $order->payment_mobile = $validated['payment_mobile'];
                $order->payment_country = $validated['payment_country'];
                $order->payment_city = $validated['payment_city'];
                $order->payment_address = $validated['payment_address'];
            }else{
                $order->payment_name = $validated['shipping_name'];
                $order->payment_email = $validated['shipping_email'];
                $order->payment_mobile = $validated['shipping_mobile'];
                $order->payment_country = $validated['shipping_country'];
                $order->payment_city = $validated['shipping_city'];
                $order->payment_address = $validated['shipping_address1'];
            }
            $order->save();
            return redirect()->back()->with(['success' => 'Order edited successfully...!']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something went wrong...!'.$exception->getMessage()]);
        }
    }

    public function manage(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'manage-order', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to manage order']);
        }
        $validator = Validator::make($request->all(),[
            'order_id' => 'required',
            'order_status' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('order_id')){
                return redirect()->back()->with(['notify_error' => 'Order ID is Required to manage order']);
            }
            if ($validator->errors()->has('order_status')){
                return redirect()->back()->with(['notify_error' => 'Order status is Required to manage order']);
            }
        }
        $validated = $validator->validated();
        try {
            $order = Order::where('id', '=', $validated['order_id'])->first();
            if ($order == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify order']);
            }
            $statuses = ['pending','processing','processed','shipped','completed','failed'];
            if(in_array($validated['order_status'], $statuses)){
                $order->order_status = $validated['order_status'];
            }else{
                $order->order_status = 'pending';
            }
            $order->save();
            return redirect()->back()->with(['success' => 'Order status updated Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }
}
