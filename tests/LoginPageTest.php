<?php
use Learn\User;

class LoginPageTest extends TestCase
{
	public function testLoginPageLoadsCorrectly()
	{
		$this->call('GET', '/login');
		$this->assertResponseOk();
	}

	public function testLoginPageHasRightContent()
	{
		$this->visit('/login')
			->see('Learnit')
			->see('Signup')
			->see('Login');
	}
	public function testRegistrationPageHasNoHomeLink()
	{
		$this->visit('/login')
			->dontSeeLink('/logout');
	}

	public function testRegistrationPageHasNoLogoutLink()
	{
		$this->visit('/login')
			->dontSeeLink('/logout');
	}

	public function createUser()
	{
		User::create([
			'name' => 'johndoe',
			'email' => 'john@doe.com',
			'password'=> md5('password')
		]);
	}

	public function testRegisterPageWorksCorrectly()
	{
		$this->createUser();

		$this->visit('/login')
			->type('johndoe', 'email')
			->type('password', md5('password'))
			->press('login')
			->seePageIs('/dashboard');
	}
}