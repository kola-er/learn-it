<?php
namespace Learn\Repositories;

use Learn\Profile;
use Learn\User;

class UserRepository
{
	public function findUserOrCreate($userData) {
		$tempEmail = $userData->email ? : $userData->id.'@learnit.com';

		$user = User::firstOrNew([
			'email' => $tempEmail,
			'password' => bcrypt('password')
		]);

		if (User::where('email', $tempEmail)->first()) {
			return ['user' => $user, 'status' => 'old'];
		}

		$user->save();

		Profile::create([
			'user_id' => User::where('email', $tempEmail)->first()->id,
			'first_name' => $userData->user['first_name'] ? : null,
			'last_name' => $userData->user['last_name'] ? : null,
			'avatar' => $userData->avatar_original ? : $userData->avatar
		]);

		return ['user' => $user, 'status' => 'new'];
	}
}
