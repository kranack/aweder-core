<?php

namespace App;

use App\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\OrderItem
 *
 * @property int $id
 * @property int $order_id
 * @property int $quantity
 * @property int $price The price is in pence
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $inventory_id
 * @property-read \App\Inventory $inventory
 * @property-read \App\Order $order
 * @method static Builder|\App\OrderItem newModelQuery()
 * @method static Builder|\App\OrderItem newQuery()
 * @method static Builder|\App\OrderItem query()
 * @method static Builder|\App\OrderItem whereCreatedAt($value)
 * @method static Builder|\App\OrderItem whereId($value)
 * @method static Builder|\App\OrderItem whereInventoryId($value)
 * @method static Builder|\App\OrderItem whereOrderId($value)
 * @method static Builder|\App\OrderItem wherePrice($value)
 * @method static Builder|\App\OrderItem whereQuantity($value)
 * @method static Builder|\App\OrderItem whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Inventory $orderInventory
 * @property-read string $formatted_u_k_price
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItem multipleQuantity()
 * @property int|null $variant_id
 * @property string|null $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\InventoryOptionGroupItem[] $inventoryOptions
 * @property-read int|null $inventory_options_count
 * @property-read \App\InventoryVariant $inventoryVariant
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\OrderItem whereVariantId($value)
 */
class OrderItem extends Model
{
    use HelperTrait;

    protected $fillable = [
        'order_id',
        'variant_id',
        'quantity',
        'price',
        'inventory_id',
    ];

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function inventoryVariant(): HasOne
    {
        return $this->hasOne(InventoryVariant::class, 'id', 'variant_id');
    }

    /**
     * @return BelongsTo
     */
    public function orderInventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'inventory_id')->withTrashed();
    }

    /**
     * @return BelongsToMany
     */
    public function inventoryOptions(): BelongsToMany
    {
        return $this->belongsToMany(InventoryOptionGroupItem::class);
    }

    /**
     * returns a overall price for the item devided by quantity
     * @return string
     */
    public function getOrderItemPriceByQuantity(): string
    {
        return number_format((($this->price * $this->quantity) / 100), 2);
    }

    /**
     * Return only items with more than one quantity
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeMultipleQuantity($query): Builder
    {
        return $query->where('quantity', '>', 1);
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order()->first();
    }

    /**
     * @return Merchant
     */
    public function getMerchant(): ?Merchant
    {
        return $this->getOrder()->merchant()->first();
    }
}
