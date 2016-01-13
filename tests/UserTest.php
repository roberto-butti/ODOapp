<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
  protected $faker;

  public function setUp()
  {
    parent::setUp(); // Don't forget this!
    $this->faker = Faker\Factory::create();
    //$this->prepareForTests();
  }

  /**
   * A basic test example.
   *
   * @return void
   */
  public function testExample()
  {
      $this->assertTrue(true);
  }

  public function testNewUserRegistration()
  {
    $this->visit('/register')
       ->type($this->faker->name, 'name')
       ->type($this->faker->email, 'email')
       ->type('mypassword', 'password')
       ->type('mypassword', 'password_confirmation')

       //->check('terms')
       ->press('Register')
       ->seePageIs('/clips');
  }

  public function testGuestUser()
  {
    $this->visit('/clips')
      ->seePageIs('/login');
  }



  public function testLogoutUser()
  {
    $this->visit('/logout')
       ->seePageIs('/');
  }

}
