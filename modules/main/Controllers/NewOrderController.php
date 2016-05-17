<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/15/16
 * Time: 1:37 PM
 */

namespace Modules\Main\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserImage;
use App\PropertyDetail;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PropertyDetailRequest;


class NewOrderController extends Controller
{
    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    public function index(){
        $pageTitle = "Property Detail For Marketing Matrial";
        $data = PropertyDetail::get();
        return view('main::new_order.index',['data'=>$data, 'pageTitle'=>$pageTitle]);

    }

    public function store(Requests\PropertyDetailRequest $request)
    {exit(111);
        $input = $request->all();
        print_r($input);exit;

        // input data for head
        $input_head =[
            'title'=>$input['title'],
            'price'=>$input['price']
        ];



        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //insert into head table
            $vh = PhotographyPackage::create($input_head);



            //Commit the transaction
            DB::commit();
            Session::flash('message', 'Successfully added!');

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());

        }

        return redirect()->route('photography-package');
    }

}