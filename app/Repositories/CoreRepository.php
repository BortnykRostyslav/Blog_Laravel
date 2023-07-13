<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository
 *
 * @package App/Repositories
 *
 * Репозіторій роботи з сутністю.
 * Може видавати набори даних.
 * Не може створювати/змінювати сутності.
 */
abstract class CoreRepository
{
    /**
     * @var Model;
     */
    protected $model;

    /**
     * CoreCategory constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Model|\Illuminate\Foundation\Application|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }
}
