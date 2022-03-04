<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiMessagesTest extends TestCase
{


    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_ApiMessagesList()
    {
        $response = $this->get("/api/chats/1/messages");
        $response->assertStatus(200);
    }

    public function test_ApiMessagesPost()
    {
        $response = $this->post('/api/chats/1/messages',
            [
                'message' => "Adios",
                'chat_id' => 4,
                'author_id' => 1
            ]
        );
        $response->assertStatus(200);

        $content = $response->getContent();
        $json = json_decode($content);
        return $json->id;
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @depends  test_ApiMessagesPost
     */

    public function test_ApiMessagesGet($id)
    {
        $response = $this->get("/api/chats/1/messages/{$id}");
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @depends  test_ApiMessagesPost
     */

    public function test_ApiMessagesUpdate($id)
    {
        $response = $this->put("/api/chats/2/messages/{$id}", [
            'message' => "Hola",
            'chat_id' => 1,
            'author_id' => 1,
        ]);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @depends  test_ApiMessagesPost
     */
    public function test_ApiMessagesDelete($id)
    {
        $response = $this->delete("/api/chats/1/messages/{$id}");
        $response->assertStatus(200);
    }

}
