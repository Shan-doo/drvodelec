<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repos\ImageRepositoryInterface;

use App\Repos\MessageRepositoryInterface;

use App\News;


class IndexController extends Controller
{	
	public $imageRepo;

	public $messageRepo;

	
	public function __construct(ImageRepositoryInterface $imageRepo, MessageRepositoryInterface $messageRepo)
	{
		$this->imageRepo = $imageRepo;

		$this->messageRepo = $messageRepo;
	}

	public function index(Request $request)
	{	
		
		if ($request->conv && $request->token) {

			$token = $this->messageRepo->getConversationToken($request->conv);

			if ($request->token == $token) {
				
				$conversation = $this->messageRepo->showConversation($request->conv);
			}

		}

		/*dd($conversation);*/

		if ($request->offset && $request->limit) {
		
		return $this->imageRepo->ajaxMoreImages($request->offset, $request->limit);

		} else {

		$images = $this->imageRepo->indexImages();

		$categories = $this->imageRepo->indexCategories();

		$news = News::all();

		/*dd($news->toArray());*/

		return view('client.index', compact('images', 'categories', 'conversation', 'news'));

		}
	}

	public function changeLocale(Request $request)
	{
		session(['locale' => $request->locale]);

		return redirect()->back();
	}

}
