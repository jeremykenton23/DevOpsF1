<?php

namespace Tests\Feature;

use Tests\TestCase;

class InfrastructureTest extends TestCase
{
    public function testLoginPageIsAccessible()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testLoginPageContainsLoginButton()
    {
        $response = $this->get('/login');

        $response->assertSee('Log in');
    }

    public function testLoginPageContainsRememberMeCheckbox()
    {
        $response = $this->get('/login');

        $response->assertSee('<input id="remember_me"', false);
    }

    public function testLoginPageContainsForgotPasswordLink()
    {
        $response = $this->get('/login');

        $response->assertSee('Forgot your password?');
    }
}
