<?php

namespace App\Repos;

use App\Image;

use App\Category;

use App\Feed;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use App\Repos\ImageRepositoryInterface;

use Illuminate\Support\Facades\Auth;

use App\Events\ImageWasUploaded;

class ImageRepository implements ImageRepositoryInterface
{	
	public function indexImages() 
	{	

		$images = Image::limit(6)->get();

		return $images;

	}

	public function indexCategories()
	{

		$categories = Category::has('images')->get();

		return $categories;
	}

	public function ajaxMoreImages($offset, $limit)
	{	
		
		$images = Image::with('categories')->limit($limit)->offset($offset)->get();

		$response = [];

		$i = $offset + 1;

		foreach ($images as $image) {

			$elemCategories = '';

			foreach ($image->categories as $category) {
				
				$elemCategories = $elemCategories . $category->name . ' ';

			}

			$element = "<div id='projectImage{$i}' class='element col-md-4 col-sm-4 gall branding' data-image-name='{$image->name}' data-character='{$elemCategories}'>
							<a class='plS' href='storage/images/{$image->name}' rel='prettyPhoto[gallery2]'>
								<div class='aspect aspect--16x9'>
									<div class='aspect__inner'>
										<img class='img-responsive picsGall' src='storage/images/thumbnails/{$image->name}' alt='{$image->name}' width='356' height='276'/>
									</div>
								</div>
							</a>
							<div class='view project_descr'>
								<h3>{$image->description}</h3>
								<ul>
									<li><i class='fa fa-eye'></i>{$image->views}</li>
									<li><a class='heart' href='javascript:void(0);'><i class='fa-heart-o'></i><span>{$image->likes}</span></a></li>
								</ul>
							</div>
						</div>";
						
			array_push($response, $element);

			$i++;
		
		}

		return $response;

	}
	
	public function saveImage(Request $request)
	{
		
		$image = new Image([

			'name' => $request->file('image')->hashName(),

			'description' => $request->description,

			]);

		Auth::user()->images()->save($image);


		$categories = $request->categories;

		foreach ($categories as $category) {
			
			$image->categories()->attach($category);

		}

		event(new ImageWasUploaded($image));

		return $image;

	}

	public function deleteImage($image_id)
	{	

		$image = Image::find($image_id);

		$image->categories()->detach();

		$image->delete();

		Storage::delete('public/images/' . $image->name);

		Storage::delete('public/images/thumbnails/' . $image->name);
	}

	public function imagesTotal()
	{

		return Image::count();

	}

	public function getPaginatedImages($limit)
	{

		return Image::paginate($limit);

	}

	public function getImageCategories()
	{

		return Category::all();

	}
}

?>