<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Support\Str;
use App\Models\BlogPost;
use Illuminate\Support\Facades\View;
use App\Repositories\BlogPostRepository;

/**
 * Управління статтями блога
 * @package App\Http\Controller\Blog\Admin
 */
class PostAdminController extends BaseController
{
    private $blogPostRepository;

    public function __construct(BlogPostRepository $blogPostRepository)
    {
        parent::__construct();

        $this->blogPostRepository = $blogPostRepository;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
