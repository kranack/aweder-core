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
}
