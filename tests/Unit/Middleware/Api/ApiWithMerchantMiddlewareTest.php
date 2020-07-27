<?php

namespace Tests\Unit\Middleware\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class HasOrderGonePastStageTest
 * @package Tests\Unit\Middleware
 * @coversDefaultClass \App\Http\Middleware\Api\ApiWithMerchant
 * @group Middleware
 */
class ApiWithMerchantMiddlewareTest extends TestCase
{
    use RefreshDatabase;
}
