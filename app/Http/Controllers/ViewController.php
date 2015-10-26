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
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$categories = Category::simplePaginate(8);

		return view('pages.landing', compact(['categories']));
	}

	/**
	 * Display a user's dashboard
	 *
	 * @return \Illuminate\View\View
	 */
	public function dashboard()
	{
		$user = Auth::user();
		$categories = Category::simplePaginate(8);

		return view('pages.dashboard', compact(['user', 'categories']));
	}
}
