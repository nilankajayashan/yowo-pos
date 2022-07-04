<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sell;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PDFController extends Controller
{
    public function downloadOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'order_id' => 'required'
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('order_id')){
                return redirect()->back()->with(['notify_error' => 'Can not identify order']);
            }else{
                return redirect()->back()->with(['notify_error' => 'Something went wrong']);

            }
        }
        $validated = $validator->validated();
        $order = Order::where('id', '=', $validated['order_id'])->first();
        $pdf = PDF::loadView('pdf/order-download', ['order' => $order]);
        return $pdf->download('Order-'.$validated['order_id'].'.pdf');
    }
    public function downloadBill(Request $request){
        $validator = Validator::make($request->all(), [
            'bill_id' => 'required'
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('bill_id')){
                return redirect()->back()->with(['notify_error' => 'Can not identify bill']);
            }else{
                return redirect()->back()->with(['notify_error' => 'Something went wrong']);

            }
        }
        $validated = $validator->validated();
        $bill = Sell::where('bill_id', '=', $validated['bill_id'])->first();
        $user = User::where('user_id', '=', $bill->user_id)->first();
        $pdf = PDF::loadView('pdf/bill-download', ['bill' => $bill, 'user' => $user]);
        return $pdf->download('Bill-'.$validated['bill_id'].'.pdf');
    }
}
