<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenueUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'        => ['required'],
            'alias'       => ['required'],
            'status'      => ['required'],
            'description' => ['required'],
            'image'       => ['sometimes', 'image']
        ];
    }
}