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
        $data['pageTitle'] = $title['title'];
        $data['data'] = MktgMenuItem::with('relMktgMenuItemImage','relMktgItemOption','relMktgItemOption.relMktgItemValue')->where('slug',$slug)->get();

        #print_r($title['title']);exit;

        return view('mktg::marketing_material.agency_stationary_materials.index',$data);
    }

}