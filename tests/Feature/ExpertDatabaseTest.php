<?php

namespace Tests\Feature;

use App\Models\Expert;
use App\Models\ExpertiseCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ExpertDatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_expert_schema_and_relationships_work(): void
    {
        $this->assertTrue(Schema::hasColumns('experts', [
            'full_name',
            'current_position',
            'created_by',
        ]));

        $creator = User::factory()->create();

        $expert = Expert::create([
            'full_name' => 'ผู้เชี่ยวชาญทดสอบ',
            'current_position' => 'นักวิจัย',
            'created_by' => $creator->id,
        ]);

        $category = ExpertiseCategory::create([
            'name' => 'เทคโนโลยีสารสนเทศ',
        ]);

        $expert->expertiseCategories()->attach($category);

        $this->assertTrue(
            $expert->expertiseCategories->contains($category)
        );

        $this->assertTrue(
            $category->experts->contains($expert)
        );

        $this->assertTrue(
            $creator->createdExperts->contains($expert)
        );

        $creator->delete();

        $this->assertNull($expert->fresh()->created_by);
    }
}