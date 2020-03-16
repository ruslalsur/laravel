<?php

namespace App\Http\Controllers\Admin;

use App\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsSourcesCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.sources', ['sources' => Source::query()->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.addSource');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $source = new Source();
        $source->fill($this->validate($this->request, Source::rules(), [], Source::attributeNames()));
        $source->save();

        return redirect(route('admin.source.index'))
            ->with('success', 'Добавлен новый источник: ' . $source->name);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Source $source модель источника
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function destroy(Source $source)
    {
        $deletingSource = $source->name;

        if (!$this->request->exists('confirmed')) {
            session()->flash('confirm', $source->id);

            return view('admin.sources', ['sources' => $source->query()->paginate(10)]);
        }

        try {
            $source->delete();
        } catch (\Exception $e) {
            return redirect()->route('admin.source.index')
                ->with('failure', "Прямо во время удаления источника {$deletingSource} произошла ошибка");
        }

        return redirect()->route('admin.source.index')->with('success', "Источник {$deletingSource} успешно удален");
    }
}
