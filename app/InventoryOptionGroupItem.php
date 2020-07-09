<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\InventoryOptionGroupItem
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $inventory_option_group_id
 * @property string $name
 * @property int $price_modified
 * @property \Illuminate\Support\Carbon $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroupItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroupItem newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\InventoryOptionGroupItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroupItem query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroupItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroupItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroupItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroupItem
 * whereInventoryOptionGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroupItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroupItem wherePriceModified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\InventoryOptionGroupItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InventoryOptionGroupItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\InventoryOptionGroupItem withoutTrashed()
 * @mixin \Eloquent
 */
class InventoryOptionGroupItem extends Model
{
    use SoftDeletes;
}
