<?php

namespace Tests\Feature\Backend\Projects;

use App\Domains\Auth\Models\User;
use App\Events\Project\ProjectCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CreateProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admin_can_create_projects()
    {
        $this->actingAs(User::factory()->user()->create());

        $response = $this->get('/admin/projects/create');

        $response->assertSessionHas('flash_danger', __('You do not have access to do that.'));
    }

    /** @test */
    public function an_admin_can_access_the_create_projects_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/admin/projects/create');

        $response->assertOk();
    }

    /** @test */
    public function admin_can_create_new_project()
    {
        Event::fake();

        $this->loginAsAdmin();

        $response = $this->post('/admin/projects', [
            'title' => "Fake Title",
            'medium' => 'Fake Medium',
            'short_description' => 'Fake Short Description',
            'description' => 'Fake Description',
            'page_content' => '<h1>Fake Page Content</h1>',
            'external_url' => 'https://www.example.com',
            'started_at' => '10/05/1994',
            'finished_at' => '10/05/2020',
            'is_active' => '1',
        ]);

        $this->assertDatabaseHas(
            'projects',
            [
                'title' => "Fake Title",
                'medium' => 'Fake Medium',
                'short_description' => 'Fake Short Description',
                'description' => 'Fake Description',
                'page_content' => '<h1>Fake Page Content</h1>',
                'external_url' => 'https://www.example.com',
                'started_at' => '10/05/1994',
                'finished_at' => '10/05/2020',
                'is_active' => '1',
            ]
        );

        $response->assertSessionHas(['flash_success' => __('Successfully Created the Project')]);

        Event::assertDispatched(ProjectCreated::class);
    }
}
