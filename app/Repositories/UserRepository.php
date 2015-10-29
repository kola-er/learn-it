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
	 * @param $provider
	 * @return mixed
	 */
	public function findUserOrCreate($userData, $provider) {
		if ($user = User::where($this->selectProviderField($provider), $userData->id)) {
			return $user;
		}

		$user = $this->createUser($userData, $provider);
		$this->createUserProfile($userData, $user->id);

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
	protected function createUser($userData, $provider) {
		$nameFromProvider = isset($userData->nickname) ? $userData->nickname : $userData->name;
		$username = User::where('username', $nameFromProvider)->first() ? null : $nameFromProvider;
		$providerField = $this->selectProviderField($provider);

		$user = new User;
		$user->$providerField = $userData->id;
		$user->username = $username;
		$user->email = $userData->email;
		$user->save();

		return User::where($providerField, $userData->id)->first();
	}

	/**
	 * Create profile for a new user authenticated through a social provider
	 *
	 * @param $userData
	 * @param $user_id
	 */
	protected function createUserProfile($userData, $user_id) {
		Profile::create([
			'user_id' => $user_id,
			'first_name' => isset($userData->user['first_name']) ? $userData->user['first_name'] : NULL,
			'last_name' => isset($userData->user['last_name']) ? $userData->user['last_name'] : NULL,
			'avatar' => isset($userData->avatar_original) ? $userData->avatar_original : $userData->avatar
		]);
	}

	/**
	 * Choose appropriate column to store id returned by a social provider
	 *
	 * @param $provider Social provider
	 * @return string Column to store id returned by a social provider
	 */
	protected function selectProviderField($provider) {
		if ($provider == 'facebook') {
			return 'fb_id';
		} elseif ($provider == 'twitter') {
			return 'tw_id';
		} elseif ($provider == 'github') {
			return 'gh_id';
		}
	}
}
