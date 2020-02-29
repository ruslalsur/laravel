<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Users;
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
        return view('admin.categoryCreator', ['authorizedUserInfo' => Users::getAuthorizedUserInfo(), 'categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        if ($this->request->name === null) {
            return redirect()->route('category.create')->with('failure', 'Нужно ввести название категории,
            чтобы удалить или добавть ее в список категорий');
        }

        $this->request->flash();
        $categoryNew = new Category();
        $categoryNew->fill($this->request->all());

        if ($categoryNew->newQuery()->where('name', $categoryNew->name)->exists()) {
            return redirect()->route('news.currentCategory', $categoryNew)->with('failure', 'Категория "' . $categoryNew->name . '" уже существует');
        }
        $categoryNew->save();

        return redirect()->route('news.categories')->with('success', 'Была создана категория ' . $categoryNew->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        //не придумал как подставить модель в параметр во вьюхе взяв ее из только, что выбранного селекта до отправки
        // сделал пока через реквест:
        $categoryToDelete = Category::query()->find($this->request->id);

        if ($categoryToDelete->news()->exists()) {
            return redirect()->route('news.currentCategory', $categoryToDelete)->with('failure', 'Категория "' .
                $categoryToDelete->name . '" содержит новости, нужно удалить из нее новости, перед удалением категории');
        }
        $categoryToDelete->delete();

        return redirect()->route('news.categories', $categoryToDelete)->with('success', 'Была удалена категория ' . $categoryToDelete->name);


    }
}
