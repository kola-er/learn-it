<?php
namespace Learn\Repositories;

use Learn\User;
use Learn\Profile;

class UserRepository
{
	/**
	 * Handle a social registration/login request to the application
	 *
	 * @param $userData Collection of a user's info received from a social provider
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|User
	 */
	public function findUserOrCreate($userData) {
		if (! is_null($userData->email)) {
			$email = $userData->email;

			if ($user = User::where('email', $email)->first()) {
				return $user;
			} else {
				$user = new User;
				$user->email = $email;
				$user->password = md5($userData->id . $email);
				$user->save();
			}
		} else {
			$username = $userData->nickname;

			if ($user = User::where('username', $username)->first()) {
				return $user->password == md5($userData->id . $username) ? $user : redirect('login');
			}

			$user = new User;
			$user->username = $username;
			$user->password = md5($userData->id . $username);
			$user->save();
		}

		Profile::create([
			'user_id' => isset($email) ? User::where('email', $email)->first()->id : User::where('username', $username)->first()->id,
			'first_name' => isset($userData->user['first_name']) ? $userData->user['first_name'] : null,
			'last_name' => isset($userData->user['last_name']) ? $userData->user['last_name'] : null,
			'avatar' => isset($userData->avatar_original) ? $userData->avatar_original : $userData->avatar
		]);

		return $user;
	}

	/**
	 * Get user's avatar on gravatar or set a default one
	 *
	 * @param $email
	 * @return string $gravatar
	 */
	public function get_gravatar($email) {
		$gravatar = 'http://www.gravatar.com/avatar/';
		$gravatar .= md5( strtolower( trim( $email ) ) );
		$gravatar .= "?s=80&d=mm&r=g";

		return $gravatar;
	}

	/**
	 * Save user's avatar
	 *
	 * @param User $user
	 */
	public function setUserAvatar(User $user) {
		$userProfile = new Profile;
		$userProfile->user_id = $user->id;
		$userProfile->avatar = $this->get_gravatar($user->email);
		$userProfile->save();
	}
}
