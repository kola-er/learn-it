<?php

namespace Learn\Http\Controllers;

use \Auth;
use Illuminate\Http\Request;
use Learn\Http\Requests;

class AccountUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerPassword(Request $request)
    {
		$user = Auth::user();

		if ($user->password == bcrypt('password')) {
			return view('pages.initial-password', compact('user'));
		}

		if (isset($request)) {
			$user->password = $request['password'];
			$user->save();
		}

		return redirect('dashboard');
    }

	public function editProfile(Request $request) {
		$user = Auth::user();

		if (isset($request)) {
			return redirect('dashboard');
		}

		return view('pages.profile', compact(['user']));
	}
}
