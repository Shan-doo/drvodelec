<?php

namespace App\Repos;

use Illuminate\Http\Request;

use App\Image;

interface ImageRepositoryInterface 
{  

    public function saveImage(Request $request);

    public function deleteImage($image_id);

    public function indexImages(); 
	
	public function indexCategories();

	public function ajaxMoreImages($offset, $limit);

	public function imagesTotal();

	public function getPaginatedImages($limit);

	public function getImageCategories();

}

?>