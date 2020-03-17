<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NewsParsing;
use App\MyServices\RssParserService;
use App\Source;
use Illuminate\Http\RedirectResponse;

class NewsParserController extends Controller
{
    /**
     * обработка ранее зарегистрированных источников по одному
     * @return RedirectResponse
     */
    public function index()
    {
        $sources = Source::all();

        foreach ($sources as $source) {
            NewsParsing::dispatch($source);
        }

        return redirect()->route('admin.source.index')->with('success',
            'Источники из этого списка только что были добавлены в очередь для парсинга.');
    }
}
