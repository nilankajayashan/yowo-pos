<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarCodeController extends Controller
{
    public function generateBarcode(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('product_id')){
                return redirect()->back()->with(['notify_error' => 'Can not identify product']);
            }else{
                return redirect()->back()->with(['notify_error' => 'Something went wrong']);

            }
        }
        $validated = $validator->validated();
        $product = Product::where('product_id', '=', $validated['product_id'])->first();
        $pdf = PDF::loadView('pdf/barcode-download', ['product' => $product]);
        return $pdf->download('Product-'.$validated['product_id'].'.pdf');
    }

}
