<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/12/16
 * Time: 9:25 AM
 */

namespace Modules\Admin\Controllers;

use App\UserImage;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Setting;
use DB;


class SettingsController extends Controller
{
    public function dashboard_index()
    {
        $pageTitle = 'Settings - Dashboard';
        $user_image = UserImage::where('user_id',Auth::user()->id)->first();

        return view('admin::settings.dashboard',['pageTitle'=>$pageTitle,'user_image'=>$user_image]);
    }

    public function settings_table()
    {
        $pageTitle = 'Settings';
        $data = Setting::get();
        return view('admin::settings.settings_table',[
            'pageTitle'=> $pageTitle,
            'data'     => $data
        ]);
    }


    public function settings_edit($id)
    {
        $pageTitle = 'Settings Edit';
        $data = Setting::where('id',$id)->first();
        return view('admin::settings.settings_edit',['data'=>$data,'pageTitle'=>$pageTitle]);
    }

    public function settings_update(Request $request,$id)
    {
        $model = Setting::where('id',$id)->first();
        $input = $request->all();
        DB::beginTransaction();
        try{
            $model->update($input);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->back();

    }


}