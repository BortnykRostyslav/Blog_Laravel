<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Http\Requests\BlogPostCreateRequest;

/**
 * Управління статтями блога
 * @package App\Http\Controller\Blog\Admin
 */
class PostAdminController extends BaseController
{
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;
    private $blogCategoryRepository;

    public function __construct(BlogPostRepository $blogPostRepository, BlogCategoryRepository $blogCategoryRepository)
    {
        parent::__construct();

        $this->blogPostRepository = $blogPostRepository;
        $this->blogCategoryRepository=$blogCategoryRepository;
    }
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate(25);


        return View::make('blog.admin.posts.index', ['paginator' => $paginator]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = new BlogPost();
        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return View::make('blog.admin.posts.edit', ['item' => $item, 'categoryList' => $categoryList]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->input();
        //Створить об'єкт и добавить в БД
        $item = (new BlogPost() )->create($data);

        if($item){
            return redirect()->route('blog.admin.posts.edit', [$item->id])
                             ->with(['success' => 'Успішно збережено']);
        } else {
            return back()->withErrors(['msg' => 'Помилка збереження'])
                        ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit(string $id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }

        $categoryList = $this->blogCategoryRepository->getForComboBox();

        return View::make('blog.admin.posts.edit', ['item' => $item, 'categoryList' => $categoryList]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostUpdateRequest $request, string $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if(empty($item)){
            return back()
                ->withErrors(['msg' => 'Запмис id=[{id}] не знайдено'])
                ->withInput();
        }

        $data = $request->all();

        /* пішло в Observer
        if(empty($data['slug'])){
            $data['slug'] = Str::slug($data['title']);
        }
        if(empty($item->published_at) && $data['is_published']){
            $data['published_at'] = Carbon::now();
        }*/

        $result = $item->update($data);

        if($result){
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Успішне виконання']);
        } else{
            return back()
                ->withErrors(['msg' => 'Помилка збереження'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Залишається в бд
        $result = BlogPost::destroy($id);

        //Повністю видаляє
//        $result = BlogPost::destroy($id);

        if($result){
            return redirect()
                ->route('blog.admin.posts.index')
                ->with(['success' => "Запис id[$id] видалено"]);
        }else{
            return back()->withErrors(['msg' => 'Помилка видалення']);
        }
    }
}
