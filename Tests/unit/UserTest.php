<?php

namespace App\Tests\Unit;

use App\Models\User;

class UserTest extends \PHPUnit\Framework\TestCase
{
    protected $user;


    public function setUp(): void
    {
        $this->user = new \App\Models\User;
    }



    public function testThatWeCanGetTheFirstName()
    {
        $this->user->setFirstName('Billy');
        $this->assertEquals($this->user->getFirstName(), 'Billy');
    }

    /**
     * @test
     */
    public function that_we_can_get_the_lastName()
    {
        $this->user->setLastName('Garret');
        $this->assertEquals($this->user->getLastName(), 'Garret');
    }

    /**
     * @test
     */
    public function that_full_name_is_returned()
    {
        $this->user->setFirstName('Billy');
        $this->user->setLastName('Garret');
        $this->assertEquals($this->user->getFullName(), 'Billy Garret');
    }

    /**
     * @test
     */
    public function first_name_and_last_name_are_trimmed()
    {
        $this->user->setFirstName(' Billy          ');
        $this->user->setLastName('          Garret ');

        $this->assertEquals($this->user->getFirstName(), 'Billy');
        $this->assertEquals($this->user->getLastName(), 'Garret');
    }

    /**
     * @test 
     */
    public function that_email_adress_can_be_set()
    {
        $this->user->setEmail('marc@aiden.eu');

        $this->assertEquals($this->user->getEmail(), 'marc@aiden.eu');
    }

    /**
     * @test
     */
    public function that_email_variables_contain_correct_values()
    {
        $this->user->setFirstName('Billy');
        $this->user->setLastName('Garret');
        $this->user->setEmail('billy@codecourse.com');

        $emailVariables = $this->user->getEmailVariables();

        $this->assertArrayHasKey('first_name', $emailVariables);
        $this->assertArrayHasKey('last_name', $emailVariables);
        $this->assertArrayHasKey('email', $emailVariables);

        $this->assertEquals($emailVariables['first_name'], 'Billy');
        $this->assertEquals($emailVariables['last_name'], 'Garret');
        $this->assertEquals($emailVariables['email'], 'billy@codecourse.com');
    }
}
