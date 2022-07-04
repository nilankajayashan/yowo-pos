<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function add(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'add-category', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to add Category']);
        }

       $validator = Validator::make($request->all(),[
            'name' => 'required',
            'parent_id' => 'required',
       ]);
       if ($validator->fails()){
           if ($validator->errors()->has('name')){
               return redirect()->back()->with(['notify_error' => 'Category Name is Required'])->withErrors(['name' => 'Category Name Required ex: Electronics']);
           }
           if ($validator->errors()->has('parent_id')){
                return redirect()->back()->with(['notify_error' => 'Parent Category is Required'])->withErrors(['parent_id' => 'Parent Category is Required ex: Electronics']);
           }
       }
       $validated = $validator->validated();
        try {
            $category = new Category();
            $category->name = $validated['name'];
            $category->parent_id = $validated['parent_id'];
            $category->description = isset($request->description)?$request->description:'This Category will show all '.($validated['name'][-1]=='s'? $validated['name']:$validated['name'].' items');
            $category->icon = isset($request->icon)?$request->icon:'icon.png';
            if (isset($request->show_menu) && $request->show_menu == 'on'){
                $category->show_menu = 1;
            }
            $category->status = 0;
            $category->added_by = session()->get('auth_employee')->employee_id;
            $category->save();
            return redirect()->back()->with(['success' => 'Category Added Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function edit(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'edit-category', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to edit Category']);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'parent_id' => 'required',
            'category_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('name')){
                return redirect()->back()->with(['notify_error' => 'Category Name is Required'])->withErrors(['name' => 'Category Name Required ex: Electronics']);
            }
            if ($validator->errors()->has('parent_id')){
                return redirect()->back()->with(['notify_error' => 'Parent Category is Required'])->withErrors(['parent_id' => 'Parent Category is Required ex: Electronics']);
            }
            if ($validator->errors()->has('category_id')){
                return redirect()->back()->with(['notify_error' => 'Category ID is Required']);
            }
        }
        $validated = $validator->validated();
        try {
            $category = Category::where('category_id', '=', $validated['category_id'])->first();
            if ($category == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify category']);
            }
            $category->name = $validated['name'];
            $category->parent_id = $validated['parent_id'];
            $category->description = isset($request->description)?$request->description:'This Category will show all '.($validated['name'][-1]=='s'? $validated['name']:$validated['name'].' items');
            $category->icon = isset($request->icon)?$request->icon:'icon.png';
            if (isset($request->show_menu) && $request->show_menu == 'on'){
                $category->show_menu = 1;
            }
            $category->status = 0;
            $category->added_by = session()->get('auth_employee')->employee_id;
            $category->save();
            return redirect()->back()->with(['success' => 'Category Updated Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function delete(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'delete-category', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to delete Category']);
        }
        $validator = Validator::make($request->all(),[
            'category_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('category_id')){
                return redirect()->back()->with(['notify_error' => 'Category ID is Required to delete category']);
            }
        }
        $validated = $validator->validated();
        try {
            $category = Category::where('category_id', '=', $validated['category_id'])->first();
            if ($category == null){
                return redirect()->back()->with(['notify_error' => 'Can not identify category']);
            }
            $category->delete();
            return redirect()->back()->with(['success' => 'Category Deleted Successfully']);
        }catch (Exception $exception){
            return redirect()->back()->with(['error' => 'Something Went Wrong'.$exception->getMessage()]);
        }
    }

    public function changeStatus(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (!in_array( 'approve-category', json_decode($permissions))){
            return redirect()->back()->with(['notify_warning' => 'You have not permission to Active/De-active Category']);
        }
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('category_id')){
                return redirect()->back()->with(['notify_error' => 'Category id required to Active/De-active Category']);
            }
            return redirect()->back()->with(['notify_error' => 'Something went wrong...!']);
        }
        $validated = $validator->validated();
        try{
            $category = Category::where('category_id', '=', $validated['category_id'])->first();
            if ($category == null){
                return redirect()->back()->with(['notify_error' => 'Not exist Category with this category id']);
            }
            if ($category->status == 1){
                $category->status = 0;
                $category->save();
                return redirect()->back()->with(['success' => 'Category Deactive Successfully']);
            }else{
                $category->status = 1;
                $category->save();
                return redirect()->back()->with(['success' => 'Category Active Successfully']);
            }
        }catch (Exception $exception){
            return redirect()->back()->with(['notify_error' => 'Something went wrong...!']);
        }
    }
}
