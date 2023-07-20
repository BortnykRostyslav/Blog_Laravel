<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogCategoryRepository
 *
 * @package App\Repositories
 */
class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Отримати модель для редагування в адмінці.
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Отримати список категорій для виводаючому списку.
     *
     * @return Collection
     */
    public function getForComboBox()
    {
        $columns = implode(', ',[
            'id',
            'CONCAT (id, ". ", title) AS id_title',
       ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;

    }

    /**
     * Отримати категорії для вивода пагінатором.
     *
     * @param int\null $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate( $perPage = null )
    {
        $colums = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($colums)
            ->with(['parentCategory:id,title',])
            ->paginate($perPage);
        return $result;
    }
}
