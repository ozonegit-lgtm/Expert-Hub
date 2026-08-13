<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Expert extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'highest_education',
        'current_position',
        'expertise_details',
        'other_expertise',
        'phone',
        'email',
        'line_id',
        'workplace',
        'profile_image',
        'is_published',
        'show_contact',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'show_contact' => 'boolean',
        ];
    }

    public function expertiseCategories(): BelongsToMany
    {
        return $this->belongsToMany(
            ExpertiseCategory::class,
            'expert_expertises'
        );
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}