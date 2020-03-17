<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;

class CategoryCrudResourceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        session()->put('referer', "admin/category/create");

        return view('admin.categoryCreator', ['categories' => Category::query()->paginate(10)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $categoryNew = new Category();
        $categoryNew->fill($this->validate($this->request,Category::rules(), [], Category::attributeNames()));
        $categoryNew->save();

        return redirect()->route('admin.category.create')->with('success', 'Была создана категория ' . $categoryNew->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $name = $this->request->name;
        if (isset($name)) {
            $category = Category::query()->where('name', $name)->first();
            $category = $category->fill($this->validate($this->request, Category::rulesForDelete(), [], Category::attributeNames()));
            $category->delete();

            return redirect()->route('admin.category.create')->with('success', 'Была удалена категория ' . $name);
        }

        return redirect()->route('admin.category.create')->with('failure', 'Список категорий пуст.');
    }
}
