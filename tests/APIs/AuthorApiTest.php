<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Author;

class AuthorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_author()
    {
        $author = Author::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/authors', $author
        );

        $this->assertApiResponse($author);
    }

    /**
     * @test
     */
    public function test_read_author()
    {
        $author = Author::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/authors/'.$author->id
        );

        $this->assertApiResponse($author->toArray());
    }

    /**
     * @test
     */
    public function test_update_author()
    {
        $author = Author::factory()->create();
        $editedAuthor = Author::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/authors/'.$author->id,
            $editedAuthor
        );

        $this->assertApiResponse($editedAuthor);
    }

    /**
     * @test
     */
    public function test_delete_author()
    {
        $author = Author::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/authors/'.$author->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/authors/'.$author->id
        );

        $this->response->assertStatus(404);
    }
}
