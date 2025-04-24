<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** Test */
    public function user_can_create_rooms_with_validate_data()
    {

        $playload = [
            'name' => 'La rentré academique 25/26',
            'description' => 'lorem upsum ceci est un teste pour voir si ma création de room fonctionne bien',
            'thumbnail' => 'https://picsum.photos/200/300?random=1'
        ];

        $response = $this->postJson('api/cre', $payload);

        $result = $response->assertStatus(200)
                            ->assertJsonStructure([
                                'success',
                                'data' => [
                                    'name',
                                    'description',
                                    'thumbnail',
                                    'created_at',
                                    'updated_at'
                                ]
                            ]);
        
        $this->assertDatabaseHas('rooms', [
            'name' => 'La rentré academique 25/26',
            'description' => 'lorem upsum ceci est un teste pour voir si ma création de room fonctionne bien',
            'thumbnail' => 'https://picsum.photos/200/300?random=1'
        ]);
    }



    public function user_can_not_creat_room_with_invalid_data()
    {
        $playload = [
            'name' => '',
            'description' => 'Lorem ipsum data failled',
            'thumbnail' => 'https://picsum.photos/200/300?random=3'
        ];

        $response = $this->postJson('api/living-room', $playload);

        $result = $response->assertStatus(422)
                            ->assertJson([
                                'success' => false,
                                'message' => 'Data invalid'
                            ]);
        

    }


    public function user_can_read_all_room()
    {
        $playload = [];
    }
}
