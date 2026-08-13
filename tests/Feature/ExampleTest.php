<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_redirects_to_expert_index(): void
    {
        $this->get('/')->assertRedirectToRoute('experts.index');
        $this->get(route('experts.index'))->assertOk();
    }
}