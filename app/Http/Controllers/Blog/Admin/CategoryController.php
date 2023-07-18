<?php

namespace App\Http\Controllers\Blog\Admin;


use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Repositories\BlogCategoryRepository;

/**
 * Управління категоріями блога
 *
 * @package App\Http\Controllers\Blog\Admin
 */
class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct(BlogCategoryRepository $blogCategoryRepository)
    {
        parent::__construct();

        $this->blogCategoryRepository = $blogCategoryRepository;
    }


    public function index()
    {
        $paginator = $this->blogCategoryRepository->getAllWithPaginate(5);


        return View::make('blog.admin.category.index', ['paginator' => $paginator]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return View::make('blog.admin.category.edit', ['item' => $item, 'categoryList' => $categoryList]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        /*Пішло в обсервер
        if(empty($data['slug'])){
            $data['slug'] = Str::slug($data['title']);
        }*/

        //Створить об'єкт и добавить в БД
        $item = (new BlogCategory )->create($data);

        if($item){
            return redirect()->route('categories.edit', [$item->id])
                ->with(['succes' => 'Успішно збережено']);
        } else {
            return back()->withErrors(['msg' => 'Помилка збереження'])
                ->withInput();
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, BlogCategoryRepository $categoryRepository)
    {
        $item = $categoryRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }
        $categoryList = $categoryRepository->getForComboBox();

        return View::make('blog.admin.category.edit', ['item' => $item, 'categoryList' => $categoryList]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryUpdateRequest $request, string $id)
    {
        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg' => 'Запмис id=[{id}] не знайдено'])
                ->withInput();
        }

        $data = $request->all();
        /*Пішло в обсервер
        if(empty($data['slug'])){
            $data['slug'] = Str::slug($data['title']);
        }*/

        $result = $item->update($data);

        if($result){
            return redirect()
                ->route('categories.edit', $item->id)
                ->with(['success' => 'Успішно збережено']);
        } else{
            return back()
                ->withErrors(['msg' => 'Помилка збереження'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
}
