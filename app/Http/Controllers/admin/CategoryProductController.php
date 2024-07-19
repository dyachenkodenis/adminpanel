<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Services\SlugGenerator;
use App\Services\ParsePathPages;

class CategoryProductController extends Controller
{
    public function index(Request $request)
    {
        $perCat = 10;
        $category = Category::latest()->paginate($perCat);
        $currentCat = $request->input('page', 1);
        $startIndex = ($currentCat - 1) * $perCat;

        return view('admin.product.category.index', [
            'category' => $category,
            'i' => $startIndex
        ]);
    }

    public function create()
    {
        $files = ParsePathPages::path();
        return view('admin.product.category.create', compact('files'));
    }


    public function store(Request $request, Category $category)
    {

        $request->validate([
            'title' => 'unique:categories',
            'slug' => '',
            'parent_id' => ''
        ]);


        Category::create([
            'title' => $request->title,
            'slug' => SlugGenerator::get_permalink($request['title']),
            'parent_id' => ($request['parent_id'] ?? "")
        ]);

        return redirect()->route('admin.product.category.index')
            ->with('success', 'Категория успешно добавлена.');
    }

    // public function show(Page $page)
    // {
    //     return view('admin.page.show', compact('page'));
    // }

    public function edit(Category $category)
    {
        $files = ParsePathPages::path();
    
     
        return view('admin.product.category.edit', compact('category', 'files'));
    }

    public function update(Request $request, Category $category)
    {
        // dd($category->toArray());
        try {
            $category->update([
                'title' => $request->setting['title'],
                'jsonvalue' => $request->all(),
                'parent_id' => $request->setting['parent_id'],            
                'status' => $request->setting['status'],
                'slug' => $request->setting['slug']
            ]);

            $notification = [
                'message' => 'Запись успешно обновлена!',
                'alert-type' => 'success',
            ];

            return json_encode($notification);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Произошла ошибка при обновлении записи: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {


        //File::delete(app_path("/Http/Controllers/{$page->template}Controller.php"));
        $product->delete();


        return redirect()->route('admin.product.product.index')
            ->with('success', 'Страница успешно удалена.');
    }

}
