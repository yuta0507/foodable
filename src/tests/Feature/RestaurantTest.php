<?php

namespace Tests\Feature;

use App\Enums\TakeawayFlag;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RestaurantTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test to show the index page
     */
    public function testShowIndexPage()
    {
        $this->login();

        $this->assertAuthenticatedAs($this->getLoginUser());

        $response = $this->get('/restaurant');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Manage your favorites');
    }

    /**
     * Test to show the registration form
     */
    public function testShowRegistrationForm()
    {
        $this->login();

        $this->assertAuthenticatedAs($this->getLoginUser());

        $response = $this->get('/restaurant/create');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Create your favorite');
    }

    /**
     * Test to register a new restaurant
     */
    public function testRegister()
    {
        $this->login();

        $this->assertAuthenticatedAs($this->getLoginUser());

        $data = [
            'user_id' => $this->getLoginUser()->id,
            'name' => 'test restaurant',
            'genre' => 'sushi',
            'area' => 'Tokyo',
            'url' => 'url',
            'takeaway_flag' => TakeawayFlag::Possible->value,
            'user_review' => '4.5',
            'google_review' => '4.3',
        ];

        $response = $this->post(route('restaurant.store'), $data);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/restaurant');

        $this->assertDatabaseHas('restaurants', $data);
    }

    /**
     * Test to show the edit form
     */
    public function testShowEditForm()
    {
        $this->login();

        $this->assertAuthenticatedAs($this->getLoginUser());

        $restaurant = $this->createRestaurant();

        $response = $this->get("restaurant/{$restaurant->id}/edit");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee("Edit {$restaurant->name}");
    }

    /**
     * Test to update the restaurant
     */
    public function testUpdate()
    {
        $this->login();

        $this->assertAuthenticatedAs($this->getLoginUser());

        $restaurant = $this->createRestaurant();

        $data = [
            'user_id' => $this->getLoginUser()->id,
            'name' => 'test restaurant',
            'genre' => 'sushi',
            'area' => 'Tokyo',
            'url' => 'url',
            'takeaway_flag' => TakeawayFlag::Possible->value,
            'user_review' => '4.5',
            'google_review' => '4.3',
        ];

        $response = $this->patch(route('restaurant.update', $restaurant->id), $data);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/restaurant');

        $this->assertDatabaseHas('restaurants', $data);
    }

    /**
     * Test to delete the restaurant
     */
    public function testDelete()
    {
        $this->login();

        $this->assertAuthenticatedAs($this->getLoginUser());

        $restaurant = $this->createRestaurant();

        $response = $this->delete(route('restaurant.destroy', $restaurant->id));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/restaurant');

        $this->assertDatabaseMissing('restaurants', ['id' => $restaurant->id]);
    }

    /**
     * Create new restaurant
     *
     * @return App\Models\Restaurant
     */
    private function createRestaurant(): Restaurant
    {
        return Restaurant::create([
            'user_id' => $this->getLoginUser()->id,
            'name' => fake()->name(),
            'genre' => fake()->name(),
            'area' => fake()->name(),
            'url' => fake()->url(),
            'takeaway_flag' => fake()->numberBetween(0, 2),
            'user_review' => fake()->numberBetween(0, 5),
            'google_review' => fake()->numberBetween(0, 5),
        ]);
    }
}
