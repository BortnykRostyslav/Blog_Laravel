<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Support\Str;
use App\Models\BlogPost;
use Illuminate\Support\Facades\View;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;

/**
 * Управління статтями блога
 * @package App\Http\Controller\Blog\Admin
 */
class PostAdminController extends BaseController
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
    public function update(Request $request, string $id)
    {
        dd(__METHOD__, $request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd(__METHOD__, $id, request()->all());
    }
}
