<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */
class BlogPostRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }
    /**
     * Отримати список статтей для вивода в списку
     * (Адмінка)
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        $colums = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this
            ->startConditions()
            ->select($colums)
            ->orderBy('id', 'DESC')
            ->with(['category', 'user'])
//            // можна так
//            ->with(['category' => function ($query){
//                $query->select(['id', 'title']);
//            }])
//            //або так
//            ->with([
//                'user:id,name'
//            ])
            ->paginate($perPage);

        return $result;
    }
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
