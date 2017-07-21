<?php 

namespace App\Classes;

use Intervention\Image\Facades\Image;

use Illuminate\Http\UploadedFile; 

class ImageMaker

{	
	protected $imageFile;

    protected $image;

    protected $thumbnail;

    protected $path = 'app/public/images/';

    public function makeImage(UploadedFile $imageFile)
    {	
    	$this->imageFile = $imageFile;

		$this->image = Image::make($this->imageFile)->encode('jpg')->resize(900, 700);

		return $this;

    }

    public function makeThumbnail()
    {
    	$this->thumbnail = Image::make($this->imageFile)->encode('jpg')->resize(356, 276);

    	return $this;
    }

    public function storeAll()
    {	

    	$this->image->save(storage_path($this->path . $this->imageFile->hashName()));

    	$this->thumbnail->save(storage_path($this->path . 'thumbnails/' . $this->imageFile->hashName()));

    	return $this;
    }

    public function storeImage()
    {

    	$this->image->save(storage_path($this->path . $this->imageFile->hashName()));

    	return $this;	
    } 

    public function storeThumbanail()
    {

    	$this->thumbnail->save(storage_path($this->path . 'thumbnails/' . $this->imageFile->hashName()));

    	return $this;	
    }

    public function addWatermark()
    {

    	$this->image->insert(storage_path('app/public/watermark/water.png'), 'bottom-right', 20, 20);

    	return $this;
    } 

}

?>