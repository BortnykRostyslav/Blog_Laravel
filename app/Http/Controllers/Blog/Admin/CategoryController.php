<?php

namespace App\Http\Controllers\Blog\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\View;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(5);


        return View::make('blog.admin.category.index', ['paginator' => $paginator]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = new BlogCategory();
        $categoryList = BlogCategory::all();

        return View::make('blog.admin.category.edit', ['item' => $item, 'categoryList' => $categoryList]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if(empty($data['slug'])){
            $data['slug'] = Str::slug($data['title']);
        }

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
    public function edit($id)
    {
        $item = BlogCategory::findOrFail($id);
        $categoryList = BlogCategory::all();

        return View::make('blog.admin.category.edit', ['item' => $item, 'categoryList' => $categoryList]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryUpdateRequest $request, string $id)
    {
        $item = BlogCategory::find($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg' => 'Запмис id=[{id}] не знайдено'])
                ->withInput();
        }

        $data = $request->all();
        if(empty($data['slug'])){
            $data['slug'] = Str::slug($data['title']);
        }

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
