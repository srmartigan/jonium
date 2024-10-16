<?php

namespace Unit\Routing;

use Core\Exceptions\RouterException;
use Core\Routing\Route;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        define('ROOT_PATH', __DIR__ . '/../../..');
        Route::loadRoutes();
    }

    public function testLoadRoutes(): void
    {
        $routes = Route::getRoutes();

        $this->assertIsArray($routes);
        $this->assertNotEmpty($routes);
    }

    public function testGetRoutesReturnsArrayOfRoutes(): void
    {
        $routes = Route::getRoutes();

        $this->assertIsArray($routes);
    }

    public function testGetRoutesReturnsNonEmptyArray(): void
    {
        $routes = Route::getRoutes();

        $this->assertNotEmpty($routes);
    }

}



