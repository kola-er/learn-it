<?php

namespace Learn\Http\Controllers;

use \Auth;
use Learn\Category;
use Learn\Http\Requests;
use Illuminate\Http\Request;

class ViewController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param null $categoryId
	 * @return \Illuminate\View\View
	 */
    public function index($categoryId = null)
    {
		$categories = Category::all();

        if (is_null($categoryId)) {
			$videos = Category::first()->videos;

            return view('pages.landing', compact(['categories', 'videos']));
        }

		$videos = Category::find($categoryId)->videos;

		return view('pages.landing', compact(['categories', 'videos']));
    }

    /**
     * Display a user's dashboard
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('pages.dashboard', compact(['user', 'categories']));
    }
}
