<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {

    public function getPortfolio()
    {
        return view('pages.index');
	}

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contactPost()
    {
        return redirect()->back()->with('flash_message', 'Thank you for contacting us, we will respond to you shortly');
    }

}
