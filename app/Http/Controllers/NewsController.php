<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mews\Purifier\Facades\Purifier;

use App\News;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;


class NewsController extends Controller
{
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            
            return response()->json([
                    'data' => News::select(['id', 'title', 'slug', 'user_id', 'created_at', 'updated_at'])
                    ->get()
                     ]);
        }

   		return view('admin.pages.news.index');
    }

    public function show(News $news)
    {   
        return view('admin.pages.news.show', ['news' => $news]);
    }

    public function create()
    {
    	return view('admin.pages.news.create');
    }

    public function store(Request $request)
    {
    	if ($request->ajax()) {

            if ($request->image) {

                return $request->image->store('public/news');

            }
        }

        $this->validate($request, ['title' => 'required', 'body' => 'required',]);

        $body = Purifier::clean($request->body);

        $title = $request->title;

        $news = new News(['body' => $body, 'title' => $title]);

        Auth::user()->news()->save($news);

        return redirect()->back();
    }

    public function edit(News $news)
    {
        return view('admin.pages.news.create', ['news' => $news]);
    }

    public function update(Request $request, News $news)
    {
        $news->title = $request->title;
        $news->body = $request->body;
        $news->save();

        return redirect()->back();
    }

    public function delete(Request $request, News $news)
    {
        $news->delete();
    }

    public function deleteEditorImage($imageHash)
    {   
        Storage::delete('public/news/' . $imageHash);
    }
}
