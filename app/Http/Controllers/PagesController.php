<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to Laravel App';
        //return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'About Us';
        return view('pages.about')->with('title', $title);
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'cnt' => 0,
            'services' => ['Web Deveopler', 'Android App Developer', 'Programming', 'Cyber Security']
        );
        return view('pages.services')->with($data);
    }

    public function contact(){
        $title = 'Contact Us';
        return view('pages.contact')->with('title', $title);
    }
}
