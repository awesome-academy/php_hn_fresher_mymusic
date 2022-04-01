<?php

namespace Tests\Unit\Http\Controllers\Admin;

use App\Http\Controllers\Admin\DashboardController;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use Exception;
use Illuminate\Contracts\View\View;
use Mockery;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    protected $statistical;
    protected $songRepo;
    protected $dashboardController;

    /**
     * This method run before each test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->statistical = config('admin.init_statistical');
        $this->songRepo = Mockery::mock(SongRepositoryInterface::class)->makePartial();
        $this->dashboardController = new DashboardController($this->songRepo);
    }

    /**
     * This method run after each test
     */
    public function tearDown(): void
    {
        unset($this->statistical);
        unset($this->songRepo);
        unset($this->dashboardController);
        parent::tearDown();
    }

    /**
     * Test method statisticalSongsInYear run successfully
     */
    public function testStatisticalSongsInYearSuccess()
    {
        $this->songRepo->shouldReceive('statisticalSong')->andReturn($this->statistical);

        $response = $this->dashboardController->statisticalSongsInYear(2022);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('songs', (array)$response->getData());
    }

    /**
     * Test method statisticalSongsInYear run failed
     */
    public function testStatisticalSongsInYearFailed()
    {
        $this->songRepo->shouldReceive('statisticalSong')->andThrow(new Exception());

        $response = $this->dashboardController->statisticalSongsInYear(2022);

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertArrayHasKey('error', (array)$response->getData());
    }

    /**
     * Test method showDashdoardScreen run successfully
     */
    public function testShowDashdoardScreen()
    {
        $view = $this->dashboardController->showDashdoardScreen();

        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.dashboard', $view->getName());
    }
}
