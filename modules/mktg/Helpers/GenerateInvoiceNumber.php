<?php

/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 7/18/16
 * Time: 1:04 PM
 */

namespace App;

use App\Setting;


class GenerateInvoiceNumber
{
    /*
     * $type :: Account Type(Like :: 'account-payable','account-receivable','account-adjustment','journal-voucher','receipt-voucher','reverse-entry')
     */
    public static function generate_invoice_number($type) {
        $settings = Setting::where('status','=','1')->where('type',$type)->first();
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
        /*
        $row_id= $setting_id from generate_invoice_number
        $value= $number from generate_invoice_number
         */
        $settings = Setting::findOrFail($row_id);
        if($settings){
            $settings->last_number=$value;
            $settings->save();
            return true;
        }else{
            return false;
        }
    }

}