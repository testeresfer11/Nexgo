<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{GeneralSetting,ConfigSetting};
use Illuminate\Support\Facades\Validator;
class GeneralController extends Controller
{
    public function edit(Request $request){
        try{
            if($request->isMethod('get')){
                $general = GeneralSetting::first();
                
                return view("admin.config-setting.general",compact('general'));
            }elseif( $request->isMethod('post') ){


                $imageName='';
                if ($request->hasFile('logo')) {
                    $imageName = time().'.'.$request->logo->extension();  

                    $request->logo->storeAs('public/logo', $imageName);

                    $update=GeneralSetting::where('id' , '1')->first();

                    if(!$update)
                    {
                        GeneralSetting::create([
                            'site_name'        => $request->site_name,
                            'email'       => $request->email, 
                            'country_code' => $request->country_code,
                            'phone' => $request->phone_number,
                            'logo' => $imageName,
                            'address'  => $request->address,
                            'platform_fee'=>$request->platform_fee,
                            'commission'=>$request->commission,
                            'per_km_price'=>$request->per_km_price
                        ]);
                    }
                    else
                    {
                        GeneralSetting::where('id' , '1')->update([
                            'site_name'        => $request->site_name,
                            'email'       => $request->email, 
                            'country_code' => $request->country_code,
                            'phone' => $request->phone_number,
                            'logo' => $imageName,
                            'address'  => $request->address,
                            'platform_fee'=>$request->platform_fee,
                            'commission'=>$request->commission,
                            'per_km_price'=>$request->per_km_price
                        ]);
                    }
                    
                }
                else
                {
                    $update=GeneralSetting::where('id' , '1')->first();

                    if(!$update)
                    {

                        GeneralSetting::create([
                            'site_name'        => $request->site_name,
                            'email'       => $request->email, 
                            'country_code' => $request->country_code,
                            'phone' => $request->phone_number,
                            'address'  => $request->address,
                            'platform_fee'=>$request->platform_fee,
                            'commission'=>$request->commission,
                            'per_km_price'=>$request->per_km_price
                        ]);
                    }
                    else
                    {
                        GeneralSetting::where('id' , '1')->update([
                            'site_name'        => $request->site_name,
                            'email'       => $request->email, 
                            'country_code' => $request->country_code,
                            'phone' => $request->phone_number,
                            'address'  => $request->address,
                            'platform_fee'=>$request->platform_fee,
                            'commission'=>$request->commission,
                            'per_km_price'=>$request->per_km_price
                        ]);
                    }
                }

                
                return redirect()->route('admin.settings.general')->with('success','General '.config('constants.SUCCESS.UPDATE_DONE'));
            }
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }


    public function notifications(Request $request){
    }



    /**
     * functionName : smtpInformation
     * createdDate  : 14-06-2024
     * purpose      : update the smtp information
     */
    public function smtpInformation(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                $smtpDetail = ConfigSetting::where('type', 'smtp')->pluck('value', 'key');
                return view("admin.config-setting.smtp", compact('smtpDetail'));
            } elseif ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'from_email'    => 'required|email:rfc,dns',
                    'host'          => 'required',
                    'port'          => 'required',
                    'username'      => 'required|email:rfc,dns',
                    'from_name'     => 'required',
                    'password'      => 'required',
                    'encryption'    => 'required|in:tls,ssl',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                ConfigSetting::updateOrCreate(['type' => 'smtp', 'key' => 'from_email'], ['value' => $request->from_email]);
                ConfigSetting::updateOrCreate(['type' => 'smtp', 'key' => 'host'], ['value' => $request->host]);
                ConfigSetting::updateOrCreate(['type' => 'smtp', 'key' => 'port'], ['value' => $request->port]);
                ConfigSetting::updateOrCreate(['type' => 'smtp', 'key' => 'username'], ['value' => $request->username]);
                ConfigSetting::updateOrCreate(['type' => 'smtp', 'key' => 'from_name'], ['value' => $request->from_name]);
                ConfigSetting::updateOrCreate(['type' => 'smtp', 'key' => 'password'], ['value' => $request->password]);
                ConfigSetting::updateOrCreate(['type' => 'smtp', 'key' => 'encryption'], ['value' => $request->encryption]);

                return redirect()->back()->with('success', 'SMTP information ' . config('constants.SUCCESS.UPDATE_DONE'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    /**End method smtpInformation**/

}
