<?php
namespace Modules\Main\Controllers;

/**
 * Created by PhpStorm.
 * User: sr
 * Date: 5/8/16
 * Time: 1:55 PM
 */

use App\UserImage;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;



class PagesController extends Controller
{
    public function index()
    {
        //return view("main::main_pages.what_we_do");
    }

    public function what_we_do()
    {
        return view("main::main_pages.what_we_do");
    }

    public function need_help()
    {
        return view("main::main_pages.need_help");
    }



}