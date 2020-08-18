<?php

namespace Tests\Unit\Repository;

use App\Contract\Repositories\InventoryVariantContract;
use App\Traits\HelperTrait;
use App\InventoryVariant;
use ErrorException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class InventoryVariantRepositoryTest
 * @package Tests\Unit\Repository
 * @group InventoryVariant
 * @coversDefaultClass
 */
class InventoryVariantRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use HelperTrait;

    /**
     * @var InventoryVariantContract $repository
     */
    protected InventoryVariantContract $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->app->make(InventoryVariantContract::class);
    }

    /**
     * @test
     */
    public function canAddVariantToInventory(): void
    {
        $inventoryItem = $this->createAndReturnInventoryItem(['title' => 'Laptop']);

        $this->assertDatabaseHas('inventories', [
            'title' => 'Laptop',
        ]);

        $inventoryVariantName = 'Electric Blue Keyboard';

        $inventoryVariant = $this->createAndReturnInventoryVariant(
            ['name' => $inventoryVariantName]
        );

        $this->repository->addVariantToInventoryItem($inventoryItem, $inventoryVariant);

        $this->assertCount(1, $inventoryItem->variants()->get());
        $this->assertEquals($inventoryVariantName, $inventoryItem->variants()->first()->name);
    }

    /**
     * @test
     */
    public function canRemoveVariantFromInventory(): void
    {
        $inventoryItem = $this->createAndReturnInventoryItem(['title' => 'Laptop']);

        $this->assertDatabaseHas('inventories', [
            'title' => 'Laptop',
        ]);

        $inventoryVariantName = 'Electric Blue Keyboard';

        $inventoryVariant = $this->createAndReturnInventoryVariant(
            ['name' => $inventoryVariantName]
        );

        $this->repository->addVariantToInventoryItem($inventoryItem, $inventoryVariant);

        $this->assertCount(1, $inventoryItem->variants()->get());

        $inventoryVariant->delete();

        $this->assertCount(0, $inventoryItem->variants()->get());
        $this->assertSoftDeleted($inventoryVariant);
    }
}
