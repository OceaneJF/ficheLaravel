<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_create_returns_view()
    {
        $response = $this->get(route('post.create'));

        $response->assertStatus(200);
        $response->assertViewIs('post.create');
    }

    public function test_posts_returns_home_view_with_posts()
    {
        // Préparation : insérer un post dans la table 'posts'
        DB::table('posts')->insert([
            'title' => 'Test title',
            'body' => 'Test body',
        ]);

        $response = $this->get(route('posts'));

        $response->assertStatus(200);
        $response->assertViewIs('home');
        $response->assertViewHas('posts');
        $response->assertSee('Test title');
    }

    public function test_create_sends_post_request_and_redirects_on_success()
    {
        // Simule une réponse HTTP réussie
        Http::fake([
            'https://jsonplaceholder.typicode.com/posts' => Http::response(['id' => 101], 201),
        ]);

        $data = [
            'title' => 'Test Post',
            'body' => 'Some content',
        ];

        $response = $this->post(route('post.create'), $data);

        $response->assertRedirect(route('posts'));
    }

    public function test_create_fails_and_redirects_back_on_error()
    {
        // Simule une réponse HTTP échouée
        Http::fake([
            'https://jsonplaceholder.typicode.com/posts' => Http::response(null, 500),
        ]);

        $data = [
            'title' => 'Test Post',
            'body' => 'Some content',
        ];

        $response = $this->from(route('post.create'))->post(route('post.create'), $data);

        $response->assertRedirect(route('post.create'));
        $response->assertSessionHasErrors('erreur');
        $response->assertSessionHasInput('body', 'Some content');
    }

    public function test_create_fails_validation()
    {
        // Données invalides (par exemple champ vide)
        $response = $this->post(route('post.create'), []);

        $response->assertSessionHasErrors(['title', 'body']);
    }
}
