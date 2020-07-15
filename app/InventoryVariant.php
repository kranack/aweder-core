<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\InventoryVariant
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $inventory_id
 * @property string $name
 * @property int $price
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryVariant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryVariant newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\InventoryVariant onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryVariant query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryVariant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryVariant whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryVariant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryVariant whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryVariant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryVariant wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryVariant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InventoryVariant withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\InventoryVariant withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Inventory $inventory
 */
class InventoryVariant extends Model
{
    use SoftDeletes;

    public $fillable = [
        'name',
        'price'
    ];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}
