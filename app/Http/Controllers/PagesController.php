<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//line 5 brings the request liberary

class PagesController extends Controller
{
    public function index()
    {
    	$title = 'welcome to laravel !';
    	// return view('pages.index',compact('title'));
    	// compact('title') to pass the value to the index.blade page: first way

    	return view('pages.index')->with('title',$title);

    	// with('title',$title) par1:what we want to call the var in the view, par2: the real var
    }

    public function about()
    {
    	$title = 'About US';
    	return view('pages.about')->with('title',$title);
    }

     public function services()
    {
    	$data = array(
    		'title' => 'services',
    		'services'=>['web design','programing','SEO']);
    	return view('pages.services')->with($data);
    }
}
