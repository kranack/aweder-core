<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\InventoryOptionGroup
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $inventory_id
 * @property string $name
 * @property int $title
 * @property int $required
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroup newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\InventoryOptionGroup onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroup query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroup whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroup whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InventoryOptionGroup withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\InventoryOptionGroup withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\InventoryOptionGroupItem[] $items
 * @property-read int|null $items_count
 */
class InventoryOptionGroup extends Model
{
    use SoftDeletes;

    public function items(): HasMany
    {
        return $this->hasMany(InventoryOptionGroupItem::class);
    }

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class);
    }
}
