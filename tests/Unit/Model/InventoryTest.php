<?php

namespace Tests\Unit\Model;

use App\Inventory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class InventoryTest
 * @package Tests\Unit\Model
 * @group Inventory
 * @coversDefaultClass \App\Inventory
 */
class InventoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function inventoryCreatedWithVariantsIsSaved(): void
    {
        $inventory = factory(Inventory::class)->state('variants')->create();

        $this->assertTrue($inventory->variants()->count() !== 0);
    }

    /**
     * @test
     */
    public function inventoryCreatedWithNoVariants(): void
    {
        $inventory = factory(Inventory::class)->create();

        $this->assertTrue($inventory->variants()->count() === 0);
    }
}
