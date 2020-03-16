<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Jobs\NewsParsing;
use App\MyServices\RssParserService;
use App\News;
use App\Source;
use Illuminate\Http\RedirectResponse;
use Orchestra\Parser\Xml\Facade as XmlParser;

class NewsParserController extends Controller
{
    /**
     * обработка ранее зарегистрированных источников по одному
     * @return RedirectResponse
     */
    public function index(RssParserService $rssParserService)
    {
        $sources = Source::all();

        foreach ($sources as $source) {
            NewsParsing::dispatch($source);
        }

        return redirect()->route('news.categories');
    }
}
