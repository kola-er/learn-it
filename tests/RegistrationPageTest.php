<?php

class RegistrationPageTest extends TestCase
{
	public function testRegistrationPageLoadsCorrectly()
	{
		$this->call('GET', '/register');
		$this->assertResponseOk();
	}

	public function testRegistrationPageHasRightContent()
	{
		$this->visit('/register')
			->see('Learnit')
			->see('Signup')
			->see('Login');
	}
	public function testRegistrationPageHasNoHomeLink()
	{
		$this->visit('/register')
			->dontSeeLink('/logout');
	}

	public function testRegistrationPageHasNoLogoutLink()
	{
		$this->visit('/register')
			->dontSeeLink('/logout');
	}

	public function testRegisterPageWorksCorrectly()
	{
		$this->visit('/register')
			->type('johndoe', 'username')
			->type('john@doe.com', 'email')
			->type('password', 'password')
			->type('password','password_confirmation')
			->press('signup')
			->seePageIs('/dashboard')
			->seeInDatabase('users',['username' =>'johndoe']);
	}
}