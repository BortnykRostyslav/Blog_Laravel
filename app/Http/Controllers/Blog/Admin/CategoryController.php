<?php

namespace App\Http\Controllers\Blog\Admin;


use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

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
    public function update(Request $request, string $id)
    {
        $item = BlogCategory::find($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg' => 'Запмис id=[{id}] не знайдено'])
                ->withInput();
        }

        $data = $request->all();
        $result = $item
            ->fill($data)
            ->save();

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
