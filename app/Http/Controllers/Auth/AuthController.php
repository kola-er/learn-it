<?php
namespace Learn\Http\Controllers\Auth;

use Validator;
use Learn\User;
use Learn\Repositories\UserRepository;
use Learn\AuthenticateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Learn\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	protected $loginPath = 'login';
	protected $registerPath = 'register';
	protected $redirectPath = 'dashboard';
	protected $redirectAfterLogout = '/';
	protected $userRepository;

	/**
	 * Create a new authentication controller instance.
	 */
	public function __construct(UserRepository $userRepository)
	{
		$this->middleware('guest', ['except' => 'getLogout']);
		$this->userRepository = $userRepository;
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'username' => 'required|max:255|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:8|',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		return User::create([
			'username' => $data['username'],
			'email' => $data['email'],
			'password' => md5($data['password']),
		]);
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		$validator = $this->validator($request->all());

		if ($validator->fails()) {
			return redirect($this->registerPath)->withErrors($validator);
		}

		$user = $this->create($request->all());

		$this->userRepository->setUserAvatar($user);

		Auth::login($user, true);

		return redirect($this->redirectPath());
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$field = filter_var($request['email'], FILTER_VALIDATE_EMAIL) ? "email" : "username";
		$user = User::where($field, $request['email'])->first();

		if ($user->password == md5($request['password'])) {
			$request->has('remember') ? Auth::login($user, true) : Auth::login($user);

			return redirect('dashboard');
		}

		return redirect('login');
	}

	/**
	 * Handle a social registration/login request to the application
	 *
	 * @param AuthenticateUser $authenticateUser
	 * @param Request $request
	 * @param $provider Social authentication provider
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function socialLogin(AuthenticateUser $authenticateUser, Request $request, $provider)
	{
		return $authenticateUser->execute($request, $provider, $this->redirectPath());
	}
}
