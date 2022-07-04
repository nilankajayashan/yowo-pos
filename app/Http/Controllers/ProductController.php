<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function add(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'add-product', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to add product']);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'model' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'category' => 'required',
            'main_image' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('name')) {
                return redirect()->back()->with(['notify_error' => 'Product name is required'])->withErrors(['name' => 'Product name is required']);
            }
            if ($validator->errors()->has('description')){
                return redirect()->back()->with(['notify_error' => 'Product description is required'])->withErrors(['description' => 'Product description is required']);
            }
            if ($validator->errors()->has('model')){
                return redirect()->back()->with(['notify_error' => 'Product model is required'])->withErrors(['model' => 'Product model is required']);
            }
            if ($validator->errors()->has('quantity')){
                return redirect()->back()->with(['notify_error' => 'Product quantity is required'])->withErrors(['quantity' => 'Product quantity is required']);
            }
            if ($validator->errors()->has('unit_price')){
                return redirect()->back()->with(['notify_error' => 'Product unit price is required'])->withErrors(['unit_price' => 'Product unit price is required']);
            }
            if ($validator->errors()->has('category')){
                return redirect()->back()->with(['notify_error' => 'Product category is required'])->withErrors(['category' => 'Product category is required']);
            }
            if ($validator->errors()->has('main_image')){
                return redirect()->back()->with(['notify_error' => 'Product main image is required'])->withErrors(['main_image' => 'Product main image is required']);
            }
        }
        $validated = $validator->validated();
        try {
            $product = new Product();
            $product->name = $validated['name'];
            $product->description = $validated['description'];
            $product->model = $validated['model'];
            $product->quantity = $validated['quantity'];
            $product->unit_price = $validated['unit_price'];
            $product->categories = $validated['category'];
            $product->weight = isset($request->weight)?$request->weight:null;
            $dimentions = [];
            isset($request->length)?array_push($dimentions, $request->length):array_push($dimentions,0);
            isset($request->width)?array_push($dimentions, $request->width):array_push($dimentions,0);
            isset($request->height)?array_push($dimentions, $request->height):array_push($dimentions,0);
            $product->dimensions= json_encode($dimentions);
            $product->status = 0;
            $product->added_by = session()->get('auth_employee')->employee_id;
            $product->save();
            //images uploader
            $files = [];
            if($request->hasfile('additional_images'))
            {
                foreach($request->file('additional_images') as $file)
                {
                    $name = time().rand(1,50).'.'.$file->extension();
                    if( !file_exists(public_path('product_images'))){
                        mkdir(public_path('product_images'), 0777);
                    }if( !file_exists(public_path('product_images/'.$product->product_id))){
                        mkdir(public_path('product_images/'.$product->product_id), 0777);
                    }
                    $file->move(public_path('product_images/'.$product->product_id), $name);
                    $files[] = $name;
                }
            }
            $product->additional_images = json_encode($files);

            if($request->hasfile('main_image')){
                $name = time().rand(1,50).'.'.$request->main_image->extension();
                if( !file_exists(public_path('product_images'))){
                    mkdir(public_path('product_images'), 0777);
                }if( !file_exists(public_path('product_images/'.$product->product_id))){
                    mkdir(public_path('product_images/'.$product->product_id), 0777);
                }
                $request->main_image->move(public_path('product_images/'.$product->product_id), $name);
            }
            $product->main_image = json_encode($name);
            $product->save();
            return redirect()->back()->with(['success' => 'Product Added Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function changeStatus(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'approve-product', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to active/de-active product']);
        }

        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('product_id')){
                return redirect()->back()->with(['notify_error' => 'Product id required to Active/De-active Product']);
            }
            return redirect()->back()->with(['notify_error' => 'Something went wrong...!']);
        }
        $validated = $validator->validated();
        try{
            $product = Product::where('product_id', '=', $validated['product_id'])->first();
            if ($product == null){
                return redirect()->back()->with(['notify_error' => 'Not exist Product with this product id']);
            }
            if ($product->status == 1){
                $product->status = 0;
                $product->save();
                return redirect()->back()->with(['success' => 'Product Deactive Successfully']);
            }else{
                $product->status = 1;
                $product->save();
                return redirect()->back()->with(['success' => 'Product Active Successfully']);
            }
        }catch (Exception $exception){
            return redirect()->back()->with(['notify_error' => 'Something went wrong...!']);
        }
    }

    public function edit(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'edit-product', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to edit product']);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'model' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'category' => 'required',
            'product_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('name')) {
                return redirect()->back()->with(['notify_error' => 'Product name is required'])->withErrors(['name' => 'Product name is required']);
            }
            if ($validator->errors()->has('description')){
                return redirect()->back()->with(['notify_error' => 'Product description is required'])->withErrors(['description' => 'Product description is required']);
            }
            if ($validator->errors()->has('model')){
                return redirect()->back()->with(['notify_error' => 'Product model is required'])->withErrors(['model' => 'Product model is required']);
            }
            if ($validator->errors()->has('quantity')){
                return redirect()->back()->with(['notify_error' => 'Product quantity is required'])->withErrors(['quantity' => 'Product quantity is required']);
            }
            if ($validator->errors()->has('unit_price')){
                return redirect()->back()->with(['notify_error' => 'Product unit price is required'])->withErrors(['unit_price' => 'Product unit price is required']);
            }
            if ($validator->errors()->has('category')){
                return redirect()->back()->with(['notify_error' => 'Product category is required'])->withErrors(['category' => 'Product category is required']);
            }
            if ($validator->errors()->has('product_id')){
                return redirect()->back()->with(['notify_error' => 'Product ID is required']);
            }
        }
        $validated = $validator->validated();
        try {
            $product = Product::where('product_id', '=', $validated['product_id'])->first();
            if ($product == null){
                return redirect()->back()->with(['notify_error' => 'This product does not exist']);
            }
            $product->name = $validated['name'];
            $product->description = $validated['description'];
            $product->model = $validated['model'];
            $product->quantity = $validated['quantity'];
            $product->unit_price = $validated['unit_price'];
            $product->categories = $validated['category'];
            $product->weight = isset($request->weight)?$request->weight:null;
            $dimentions = [];
            isset($request->length)?array_push($dimentions, $request->length):array_push($dimentions,0);
            isset($request->width)?array_push($dimentions, $request->width):array_push($dimentions,0);
            isset($request->height)?array_push($dimentions, $request->height):array_push($dimentions,0);
            $product->dimensions= json_encode($dimentions);
            $product->status = 0;
            $product->save();
            //images uploader
            $files = [];
            if($request->hasfile('additional_images'))
            {
                foreach($request->file('additional_images') as $file)
                {
                    $name = time().rand(1,50).'.'.$file->extension();
                    if( !file_exists(public_path('product_images'))){
                        mkdir(public_path('product_images'), 0777);
                    }if( !file_exists(public_path('product_images/'.$product->product_id))){
                    mkdir(public_path('product_images/'.$product->product_id), 0777);
                }
                    $file->move(public_path('product_images/'.$product->product_id), $name);
                    $files[] = $name;
                }
                foreach (json_decode($request->old_additional_images) as $old_additional_image){
                    $files[] = $old_additional_image;
                }
            }else{
                foreach (json_decode($request->old_additional_images) as $old_additional_image){
                    $files[] = $old_additional_image;
                }
            }
            $product->additional_images = json_encode($files);

            if($request->hasfile('main_image')){
                $name = time().rand(1,50).'.'.$request->main_image->extension();
                if( !file_exists(public_path('product_images'))){
                    mkdir(public_path('product_images'), 0777);
                }if( !file_exists(public_path('product_images/'.$product->product_id))){
                    mkdir(public_path('product_images/'.$product->product_id), 0777);
                }
                $request->main_image->move(public_path('product_images/'.$product->product_id), $name);
                $product->main_image = json_encode($name);
            }
            $product->save();
            return redirect()->back()->with(['success' => 'Product Updated Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function delete(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'delete-product', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to delete product']);
        }

        $validator = Validator::make($request->all(),[
            'product_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('product_id')){
                return redirect()->back()->with(['notify_error' => 'Product ID is Required to delete product']);
            }
        }
        $validated = $validator->validated();
        try {
            $product = Product::where('product_id', '=', $validated['product_id'])->first();
            if ($product == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify product']);
            }
            $product->delete();
            return redirect()->back()->with(['success' => 'Product Deleted Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function updateStock(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'edit-product', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to edit product']);
        }

        $validator = Validator::make($request->all(),[
            'quantity' => 'required',
            'product_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('quantity')){
                return redirect()->back()->with(['notify_error' => 'Product quantity is required'])->withErrors(['quantity' => 'Product quantity is required']);
            }
            if ($validator->errors()->has('product_id')){
                return redirect()->back()->with(['notify_error' => 'Product ID is required']);
            }
        }
        $validated = $validator->validated();
        try {
            $product = Product::where('product_id', '=', $validated['product_id'])->first();
            if ($product == null){
                return redirect()->back()->with(['notify_error' => 'This product does not exist']);
            }
            $product->quantity = $validated['quantity'];
            $product->status = 0;
            $product->save();
            return redirect()->back()->with(['success' => 'Product Stock Updated Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

}
