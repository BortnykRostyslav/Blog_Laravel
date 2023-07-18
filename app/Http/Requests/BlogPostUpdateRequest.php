<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class BlogPostUpdateRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'           => 'required|min:3|max:200',
            'slug'            => 'max:200',
            'excerpt'         => 'max:500',
            'content_raw'     => 'required|string|min:5|max:10000',
            'category_id'     => 'required|integer|exists:blog_categories,id',
        ];
    }
}
