<?php

namespace App\Modules\api\Eloquent;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Modules\Administration\Models\User;

class ApiController extends Controller
{
    public function getAllUsers()
    {
        return User::all();
    }
}
