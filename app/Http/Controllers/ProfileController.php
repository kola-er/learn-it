<?php

namespace Learn\Http\Controllers;

use \Auth;
use Learn\Helper\UploadAvatar;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	/**
	 * Update Profile
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function updateProfile(Request $request)
	{
		$user = Auth::user();

		foreach ($request as $key => $value) {
			if ($key == 'avatar') {
				$user->$key = UploadAvatar::uploadAvatar($value);
			}

			$user->$key = $value;
		}

		$user->save();

		return redirect('dashboard');
	}
}
