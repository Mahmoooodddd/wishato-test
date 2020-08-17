<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/1/20
 * Time: 5:23 PM
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class CoreController extends Controller
{
    public function response($result)
    {
        return response()->json($result,$result['statusCode']);
    }

    public function getUser()
    {
        return Auth::user();
    }
}
