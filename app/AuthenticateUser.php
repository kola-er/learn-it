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

	private $auth;
	private $user;
	private $socialite;

	/**
	 * @param UserRepository $user
	 * @param Socialite $socialite
	 * @param Guard $auth
	 */
	public function __construct(UserRepository $user, Socialite $socialite, Guard $auth) {
		$this->auth = $auth;
		$this->user = $user;
		$this->socialite = $socialite;
	}

	/**
	 * Handle Login and redirection of a social-authenticated user
	 *
	 * @param $request Social provider request response for a user
	 * @param $provider Social provider's name
	 * @param $redirect Redirection path
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function execute($request, $provider, $redirect) {

		if (! ($request->has('code') || $request->has('oauth_token'))) {
			return $this->getAuthorizationFirst($provider);
		}

		$user = $this->user->findUserOrCreate($this->getSocialUser($provider), $provider);

		$this->auth->login($user, true);

		return redirect($redirect);
	}

	/**
	 * Handle sending of request of a user's info to a social provider
	 *
	 * @param $provider Social provider's name
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	private function getAuthorizationFirst($provider) {
		return $this->socialite->driver($provider)->redirect();
	}

	/**
	 * Handle reception of a user's info request from a social provider
	 *
	 * @param $provider Social provider's name
	 * @return \Laravel\Socialite\Contracts\User
	 */
	private function getSocialUser($provider) {
		return $this->socialite->driver($provider)->user();
	}
}