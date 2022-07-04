<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Employee;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function delete(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'delete-cart', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to delete cart']);
        }
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('user_id')){
                return redirect()->back()->with(['notify_error' => 'Customer ID is Required to delete cart']);
            }
        }
        $validated = $validator->validated();
        try {
            $cart = Cart::where('user_id', '=', $validated['user_id'])->first();
            if ($cart == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify cart']);
            }
            $cart->delete();
            return redirect()->back()->with(['success' => 'Cart Deleted Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function editView(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'edit-cart', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to edit cart']);
        }
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('user_id')){
                return redirect()->back()->with(['notify_error' => 'Customer ID is Required to edit cart']);
            }
        }
        $validated = $validator->validated();
        try{
            $full_cart = [];
            $cart = Cart::select('cart')
                ->where('user_id', '=', $validated['user_id'])
                ->first();
            if ($cart == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify cart']);
            }else{
                $total = 0;
                $main_images = [];
                foreach(json_decode($cart->cart) as $cart_item){
                    $item = Product::select('product_id', 'unit_price', 'name','main_image')
                        ->where('product_id', '=', $cart_item->product_id)
                        ->first();
                    $item['user_quantity'] = $cart_item->quantity;
                    $total+=$item['unit_price']*$item['user_quantity'];
                    array_push($full_cart,$item);
                    $product_temp = [];
                    $product_temp['product_id'] = $item['product_id'];
                    $product_temp['image'] = $item['main_image'];
                    array_push($main_images,$product_temp);
                }
                $user = User::where('user_id', '=', $validated['user_id'])->first();
                return view('dashboard', ['state' => 'edit-cart', 'permissions' => $permissions, 'cart' => $full_cart, 'user' => $user,'total' => $total,'main_images' => $main_images]);
            }
        }catch (Exception $exception){

        }
    }

    public function removeItemCart(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'edit-cart', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to edit cart']);
        }
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'product_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('user_id')){
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['notify_error' => 'Customer ID is Required to edit cart']);
            }
            if ($validator->errors()->has('product_id')){
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['notify_error' => 'Product ID is Required to edit cart']);
            }
        }
        $validated = $validator->validated();
        try {
            $old_cart = Cart::where('user_id', '=', $validated['user_id'])->first();
            if($old_cart == null){
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['error' => 'Can not update empty card']);
            }else{
                $old_cart_list = json_decode($old_cart->cart);
//                dd($old_cart_list);
                $index = 0;
                $cart_remove = false;
                foreach ($old_cart_list as $old_cart_product){
                    if ($old_cart_product->product_id == $validated['product_id']){
                        // $old_cart_product->quantity =$validated['quantity'];
                        unset($old_cart_list[$index]);
                        if (count($old_cart_list) == 0){
                            Cart::where('user_id', '=', $validated['user_id'])->delete();
                            $cart_remove = true;
                        }
                        break;
                    }
                    $index++;
                }
                if (!$cart_remove){
                    $old_cart->cart = $old_cart_list;
                    $old_cart->save();
                }
                $product_name = Product::select('name')
                    ->where('product_id', '=', $validated['product_id'])
                    ->first();
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['success' => $product_name->name.' removed from cart successfully...!' ]);
            }
        }catch (Exception $exception){
            return redirect()->route('dashboard', ['state' => 'cart'])->with(['notify_error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function updateItemCart(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'edit-cart', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to edit cart']);
        }
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('user_id')){
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['notify_error' => 'Customer ID is Required to edit cart']);
            }
            if ($validator->errors()->has('product_id')){
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['notify_error' => 'Product ID is Required to edit cart']);
            }
            if ($validator->errors()->has('quantity')){
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['notify_error' => 'Product quantity is Required to edit cart']);
            }
        }
        $validated = $validator->validated();
        try {
            $product_quantity = Product::select('quantity')->where('product_id', '=', $validated['product_id'])->first();
            if ($product_quantity->quantity < $validated['quantity']){
                return redirect()->back()->with(['notify_error' => 'No Stock available, only available '. $product_quantity->quantity .' products.']);
            }
            $old_cart = Cart::where('user_id', '=', $validated['user_id'])->first();
            if($old_cart == null){
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['error' => 'Can not update empty card']);
            }else{
                $old_cart_list = json_decode($old_cart->cart);
                foreach ($old_cart_list as $old_cart_product){
                    if ($old_cart_product->product_id == $validated['product_id']){
                        $old_cart_product->quantity =$validated['quantity'];
                    }
                }
                $old_cart->cart = $old_cart_list;
                $old_cart->save();
                $product_name = Product::select('name')
                    ->where('product_id', '=', $validated['product_id'])
                    ->first();
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['success' => $validated['quantity'].' '.$product_name->name.' added to cart successfully...!' ]);
            }
        }catch (Exception $exception){
            return redirect()->route('dashboard', ['state' => 'cart'])->with(['notify_error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function addToCart(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'add-cart', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to add cart']);
        }
        $validator = Validator::make($request->all(),[
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('user_id')){
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['notify_error' => 'Customer ID is Required to add cart']);
            }
            if ($validator->errors()->has('product_id')){
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['notify_error' => 'Product ID is Required to add cart']);
            }
            if ($validator->errors()->has('quantity')){
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['notify_error' => 'Product quantity is Required to add cart']);
            }
        }
        $validated = $validator->validated();
        try {
            $product_quantity = Product::select('quantity')->where('product_id', '=', $validated['product_id'])->first();
            if ($product_quantity->quantity < $validated['quantity']){
                return redirect()->back()->with(['notify_error' => 'No Stock available, only available '. $product_quantity->quantity .' products.']);
            }
            $old_cart = Cart::where('user_id', '=', $validated['user_id'])->first();
            if($old_cart == null){
                $new_cart = new Cart();
                $new_cart->user_id = $validated['user_id'];
                $product = [
                    'product_id' => $validated['product_id'],
                    'quantity' => $validated['quantity'],
                ];
                $new_cart->cart = json_encode(array($product));
                $new_cart->save();
                $product_name = Product::select('name')
                    ->where('product_id', '=', $validated['product_id'])
                    ->first();
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['success' => $validated['quantity'].' '.$product_name->name.' added to cart successfully...!' ]);
            }else{
                $old_cart_list = json_decode($old_cart->cart);
                $exist = false;
                foreach ($old_cart_list as $old_cart_product){
                    if ($old_cart_product->product_id == $validated['product_id']){
                        $old_cart_product->quantity+=$validated['quantity'];
                        $exist = true;
                    }
                }
                if(!$exist){
                    $product = [
                        'product_id' => $validated['product_id'],
                        'quantity' => $validated['quantity'],
                    ];
                    array_push($old_cart_list, json_decode(json_encode($product)));
                }
                $old_cart->cart = $old_cart_list;
                $old_cart->save();
                $product_name = Product::select('name')
                    ->where('product_id', '=', $validated['product_id'])
                    ->first();
                return redirect()->route('dashboard', ['state' => 'cart'])->with(['success' => $validated['quantity'].' '.$product_name->name.' added to cart successfully...!' ]);
            }
        }catch (Exception $exception){
            return redirect()->route('dashboard', ['state' => 'cart'])->with(['notify_error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }
}
