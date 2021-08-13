<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class BugsController extends Controller
{
    public function loadview(){
        return view('admin.bugs.bugs');
    
    }
}
