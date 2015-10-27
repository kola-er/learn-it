<?php

namespace Learn\Http\Controllers;

use \Auth;
use Illuminate\Http\Request;
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
        $profile = Profile::find(Auth::user()->id);


        if (! empty($request['username'])) {
            $user->username = $request['username'];
        }
		if (! empty($request['email'])) {
			$user->email = $request['email'];
		}
		if (! empty($request['first_name'])) {
			$profile->first_name = $request['first_name'];
		}
		if (! empty($request['last_name'])) {
			$profile->last_name = $request['last_name'];
		}

        $user->save();
        $profile->save();

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
            $profile = Profile::find(Auth::user()->id);
            $profile->avatar = $result['url'];
            $profile->save();
        }

        return redirect('dashboard');
    }
}
