<?php

namespace App\Http\Controllers;

use App\Models\ShopDetails;
use App\Models\WebColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{
    public function updateColor(Request $request){
        if (isset($request->primary_button_color)){
            $webColor = WebColor::where('component', '=', 'primary_button_color')->first();
            if ($webColor == null){
                $webColor  = new WebColor();
            }
            $webColor->component = 'primary_button_color';
            $webColor->name = $request->primary_button_color;
            $webColor->save();
            return redirect()->back()->with(['notify_success' => 'Primary Button Color Updated Successfully']);
        }

        if (isset($request->secondary_button_color)){
            $webColor = WebColor::where('component', '=', 'secondary_button_color')->first();
            if ($webColor == null){
                $webColor  = new WebColor();
            }
            $webColor->component = 'secondary_button_color';
            $webColor->name = $request->secondary_button_color;
            $webColor->save();
            return redirect()->back()->with(['notify_success' => 'Secondary Button Color Updated Successfully']);
        }
        if (isset($request->ternary_button_color)){
            $webColor = WebColor::where('component', '=', 'ternary_button_color')->first();
            if ($webColor == null){
                $webColor  = new WebColor();
            }
            $webColor->component = 'ternary_button_color';
            $webColor->name = $request->ternary_button_color;
            $webColor->save();
            return redirect()->back()->with(['notify_success' => 'Ternary Button Color Updated Successfully']);
        }

        if (isset($request->pending_status_color)){
            $webColor = WebColor::where('component', '=', 'pending_status_color')->first();
            if ($webColor == null){
                $webColor  = new WebColor();
            }
            $webColor->component = 'pending_status_color';
            $webColor->name = $request->pending_status_color;
            $webColor->save();
            return redirect()->back()->with(['notify_success' => 'Pending Status Color Updated Successfully']);
        }
        if (isset($request->processing_status_color)){
            $webColor = WebColor::where('component', '=', 'processing_status_color')->first();
            if ($webColor == null){
                $webColor  = new WebColor();
            }
            $webColor->component = 'processing_status_color';
            $webColor->name = $request->processing_status_color;
            $webColor->save();
            return redirect()->back()->with(['notify_success' => 'processing Status Color Updated Successfully']);
        }
        if (isset($request->processed_status_color)){
            $webColor = WebColor::where('component', '=', 'processed_status_color')->first();
            if ($webColor == null){
                $webColor  = new WebColor();
            }
            $webColor->component = 'processed_status_color';
            $webColor->name = $request->processed_status_color;
            $webColor->save();
            return redirect()->back()->with(['notify_success' => 'processed Status Color Updated Successfully']);
        }
        if (isset($request->shipped_status_color)){
            $webColor = WebColor::where('component', '=', 'shipped_status_color')->first();
            if ($webColor == null){
                $webColor  = new WebColor();
            }
            $webColor->component = 'shipped_status_color';
            $webColor->name = $request->shipped_status_color;
            $webColor->save();
            return redirect()->back()->with(['notify_success' => 'shipped Status Color Updated Successfully']);
        }
        if (isset($request->completed_status_color)){
            $webColor = WebColor::where('component', '=', 'completed_status_color')->first();
            if ($webColor == null){
                $webColor  = new WebColor();
            }
            $webColor->component = 'completed_status_color';
            $webColor->name = $request->completed_status_color;
            $webColor->save();
            return redirect()->back()->with(['notify_success' => 'completed Status Color Updated Successfully']);
        }
        if (isset($request->failed_status_color)){
            $webColor = WebColor::where('component', '=', 'failed_status_color')->first();
            if ($webColor == null){
                $webColor  = new WebColor();
            }
            $webColor->component = 'failed_status_color';
            $webColor->name = $request->failed_status_color;
            $webColor->save();
            return redirect()->back()->with(['notify_success' => 'failed Status Color Updated Successfully']);
        }
        if (isset($request->success_status_color)){
            $webColor = WebColor::where('component', '=', 'success_status_color')->first();
            if ($webColor == null){
                $webColor  = new WebColor();
            }
            $webColor->component = 'success_status_color';
            $webColor->name = $request->success_status_color;
            $webColor->save();
            return redirect()->back()->with(['notify_success' => 'success Status Color Updated Successfully']);
        }
        if (isset($request->title_bar_color)){
            $webColor = WebColor::where('component', '=', 'title_bar_color')->first();
            if ($webColor == null){
                $webColor  = new WebColor();
            }
            $webColor->component = 'title_bar_color';
            $webColor->name = $request->title_bar_color;
            $webColor->save();
            return redirect()->back()->with(['notify_success' => 'title bar Color Updated Successfully']);
        }


        return redirect()->back()->with(['notify_warning' => 'Anything not changed']);

    }

    public function updateBasicShopDetails(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);
        if ($validator->fails()){
            if ($validator->errors()->has('name')){
                return redirect()->back()->with(['notify_error' => 'Shop name required']);
            }
            if ($validator->errors()->has('address')){
                return redirect()->back()->with(['notify_error' => 'Shop address required']);
            }
            if ($validator->errors()->has('email')){
                return redirect()->back()->with(['notify_error' => 'Shop email required']);
            }
            if ($validator->errors()->has('mobile')){
                return redirect()->back()->with(['notify_error' => 'Shop mobile required']);
            }
        }
        $validated = $validator->validated();
        $shopName = ShopDetails::where('component', '=', 'name')->first();
        if ($shopName == null){
            $shopName  = new ShopDetails();
        }
        $shopName->component = 'name';
        $shopName->value = $validated['name'];
        $shopName->save();

        $shopAddress = ShopDetails::where('component', '=', 'address')->first();
        if ($shopAddress == null){
            $shopAddress  = new ShopDetails();
        }
        $shopAddress->component = 'address';
        $shopAddress->value = $validated['address'];
        $shopAddress->save();

        $shopEmail = ShopDetails::where('component', '=', 'email')->first();
        if ($shopEmail == null){
            $shopEmail  = new ShopDetails();
        }
        $shopEmail->component = 'email';
        $shopEmail->value = $validated['email'];
        $shopEmail->save();

        $shopMobile = ShopDetails::where('component', '=','mobile')->first();
        if ($shopMobile == null){
            $shopMobile  = new ShopDetails();
        }
        $shopMobile->component = 'mobile';
        $shopMobile->value = $validated['mobile'];
        $shopMobile->save();

        return redirect()->back()->with(['success' => 'Shop Details updated successfully...!']);

    }

    public function updateShopSocialLinks(Request $request){
        $facebook = ShopDetails::where('component', '=', 'facebook')->first();
        if ($facebook == null){
            $facebook  = new ShopDetails();
        }
        $facebook->component = 'facebook';
        $facebook->value = $request->facebook;
        $facebook->save();

        $google = ShopDetails::where('component', '=', 'google')->first();
        if ($google == null){
            $google  = new ShopDetails();
        }
        $google->component = 'google';
        $google->value = $request->google;
        $google->save();

        return redirect()->back()->with(['success' => 'Shop social links updated successfully...!']);

    }
}
