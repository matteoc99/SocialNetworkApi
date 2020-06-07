<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

/**
 * @group Constants
 *
 * APIs for looking up comments
 */
class ConstantController extends Controller
{
    /**
     * ret
     */
    public function index()
    {
        return Config::get('constants');
    }
}
