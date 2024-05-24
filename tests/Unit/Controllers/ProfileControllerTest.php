<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\ProfileController;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Mocking the user object
        $user = Mockery::mock(\stdClass::class);
        $user->fill = function ($data) use ($user) {
            foreach ($data as $key => $value) {
                $user->{$key} = $value;
            }
        };
        // Mocking Auth::user() to return the mocked user
        \Auth::shouldReceive('user')->andReturn($user);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        // Closing mockery
        Mockery::close();
    }

    public function testIndexMethodReturnsView()
    {
        // Mocking request
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('user')->andReturn(new \stdClass());

        // Creating controller instance
        $controller = new ProfileController();

        // Calling index method
        $response = $controller->index($request);

        // Asserting response type
        $this->assertInstanceOf(View::class, $response);
    }

    public function testEditMethodReturnsView()
    {
        // Mocking request
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('user')->andReturn(new \stdClass());

        // Creating controller instance
        $controller = new ProfileController();

        // Calling edit method
        $response = $controller->edit($request);

        // Asserting response type
        $this->assertInstanceOf(View::class, $response);
    }}
