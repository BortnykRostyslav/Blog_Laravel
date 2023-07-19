<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class BlogPostCreateRequest extends FormRequest
{
    public function authorize():bool
    {
        return true;
    }

    public function rules():array
    {
        return [
            'title'           => 'required|min:5|max:200|unique:blog_posts',
            'slug'            => 'max:200',
            'content_raw'     => 'required|string|min:5|max:10000',
            'category_id'     => 'required|integer|exists:blog_categories,id',
        ];
    }

    public function messages():array
    {
        return [
            'title.required'  => 'Введіть заголовок статті',
            'content_raw.min' => 'Мінімальна довжина статті [:min] символів',
        ];
    }

    public function attributes():array
    {
        return [
            'title' => 'Заголовок',
        ];
    }
}
