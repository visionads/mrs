<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 7/18/16
 * Time: 1:01 PM
 */

namespace App;


use App\MktgSetting;


class GenerateOrderNumber
{
    /*
     * $type :: Account Type(Like :: 'account-payable','account-receivable','account-adjustment','journal-voucher','receipt-voucher','reverse-entry')
     */
    public static function generate_number($type) {
        $settings = MktgSetting::where('status','=','open')->where('type',$type)->first();
        if($settings){
            $number = $settings['last_number']+$settings['increment'];
            $settings_code = $settings['code'];
            $settings_id = $settings['id'];
            $generate_voucher_number = $settings_code.'-'.str_pad($number, 6, '0', STR_PAD_LEFT);
            $array = array('generated_number'=>$generate_voucher_number, 'setting_id'=>$settings_id, 'number' => $number );
            return  $array;
        }else{
            return  false;
        }
    }
    public static function update_row($row_id,$value) {
        $settings = MktgSetting::findOrFail($row_id);
        if($settings){
            $settings->last_number=$value;
            $settings->save();
            return  true;
        }else{
            return  false;
        }
    }

}