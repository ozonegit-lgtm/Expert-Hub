<?php

namespace Database\Seeders;

use App\Models\ExpertiseCategory;
use Illuminate\Database\Seeder;

class ExpertiseCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Microsoft Word',
            'Microsoft Excel',
            'Microsoft PowerPoint',
            'Microsoft Team',
            'Canva',
            'Generative AI',
            'Digital Marketing',
            'Google Apps Script',
            'Google Apps Script Advance',
            'Linux Server',
            'อื่นๆ',
        ];

        foreach ($categories as $name) {
            ExpertiseCategory::updateOrCreate(
                ['name' => $name],
                [
                    'description' => null,
                    'is_active' => true,
                ]
            );
        }
    }
}