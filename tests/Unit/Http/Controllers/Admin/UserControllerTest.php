<?php

namespace Tests\Unit\Http\Controllers\Admin;

use App\Http\Controllers\Admin\UserController;
use App\Models\User;
use App\Repositories\User\UserRepoInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Mockery as m;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    const ACTIVE_STATUS = 1;
    const UNACTIVE_STATUS = 0;

    protected $users;
    protected $userRepo;
    protected $userController;

    /**
     * Method run before each test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->users = User::factory()->count(5)->make();
        $this->userRepo = m::mock(UserRepoInterface::class)->makePartial();
        $this->userController = new UserController($this->userRepo);
    }

    /**
     * Method run after each test
     */
    public function tearDown(): void
    {
        unset($this->users);
        unset($this->userRepo);
        unset($this->userController);
        parent::tearDown();
    }

    /**
     * Test method 'index' run successfully
     */
    public function testMethodIndexSuccess()
    {
        $this->userRepo->shouldReceive('getAllWithPaginate')->andReturn($this->users);

        $view = $this->userController->index();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.users.list', $view->getName());
        $this->assertArrayHasKey('users', $view->getData());
    }

    /**
     * Test method block user run successfully
     */
    public function testMethodBlockUserSuccess()
    {
        $this->userRepo->shouldReceive('blockUser')->andReturnTrue();

        $resposne = $this->userController->blockUser(3);

        $this->assertEquals(200, $resposne->getStatusCode());
        $this->assertArrayHasKey('block', (array)json_decode($resposne->getContent()));
    }

    /**
     * Test method block user got exception
     */
    public function testMethodBlockUserFailed()
    {
        $this->userRepo->shouldReceive('blockUser')->andThrow(new Exception());

        $resposne = $this->userController->blockUser(3);

        $this->assertEquals(500, $resposne->getStatusCode());
        $this->assertArrayHasKey('error', (array)json_decode($resposne->getContent()));
    }

    /**
     * Test method unblock user run successfully
     */
    public function testMethodUnblockUserSuccess()
    {
        $this->userRepo->shouldReceive('unblockUser')->andReturnTrue();

        $resposne = $this->userController->unblockUser(3);

        $this->assertEquals(200, $resposne->getStatusCode());
        $this->assertArrayHasKey('unblock', (array)json_decode($resposne->getContent()));
    }

    /**
     * Test method unblock user got exception
     */
    public function testMethodUnblockUserFailed()
    {
        $this->userRepo->shouldReceive('unblockUser')->andThrow(new Exception());

        $resposne = $this->userController->unblockUser(3);

        $this->assertEquals(500, $resposne->getStatusCode());
        $this->assertArrayHasKey('error', (array)json_decode($resposne->getContent()));
    }
}
