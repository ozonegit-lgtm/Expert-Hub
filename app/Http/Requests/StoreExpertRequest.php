<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
            'show_contact' => $this->boolean('show_contact'),
        ]);
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'highest_education' => ['nullable', 'string', 'max:255'],
            'current_position' => ['nullable', 'string', 'max:255'],
            'expertise_details' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'line_id' => ['nullable', 'string', 'max:100'],
            'workplace' => ['nullable', 'string', 'max:255'],
            'profile_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'is_published' => ['required', 'boolean'],
            'show_contact' => ['required', 'boolean'],
            'expertise_category_ids' => ['nullable', 'array'],
            'expertise_category_ids.*' => [
                'integer',
                'distinct',
                'exists:expertise_categories,id',
            ],
            'other_expertise' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'กรุณากรอกชื่อผู้เชี่ยวชาญ',
            'email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'profile_image.image' => 'ไฟล์ที่เลือกต้องเป็นรูปภาพ',
            'profile_image.max' => 'รูปภาพต้องมีขนาดไม่เกิน 10 MB',
            'expertise_category_ids.*.exists' => 'ไม่พบหมวดความเชี่ยวชาญที่เลือก',
        ];
    }
}