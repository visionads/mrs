<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 7/26/16
 * Time: 1:28 PM
 */

namespace Modules\Mktg\Controllers;

use App\UserImage;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Helpers\ImageResize;
use App\MktgMaterial;
use App\MktgArtwork;
use App\MktgMenuItem;
use App\MktgItemOption;
use App\MktgMenuItemImage;
use App\MktgItemValue;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Validator;


class AgencyMarketingController extends Controller
{
    public function agency_stationary_material($slug)
    {
        $title = MktgMenuItem::where('slug',$slug)->first();
        $pageTitle = $title['title'];
        $data = MktgMenuItem::with('relMktgMenuItemImage','relMktgItemOption','relMktgItemOption.relMktgItemValue')->where('slug',$slug)->get()->toArray();

        $value = DB::table('mktg_item_value')->lists('title', 'id');

        $artwork = MktgArtwork::orderBy('slug','ASC')->get();

        #print_r($artwork);exit;
        /*return view('mktg::marketing_material.agency_stationary_materials.index',$data,$value);*/

        return view('mktg::marketing_material.agency_stationary_materials.index',array(
            'pageTitle'=>$pageTitle,
            'data'=>$data,
            'value'=>$value,
            'artwork'=>$artwork,
        ));

    }

}