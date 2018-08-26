<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Http\Resources\SettingResource;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function indexRotator()
    {
        $return = [];
        $settings = Setting::where('setting_type', 'rotator')->get();

        foreach($settings as $setting) {
            if($setting->setting_name == 'setting_isRotate') {
                $return += [
                    'isRotate' => [
                        'setting_name' => $setting->setting_name,
                        'setting_value' => (bool)$setting->setting_value
                    ]
                ];
            }
            else if($setting->setting_name == 'setting_rotateMinute') {
                $return += [
                    'rotateMinute' => [
                        'setting_name' => $setting->setting_name,
                        'setting_value' => $setting->setting_value
                    ]
                ];
            }
        }
        return $return;
    }

    public function editRotator(Request $request)
    {
        foreach ($request->data as $key => $value) {
            Setting::where('setting_name', $value['setting_name'])
            ->update(['setting_value' => $value['setting_value']]);
        }
    }

    public function indexKeys()
    {
        $return = [];
        $settings = Setting::where('setting_type', 'keys')->get();

        foreach($settings as $setting) {
            if($setting->setting_name == 'setting_do_key') {
                $return += [
                    'do_key' => [
                        'setting_name' => $setting->setting_name,
                        'setting_value' => $setting->setting_value
                    ]
                ];
            }
            else if($setting->setting_name == 'setting_vu_key') {
                $return += [
                    'vu_key' => [
                        'setting_name' => $setting->setting_name,
                        'setting_value' => $setting->setting_value
                    ]
                ];
            }
            else if($setting->setting_name == 'setting_rc_key') {
                $return += [
                    'rc_key' => [
                        'setting_name' => $setting->setting_name,
                        'setting_value' => $setting->setting_value
                    ]
                ];
            }
            else if($setting->setting_name == 'setting_nc_key') {
                $return += [
                    'nc_key' => [
                        'setting_name' => $setting->setting_name,
                        'setting_value' => $setting->setting_value
                    ]
                ];
            }
            else if($setting->setting_name == 'setting_fn_key') {
                $return += [
                    'fn_key' => [
                        'setting_name' => $setting->setting_name,
                        'setting_value' => $setting->setting_value
                    ]
                ];
            }
        }
        return $return;
    }

    public function editKeys(Request $request)
    {
        foreach ($request->data as $key => $value) {
            Setting::where('setting_name', $value['setting_name'])
            ->update(['setting_value' => $value['setting_value']]);
        }
    }
}
