<?php

namespace Learn\Http\Controllers;

use \Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function updateProfile(Request $request)
	{
		$user = Auth::user();

		foreach ($request as $key => $value) {
			$user->$key = $value;
		}

		$user->save();

		return redirect('dashboard');
	}

	public function editProfile() {
		$user = Auth::user();

		return view('pages.profile', compact(['user']));
	}
}
