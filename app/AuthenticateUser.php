<?php
/**
 * Created by PhpStorm.
 * User: andela
 * Date: 10/24/15
 * Time: 10:55 AM
 */

namespace Learn;

use Illuminate\Contracts\Http;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Learn\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateUser {

	private $socialite;
	private $auth;
	private $user;

	public function __construct(UserRepository $user, Socialite $socialite, Guard $auth) {
		$this->auth = $auth;
		$this->user = $user;
		$this->socialite = $socialite;
	}

	public function execute($request, $provider, $redirect) {

		if (! ($request->has('code') || $request->has('oauth_token'))) {
			return $this->getAuthorizationFirst($provider);
		}

		$user = $this->user->findUserOrCreate($this->getSocialUser($provider));
		$this->auth->login($user, true);

		return redirect($redirect);
	}

	private function getAuthorizationFirst($provider) {
		return $this->socialite->driver($provider)->redirect();
	}

	private function getSocialUser($provider) {
		return $this->socialite->driver($provider)->user();
	}
}