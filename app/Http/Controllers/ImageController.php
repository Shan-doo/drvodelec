<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Image;

use App\Classes\ImageMaker;

use App\Repos\ImageRepositoryInterface;

use App\Http\Requests\StoreImage;


class ImageController extends Controller
{	
	public $imageMaker;

	public $imagesRepo;

	public function __construct(ImageMaker $imageMaker, ImageRepositoryInterface $imageRepository)
	{
		$this->imageMaker = $imageMaker;

		$this->imagesRepo = $imageRepository;
	}

	public function index(Request $request)
	{	
		$imagesTotal = $this->imagesRepo->imagesTotal();

		$images = $this->imagesRepo->getPaginatedImages(5);

		$categories = $this->imagesRepo->getImageCategories();

		if ($request->ajax()) {
			
			return view('admin.partials.images', compact('images', 'imagesTotal', 'categories'));

		}

		return view('admin.pages.images', compact('images', 'imagesTotal', 'categories'));

	}
	
	public function store(StoreImage $request)
	{	

		$this->imageMaker->makeImage($request->file('image'))->addWatermark()->makeThumbnail()->storeAll();

		$image = $this->imagesRepo->saveImage($request);

		return redirect()->back();
	}

	public function delete(Request $request)
	{	
		var_dump(json_encode($request->image_id));
		$this->imagesRepo->deleteImage($request->image_id);
	}

}
