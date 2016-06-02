<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/19/2016
 * Time: 12:25 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = [
         'quote_id',
         'currency',
         'invoice_no',
         'amount',
         'gst',
         'total_amount',
         'status',
        'business_id'
    ];
    public function relPayment(){
        return $this->hasMany('App\Payment','transaction_id','id');
    }

    public function relQuote(){
        return $this->hasMany('App\Quote','id','quote_id');
        //return DB::table('quote');
    }// -- Ram -- For Invoice List (route: invoice-list)



    public static function getAllTransactionWithPayment(){
        return DB::table('transaction')
            ->select('transaction.*','payment.amount as payment_amount')
            ->leftJoin('payment', 'transaction.id', '=', 'payment.transaction_id')
            ->orderBy('id','DESC')
            //->get();
            ->paginate(10);
    } // -- Ram -- Not Used

    public static function getAllTransactionWithPaymentForAgent(){
        return DB::table('transaction')
            ->select('transaction.*','payment.amount as payment_amount')
            ->leftJoin('payment','transaction.id', '=', 'payment.transaction_id')
            ->where('transaction.business_id', Auth::user()->business_id)
            ->orderBy('id','DESC')
            ->paginate(10);
    } // -- Ram -- Not Used

    public static function getTransactionDetails($id)
    {
        return Transaction::join('quote', 'quote_id', '=', 'quote.id')
                ->select('*','quote.quote_number')
//                ->with('relPayment')
                ->where('transaction.id',$id)
            ->first();
    }


    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'

    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
                $query->business_id = isset(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
                $query->business_id = isset(Auth::user()->business_id)?Auth::user()->business_id:null;
            }
        });
    }


}