<?php

namespace Learn\Http\Controllers;

use \Auth;
use Illuminate\Http\Request;
use Learn\User;
use Learn\Profile;
use Cloudinary\Uploader;

\Cloudinary::config([
	"cloud_name" => env('CLOUDINARY_CLOUD_NAME'),
	"api_key" => env('CLOUDINARY_API_KEY'),
	"api_secret" => env('CLOUDINARY_API_SECRET')
]);

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
        $profile = Profile::where('user_id', $user->id)->first();

		$userUpdateCheck = 0;
		$profileUpdateCheck = 0;

        if (! empty($request['username']) && is_null(User::where('username', $request['username'])->first())) {
            $user->username = $request['username'];
			$userUpdateCheck++;
        }

		if (! empty($request['email']) && is_null(User::where('email', $request['email'])->first())) {
			$user->email = $request['email'];
			$userUpdateCheck++;
		}

		if (! empty($request['first_name'])) {
			$profile->first_name = $request['first_name'];
			$profileUpdateCheck++;
		}

		if (! empty($request['last_name'])) {
			$profile->last_name = $request['last_name'];
			$profileUpdateCheck++;
		}

        if ($userUpdateCheck !== 0) {
			$user->save();
		}

		if ($profileUpdateCheck !== 0) {
			$profile->save();
		}

        return redirect('dashboard');
    }

	/**
	 * Upload avatar to Cloudinary and save the returned url to database
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function updateAvatar(Request $request)
    {
        if ($request['file']) {
            $result = Uploader::upload($request['file'], ["public_id" => Auth::user()->username . rand(1, 100)]);
            $profile = Profile::where('user_id', Auth::user()->id)->first();
            $profile->avatar = $result['url'];
            $profile->save();
        }

        return redirect('dashboard');
    }
}
