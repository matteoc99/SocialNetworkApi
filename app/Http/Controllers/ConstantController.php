<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

/**
 * @group Constants
 *
 * APIs for looking up connstants
 */
class ConstantController extends Controller
{
    /**
     * retrives all global reference constants
     */
    public function index()
    {
        return Config::get('constants');
    }
}
