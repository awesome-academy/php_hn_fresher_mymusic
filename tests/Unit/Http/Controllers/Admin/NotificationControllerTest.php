<?php

namespace Tests\Unit\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Admin\NotificationController;
use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class NotificationControllerTest extends TestCase
{
    protected $helpers;
    protected $request;
    protected $controller;
    protected $notification;
    protected $notifications;

    /**
     * This method is called before each test.
    */
    public function setup(): void
    {
        parent::setUp();
        $this->notifications = Notification::factory()->count(5)->make();
        $this->notification = Notification::factory()->make();
        $this->helpers = Mockery::mock('alias:' . Helpers::class);
        $this->request = Mockery::mock(Request::class)->makePartial();
        $this->controller = new NotificationController();
    }

    /**
     * This method is called after each test.
    */
    public function tearDown(): void
    {
        unset($this->request);
        unset($this->controller);
        unset($this->helpers);
        unset($this->notification);
        unset($this->notifications);
        parent::tearDown();
    }
    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
    */
    public function testMarkAsReadMethodSuccessfully()
    {
        $this->request->shouldReceive('only')->andReturn($this->notification->id);
        $this->helpers->shouldReceive('findNotificationById')->andReturn($this->notification);
        $this->helpers->shouldReceive('markAsRead');

        $response = $this->controller->markAsRead($this->request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('markAsRead', (array) json_decode($response->getContent()));
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
    */
    public function testMarkAsReadMethodFailed()
    {
        $this->request->shouldReceive('only')->andReturn($this->notification->id);
        $this->helpers->shouldReceive('findNotificationById')->andReturn($this->notification);
        $this->helpers->shouldReceive('markAsRead')->andThrow(new Exception());

        $response = $this->controller->markAsRead($this->request);

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertArrayHasKey('error', (array) json_decode($response->getContent()));
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
    */
    public function testMarkAsReadAllMethodSuccessfully()
    {
        $this->helpers->shouldReceive('getAllNotification')->andReturn($this->notifications);
        $this->helpers->shouldReceive('markAsRead');

        $response = $this->controller->markAsReadAll($this->request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('markAsReadAll', (array) json_decode($response->getContent()));
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
    */
    public function testMarkAsReadAllMethodFailed()
    {
        $this->helpers->shouldReceive('getAllNotification')->andReturn($this->notifications);
        $this->helpers->shouldReceive('markAsRead')->andThrow(new Exception());

        $response = $this->controller->markAsReadAll($this->request);

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertArrayHasKey('error', (array) json_decode($response->getContent()));
    }
}
