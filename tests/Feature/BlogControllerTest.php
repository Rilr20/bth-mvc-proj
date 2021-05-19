<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use  Illuminate\Foundation\Testing\Concerns\ImpersonatesUsers;
Use App\Models\Blog;
use App\Models\User;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetBlogRoute()
    {
        $response = $this->get("/blog");

        $response->assertStatus(200);
        $response->assertViewIs('blog.blog');
    }
    public function testGetBlogAdminRoute()
    {
        $user = new User([
            'name' => 'doe'
        ]);
        $this->be($user);
        $this->actingAs($user)
            ->get('/blog/admin')
            ->assertViewIs('blog.admin');

        // $response->assertViewIs('login.login');
    }
    public function testGetBlogCreateRoute()
    {
        $user = new User([
            'name' => 'doe'
        ]);
        $this->be($user);
        $this->actingAs($user)
            ->get('/blog/create')
            ->assertViewIs('blog.create');

        // $response->assertViewIs('login.login');
    }
    public function testGetRouteShowNone()
    {
        $response = $this->get("/blog/none/");
        $response->assertViewIs('blog.none');
        // $response->assertStatus(200);
        // $this->markTestIncomplete();

    }
    public function testGetEditRoute()
    {
        $user = new User([
            'name' => 'doe'
        ]);
        $this->be($user);
        $this->actingAs($user)
            ->get('/blog/1/edit')
            ->assertViewIs('blog.update');

    }
}
