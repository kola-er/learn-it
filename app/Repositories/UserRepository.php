<?php
namespace Learn\Repositories;

use Learn\Profile;
use Learn\User;
use Datetime;

class UserRepository
{

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
}
