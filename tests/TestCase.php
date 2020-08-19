<?php

namespace Tests;

use App\Category;
use App\Inventory;
use App\InventoryOptionGroup;
use App\InventoryOptionGroupItem;
use App\InventoryVariant;
use App\Merchant;
use App\NormalOpeningHour;
use App\Order;
use App\OrderItem;
use App\Provider;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;

    /**
     * creates a new merchant in the syst,
     * @param array $merchantOverrideData
     * @return Merchant
     */
    protected function createAndReturnMerchant(array $merchantOverrideData = []): Merchant
    {
        $merchant = factory(Merchant::class)
            ->create($merchantOverrideData);
        $merchant->each(function (Merchant $loopedMerchant) {
            $loopedMerchant->openingHours()->save(factory(NormalOpeningHour::class)->make());
            $loopedMerchant->categories()->save(factory(Category::class)->make());
            $loopedMerchant->inventories()->save(factory(Inventory::class)->make());
        });

        return $merchant;
    }

    /**
     * @param array $inventoryOverrideData
     * @return Inventory
     */
    protected function createAndReturnInventoryItem(array $inventoryOverrideData = []): Inventory
    {
        return factory(Inventory::class)->create($inventoryOverrideData);
    }

    /**
     * @param array $variantOverrideData
     * @return InventoryVariant
     */
    protected function createAndReturnInventoryVariant(array $variantOverrideData = []): InventoryVariant
    {
        return factory(InventoryVariant::class)->create($variantOverrideData);
    }

    /**
     * @param array $optionGroupOverrideData
     * @return InventoryOptionGroup
     */
    protected function createAndReturnInventoryOptionGroup(array $optionGroupOverrideData = []): InventoryOptionGroup
    {
        return factory(InventoryOptionGroup::class)->create($optionGroupOverrideData);
    }

    /**
     * @param array $optionGroupItemOverrideData
     * @return InventoryOptionGroupItem
     */
    protected function createAndReturnInventoryOptionGroupItem(array $optionGroupItemOverrideData = []): InventoryOptionGroupItem
    {
        return factory(InventoryOptionGroupItem::class)->create($optionGroupItemOverrideData);
    }

    /**
     * @param string $status
     * @param array $orderOverrideData
     * @return Order
     */
    public function createAndReturnOrderForStatus(string $status, array $orderOverrideData = []): Order
    {
        return factory(Order::class)->state($status)->create($orderOverrideData);
    }

    /**
     * @param array $orderItemOverrideData
     * @return OrderItem
     */
    public function createAndReturnOrderItem(array $orderItemOverrideData = []): OrderItem
    {
        return factory(OrderItem::class)->create($orderItemOverrideData);
    }

    /**
     * @param array $overrideData
     * @return Category
     */
    public function createAndReturnCategory(array $overrideData = []): Category
    {
        return factory(Category::class)->create($overrideData);
    }

    /**
     * @param array $overrideData
     * @return NormalOpeningHour
     */
    public function createAndReturnOpeningHoursForMerchant(array $overrideData = []): NormalOpeningHour
    {
        return factory(NormalOpeningHour::class)->create($overrideData);
    }

    /**
     * @param array $overrideData
     * @return Provider
     */
    public function createAndReturnPaymentProvider(array $overrideData = []): Provider
    {
        return factory(Provider::class)->create($overrideData);
    }

    protected function createCompleteRegistrationDetails(): array
    {
        $password = $this->faker->password(20);

        return [
            'email' => $this->faker->safeEmail,
            'password' => $password,
            'password-confirmed' => $password,
            'name' => $this->faker->word(),
            'url-slug' => 'asdasd',
            'collection_type' => 'both',
            'api-key' => '123456',
            'address-name-number' => $this->faker->numberBetween(1, 100),
            'address-street' => $this->faker->streetName,
            'address-city' => $this->faker->city,
            'address-postcode' => $this->faker->postcode,
            'customer-phone-number' => $this->faker->phoneNumber,
            'delivery_cost' => 599,
            'delivery_radius' => 6,
        ];
    }
}
