<?php

namespace Tests\Feature\Api;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class AddToOrder
 * @package Tests\Feature\Api
 * @group API
 */
class AddToOrder extends TestCase
{
    use RefreshDatabase;
    // create an order
    // assert order has no inventory
    // create inventory
    // create options
    // create variant
    // use api endpoint to add to order
    // assert added
}
