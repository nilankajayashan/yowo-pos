<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sell;
use App\Models\User;
use App\Models\WebColor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        $permissions = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
        $permissions = $permissions->permissions;
        if (isset($request->state)){
            switch ($request->state){
                case 'dashboard':
                    $order_count = Order::count();
                    $user_count = User::count();
                    $product_count = Product::count();
                    $sells_count = Sell::count();
                    $orders = Order::all();
                    $sales = Sell::all();
                    $out_of_stocks = Product::where('quantity', '<=', 5)->get();
                    return view('dashboard', [
                        'state' => 'dashboard',
                        'permissions' => $permissions,
                        'order_count' => $order_count,
                        'user_count' => $user_count,
                        'product_count' => $product_count,
                        'sells_count' => $sells_count,
                        'orders' => $orders,
                        'sales' => $sales,
                        'out_of_stocks' => $out_of_stocks,
                    ]);
                    break;
                case 'categories':
                    $categories = Category::all();
                    $employees = Employee::all();
                    return view('dashboard', ['state' => 'categories', 'permissions' => $permissions, 'categories' => $categories, 'employees' => $employees]);
                    break;
                case 'products':
                    $products = Product::all();
                    $categories = Category::all();
                    return view('dashboard', ['state' => 'products', 'permissions' => $permissions, 'products' => $products, 'categories' => $categories]);
                    break;
                case 'stocks':
                    $products = Product::all();
                    $categories = Category::all();
                    return view('dashboard', ['state' => 'stocks', 'permissions' => $permissions, 'products' => $products, 'categories' => $categories]);
                    break;
                case 'sell':
                    $sells = Sell::all();
                    $users = User::all();
                    $employees = Employee::all();
                    return view('dashboard', ['state' => 'sell', 'permissions' => $permissions, 'sells' => $sells, 'users' => $users, 'employees' => $employees]);
                    break;
                case 'add_bill':
                    $users = User::all();
                    $products = Product::all();
                    return view('dashboard', ['state' => 'add_bill', 'permissions' => $permissions, 'products' => $products, 'users' => $users]);
                    break;
                case 'customers':
                    $users = User::all();
                    return view('dashboard', ['state' => 'customers', 'permissions' => $permissions, 'users' => $users]);
                    break;
                case 'web':
                    $primaryButtonColor = WebColor::where('component', '=', 'primary_button_color')->first();
                    $secondaryButtonColor = WebColor::where('component', '=', 'secondary_button_color')->first();
                    $ternaryButtonColor = WebColor::where('component', '=', 'ternary_button_color')->first();
                    $pendingStatusColor = WebColor::where('component', '=', 'pending_status_color')->first();
                    $processingStatusColor = WebColor::where('component', '=', 'processing_status_color')->first();
                    $processedStatusColor = WebColor::where('component', '=', 'processed_status_color')->first();
                    $shippedStatusColor = WebColor::where('component', '=', 'shipped_status_color')->first();
                    $completedStatusColor = WebColor::where('component', '=', 'completed_status_color')->first();
                    $failedStatusColor = WebColor::where('component', '=', 'failed_status_color')->first();
                    $successStatusColor = WebColor::where('component', '=', 'success_status_color')->first();
                    $titleBarColor = WebColor::where('component', '=', 'title_bar_color')->first();
                    return view('dashboard', ['state' => 'web', 'permissions' => $permissions,
                        'primaryButtonColor' => $primaryButtonColor,
                        'secondaryButtonColor' => $secondaryButtonColor,
                        'ternaryButtonColor' => $ternaryButtonColor,
                        'pendingStatusColor' => $pendingStatusColor,
                        'processingStatusColor' => $processingStatusColor,
                        'processedStatusColor' => $processedStatusColor,
                        'shippedStatusColor' => $shippedStatusColor,
                        'completedStatusColor' => $completedStatusColor,
                        'failedStatusColor' => $failedStatusColor,
                        'successStatusColor' => $successStatusColor,
                        'titleBarColor' => $titleBarColor,
                        ]);
                    break;
                case 'cart':
                    $carts = Cart::all();
                    $users = User::all();
                    $products = Product::all();
                    return view('dashboard', ['state' => 'cart', 'permissions' => $permissions, 'carts' => $carts, 'users' => $users, 'products' => $products]);
                    break;
                case 'orders':
                    $orders = Order::all();
                    $users = User::all();
                    return view('dashboard', ['state' => 'orders', 'permissions' => $permissions, 'orders' => $orders, 'users' => $users]);
                    break;
                case 'employees':
                    $employees = Employee::where('employee_id', '!=', session()->get('auth_employee')->employee_id)->get();
                    return view('dashboard', ['state' => 'employees', 'permissions' => $permissions, 'employees' => $employees]);
                    break;
                case 'my_account':
                    $my_details = Employee::where('employee_id', '=', session()->get('auth_employee')->employee_id)->first();
                    return view('dashboard', ['state' => 'my_account', 'permissions' => $permissions, 'my_details' => $my_details]);
                    break;
                default:
                    return view('dashboard', ['state' => 'dashboard', 'permissions' => $permissions]);
                    break;
            }

        }else{
            $order_count = Order::count();
            $user_count = User::count();
            $product_count = Product::count();
            return view('dashboard', ['state' => 'dashboard', 'permissions' => $permissions, 'order_count' => $order_count, 'user_count' => $user_count, 'product_count' => $product_count]);
        }
    }
}
