<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TokoController extends Controller
{

    public function getUser(){

        $user = User::all();

        return response()->json($user);

    }

}
