<?php

namespace Tests\Unit\Command;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class AddVariantIdToOrderItemsTest
 * @package Tests\Unit\Command
 * @coversDefaultClass \App\Console\Commands\AddVariantIdToOrderItems
 * @group OrderItems
 */
class AddVariantIdToOrderItemsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }
}
