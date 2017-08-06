<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Image;

use App\User;

use App\Classes\ImageMaker;

use App\Repos\ImageRepositoryInterface;

use App\Http\Requests\StoreImage;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;




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
			
			return view('admin.partials.images.index', compact('images', 'imagesTotal', 'categories'));

		}

		return view('admin.pages.images.index', compact('images', 'imagesTotal', 'categories'));

	}

	public function create()
	{	
		$categories = $this->imagesRepo->getImageCategories();

		return view('admin.pages.images.create', compact('categories'));
	}
	
	public function store(StoreImage $request)
	{	
		
		$this->imageMaker->makeImage($request->file('image'))->addWatermark()->makeThumbnail()->storeAll();

		$image = $this->imagesRepo->saveImage($request);

		return redirect()->back();
	}

	public function decodeAndStoreImg(Request $request)
	{	

		$user = User::find(Auth::user()->id);



		$data = $request->image;

		list($type, $imageData) = explode(';', $data);

		list(, $base64Data) = explode(',', $imageData);

		$croppedImage = base64_decode($base64Data);

		list($imageName, $extension) = explode('.', substr($request->name, strripos($request->name, '/') + 1));

		$croppedPath = storage_path('app/public/avatars/cropped/');

		$avatarsPath = storage_path('app/public/avatars/');


		if (!file_exists($croppedPath)) {
			
			mkdir($croppedPath, 0755, true);
		}

		/*if (Storage::exists('public/avatars/cropped/' . $user->avatar)) {
			
			Storage::delete('public/avatars/cropped/' . $user->avatar);
		}*/

		/*Storage::put('croppedImage.jpg', $croppedImage);*/

		

		// if it's a new image move from temp to avatars
		if (!file_exists($avatarsPath . $imageName . '.' .$extension)) {
			
			rename(storage_path('app/public/avatars/temp/' . $imageName . '.' . $extension), storage_path('app/public/avatars/' . $imageName . '.' . $extension));

			if ($user->avatar != null) {

				unlink(storage_path('app/public/avatars/' . $user->avatar));

				unlink(storage_path('app/public/avatars/cropped/' . $user->avatar));
			}

			
		}

		// save cropped image
		file_put_contents($croppedPath . $imageName . '.' .$extension, $croppedImage);

		$user->avatar = $imageName . '.' . $extension;

		$user->save();

		return $imageName . '.' . $extension;
	}

	public function delete(Request $request)
	{	
		var_dump(json_encode($request->image_id));
		$this->imagesRepo->deleteImage($request->image_id);
	}

	public function storeTempAvatar(Request $request)
    {   
            
        $tempImage = $request->image->store('public/avatars/temp/');

        list($tempImage, $extension) = explode('.', substr($tempImage, strripos($tempImage, '/') + 1));

        return $tempImage . '.' . $extension;
    }

    public function deleteTempAvatar(Request $request)
    {	
    	if (file_exists(storage_path('app/public/avatars/temp/' . $request->avatar))) {
    		
    		unlink(storage_path('app/public/avatars/temp/' . $request->avatar));
    	}
    }

}
