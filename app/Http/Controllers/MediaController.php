<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repos\Dbrepos\ImageDbRepo;
use Carbon\Carbon;
use Cron\FieldFactory;
use App\Image;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Http\Request;

/**
 * Class MediaController
 * @package App\Http\Controllers
 */
class MediaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Image $image)
	{
        $images = $image->orderBy('created_at', 'desc')->get();
        $image_path = '/images/uploads/';
        $thumb_path = '/images/uploads/thumbs/';
		$page_title = 'All Media List';
        return view('admin.media', compact('images', 'image_path', 'thumb_path', 'page_title'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$page_title = 'Upload New Media';
		return view('admin.createMedia', compact('page_title'));
	}


	/**
	 * @param Storage $storage
	 * @param Request $request
	 * @param ImageDbRepo $imagerepo
	 * @return \Illuminate\Http\RedirectResponse|string
     */
	public function store(Storage $storage, Request $request, ImageDbRepo $imagerepo)
	{
		$images = $request->file('images');




		if($request->isXmlHttpRequest())
		{
			$image = $request->file('image');

			$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
			$imageFullName = $timestamp. '-' .$image->getClientOriginalName();
			$thumbName = 'thumb_'. $imageFullName;

			$imagerepo->uploadImage($image, $imageFullName, $storage);
			$imagerepo->resizeImage(300, 200, $imageFullName, $thumbName);

			$status = $imagerepo->saveToDb($image->getClientOriginalName(), $imageFullName, $thumbName);

			if($status)
			{
				$data = [
					'original_path' => '/images/uploads/'.$imageFullName,
				];
				return json_encode($data, JSON_UNESCAPED_SLASHES);
			}
			return "uploading failed";
		}

        foreach( $images as $image)
		{

			$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
			$imageFullName = $timestamp. '-' .$image->getClientOriginalName();
			$thumbName = 'thumb_'. $imageFullName;

			$imagerepo->uploadImage($image, $imageFullName, $storage);

            $imagerepo->resizeImage(300, 200, $imageFullName, $thumbName);

            $imagerepo->saveToDb($image->getClientOriginalName(), $imageFullName, $thumbName);
        }
        return redirect()->back()->with('flash_message', 'Image Uploaded Sucessfully');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		dd($request->all());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
