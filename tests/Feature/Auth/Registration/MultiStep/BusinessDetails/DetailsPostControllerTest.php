<?php

namespace Tests\Feature\Auth\Registration\MultiStep\BusinessDetails;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class DetailsPostControllerTest
 * @package Tests\Feature\Auth\Registration\MultiStep\BusinessDetails
 * @coversDefaultClass \App\Http\Controllers\Auth\Registration\MultiStep\BusinessDetails\DetailsPost
 * @group MultiStageRegistration
 */
class DetailsPostControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     *
     */
    public function user_cant_access_page_without_being_authorised(): void
    {
        $businessDetails = [
            'email' => $this->faker->safeEmail
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     *
     */
    public function user_can_access_as_authed_user_but_redirected_back_when_missing_details(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $businessDetails = [
            'name' => $this->faker->safeEmail,
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.business-details'));

        $response->assertSessionHasErrors('url_slug');
    }

    /**
     * @test
     *
     */
    public function user_can_submit_merchant_with_full_details(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $businessDetails = [
            'name' => $this->faker->safeEmail,
            'url_slug' => $this->faker->slug,
            'collection_types' => ['collection'],
            'description' => $this->faker->words(10, true),
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.contact-details'));
    }

    /**
     * @test
     */
    public function user_cant_submit_delivery_choice_without_delivery_radius(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $businessDetails = [
            'name' => $this->faker->safeEmail,
            'url_slug' => $this->faker->slug,
            'collection_types' => ['delivery'],
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.business-details'));

        $response->assertSessionHasErrors('delivery_radius');
    }

    /**
     * @test
     */
    public function user_cant_submit_delivery_choice_without_delivery_cost(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $businessDetails = [
            'name' => $this->faker->safeEmail,
            'url_slug' => $this->faker->slug,
            'collection_types' => ['delivery'],
            'delivery_radius' => 5
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.business-details'));

        $response->assertSessionHasErrors('delivery_cost');
    }

    /**
     * @test
     */
    public function user_can_submit_delivery_choice_with_all_delivery_options_as_float_cost(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $name = $this->faker->name;

        $slug = $this->faker->slug;

        $description = $this->faker->words(10, true);

        $businessDetails = [
            'name' => $name,
            'url_slug' => $slug,
            'collection_types' => ['delivery'],
            'delivery_radius' => 5,
            'delivery_cost' => '5.99',
            'description' => $description,
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.contact-details'));

        $this->assertDatabaseHas(
            'merchants',
            [
                'url_slug' => $slug,
                'name' => $name,
                'allow_delivery' => 1,
                'allow_collection' => 0,
                'delivery_cost' => 599,
                'delivery_radius' => 5,
                'description' => $description,
                'registration_stage' => 3,
            ]
        );
    }


    /**
     * @test
     */
    public function user_can_submit_both_choice_with_all_delivery_options_as_float_cost(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $name = $this->faker->name;

        $slug = $this->faker->slug;

        $description = $this->faker->words(10, true);

        $businessDetails = [
            'name' => $name,
            'url_slug' => $slug,
            'collection_types' => ['collection', 'delivery'],
            'delivery_radius' => 5,
            'delivery_cost' => '5.99',
            'description' => $description,
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.contact-details'));

        $this->assertDatabaseHas(
            'merchants',
            [
                'url_slug' => $slug,
                'name' => $name,
                'description' => $description,
                'allow_delivery' => 1,
                'allow_collection' => 1,
                'delivery_cost' => 599,
                'delivery_radius' => 5,
                'registration_stage' => 3,
            ]
        );
    }

    /**
     * @test
     */
    public function user_cant_submi_with_an_option_that_doesnt_exist_as_float_cost(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $name = $this->faker->name;

        $slug = $this->faker->slug;

        $description = $this->faker->words(10, true);

        $businessDetails = [
            'name' => $name,
            'url_slug' => $slug,
            'collection_types' => ['sunny'],
            'delivery_radius' => 5,
            'delivery_cost' => '5.99',
            'description' => $description,
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.business-details'));

        $response->assertSessionHasErrors('collection_types.*');
    }

    /**
     * @test
     */
    public function user_cant_submi_with_an_option_that_doesnt_exist_and_one_that_does_as_float_cost(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $name = $this->faker->name;

        $slug = $this->faker->slug;

        $description = $this->faker->words(10, true);

        $businessDetails = [
            'name' => $name,
            'url_slug' => $slug,
            'collection_types' => ['sunny', 'collection'],
            'delivery_radius' => 5,
            'delivery_cost' => '5.99',
            'description' => $description,
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.business-details'));

        $response->assertSessionHasErrors('collection_types.*');
    }

    /**
     * @test
     */
    public function user_can_submit_both_choice_with_all_delivery_options_and_table_as_float_cost(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $name = $this->faker->name;

        $slug = $this->faker->slug;

        $description = $this->faker->words(10, true);

        $businessDetails = [
            'name' => $name,
            'url_slug' => $slug,
            'collection_types' => ['collection', 'delivery', 'table'],
            'delivery_radius' => 5,
            'delivery_cost' => '5.99',
            'description' => $description,
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.contact-details'));

        $this->assertDatabaseHas(
            'merchants',
            [
                'url_slug' => $slug,
                'name' => $name,
                'description' => $description,
                'allow_delivery' => 1,
                'allow_collection' => 1,
                'allow_table_service' => 1,
                'delivery_cost' => 599,
                'delivery_radius' => 5,
                'registration_stage' => 3,
            ]
        );
    }

    /**
     * @test
     */
    public function user_cant_submit_both_choice_with_radius_missing(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $name = $this->faker->name;

        $slug = $this->faker->slug;

        $businessDetails = [
            'name' => $name,
            'url_slug' => $slug,
            'collection_types' => ['collection', 'delivery'],
            'delivery_cost' => '5.99',
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.business-details'));

        $response->assertSessionHasErrors('delivery_radius');
    }

    /**
     * @test
     */
    public function user_cant_submit_both_choice_with_cost_missing(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $name = $this->faker->name;

        $slug = $this->faker->slug;

        $businessDetails = [
            'name' => $name,
            'url_slug' => $slug,
            'collection_types' => ['collection', 'delivery'],
            'delivery_radius' => 5,
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.business-details'));

        $response->assertSessionHasErrors('delivery_cost');
    }

    /**
     * @test
     */
    public function user_cant_submit_with_more_than_one_hundred_and_forty_word_description(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $name = $this->faker->name;

        $slug = $this->faker->slug;

        $businessDetails = [
            'name' => $name,
            'url_slug' => $slug,
            'collection_types' => ['collection'],
            'description' => $this->faker->words(140, true),
        ];

        $response = $this->from(route('register.business-details'))
            ->post(route('register.business-details.post'), $businessDetails);

        $response->assertRedirect(route('register.business-details'));

        $response->assertSessionHasErrors('description');
    }
}
