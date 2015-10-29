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
			}

			$user = $this->createUser('email', $email);
		} else {
			$username = $userData->nickname;

			if ($user = User::where('username', $username)->first()) {
				return $user->password == md5($username) ? $user : redirect('login');
			}

			$user = $this->createUser('username', $username);
		}

		$field = isset($email) ? ['name' => 'email', 'value' => $email] : ['name' => 'username', 'value' => $username];

		$this->createUserProfile($userData, $field['name'], $field['value']);

		return $user;
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

	/**
	 * Get user's avatar on gravatar or set a default one
	 *
	 * @param $email
	 * @return string $gravatar
	 */
	protected function get_gravatar($email) {
		$gravatar = 'http://www.gravatar.com/avatar/';
		$gravatar .= md5( strtolower( trim( $email ) ) );
		$gravatar .= "?s=80&d=mm&r=g";

		return $gravatar;
	}

	/**
	 * Create a new user authenticated through a social provider
	 *
	 * @param $field
	 * @param $fieldValue
	 * @return mixed
	 */
	protected function createUser($field, $fieldValue) {
		$user = new User;
		$user->$field = $fieldValue;
		$user->password = md5($fieldValue);
		$user->save();

		return User::where($field, $fieldValue)->first();
	}

	/**
	 * Create profile for a new user authenticated through a social provider
	 *
	 * @param $userData
	 * @param $fieldName
	 * @param $fieldValue
	 */
	protected function createUserProfile($userData, $fieldName, $fieldValue) {
		Profile::create([
			'user_id' => User::where($fieldName, $fieldValue)->first()->id,
			'first_name' => isset($userData->user['first_name']) ? $userData->user['first_name'] : null,
			'last_name' => isset($userData->user['last_name']) ? $userData->user['last_name'] : null,
			'avatar' => isset($userData->avatar_original) ? $userData->avatar_original : $userData->avatar
		]);
	}
}
