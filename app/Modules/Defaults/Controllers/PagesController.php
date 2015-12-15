<?php

namespace App\Modules\Defaults\Controllers;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function showAbout(){
    	return view('Defaults.Views.layouts.pages.about');
    }

    public function showContact(){
    	return view('Defaults.Views.layouts.pages.contact');
    }

    public function showHelp(){
    	return view('Defaults.Views.layouts.pages.help');
    }
}