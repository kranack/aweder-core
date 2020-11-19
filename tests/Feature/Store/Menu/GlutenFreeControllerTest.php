<?php

namespace Tests\Feature\Store\Menu;

use App\Merchant;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class GlutenFreeControllerTest
 * @package Tests\Feature\Store\Menu
 * @group Store
 */
class GlutenFreeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function canToggleAllergy(): void
    {
        $user = factory(User::class)->create();
        $merchant = factory(Merchant::class)->create(['registration_stage' => 0]);
        $user->merchants()->attach($merchant->id);
        $this->actingAs($user);

        $inventory = $this->createAndReturnInventoryItem();

        $this->assertDatabaseHas('inventories', [
            'id' => $inventory->id,
            'is_gluten_free' => 0
        ]);

        $response = $this->get('admin/inventory/gluten-free/' . $inventory->id);
        $response->assertRedirect('admin/inventory');

        $this->assertDatabaseHas('inventories', [
            'id' => $inventory->id,
            'is_gluten_free' => 1
        ]);

        $response = $this->get('admin/inventory/gluten-free/' . $inventory->id);
        $response->assertRedirect('admin/inventory');

        $this->assertDatabaseHas('inventories', [
            'id' => $inventory->id,
            'is_gluten_free' => 0
        ]);
    }
}
