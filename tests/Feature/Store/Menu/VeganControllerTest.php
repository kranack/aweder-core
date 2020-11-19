<?php

namespace Tests\Feature\Store\Menu;

use App\Merchant;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class VeganControllerTest
 * @package Tests\Feature\Store\Menu
 * @group Store
 */
class VeganControllerTest extends TestCase
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
            'is_vegan' => 0
        ]);

        $response = $this->get('admin/inventory/vegan/' . $inventory->id);
        $response->assertRedirect('admin/inventory');

        $this->assertDatabaseHas('inventories', [
            'id' => $inventory->id,
            'is_vegan' => 1
        ]);

        $response = $this->get('admin/inventory/vegan/' . $inventory->id);
        $response->assertRedirect('admin/inventory');

        $this->assertDatabaseHas('inventories', [
            'id' => $inventory->id,
            'is_vegan' => 0
        ]);
    }
}
