<?php

namespace App\Contract\Repositories;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface OrderItemContract
 * @package App\Contract\Repositories
 */
interface OrderItemContract
{
    public function getOrderItemsWithMissingVariantIds(): ?Collection;
}
