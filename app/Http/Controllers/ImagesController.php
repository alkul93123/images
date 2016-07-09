<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use Illuminate\Http\Response;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as ImageMS;


class ImagesController extends Controller
{
  public function index()
  {
    $images = Image::all();

    return response()->json([
        'images'   => $images,
    ]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'Files' => 'image|mimes:jpeg,png,gif',
    ]);

    if ($validator->fails()) {
      // Т.к основная проверка происходит на клиенте, то на сервеной стороне
      // всего лишь отправим http код ошибки
      abort(415, 'Unsupported Media Type.');
    }

    foreach ($request->files as $file) {
      // Сохраняем изображение в директорию public/images
      $image_name = time() . "-" . $file->getClientOriginalName();
      $path = public_path('images/' . $image_name);
      ImageMS::make($file->getRealPath())->resize(200, 150)->save($path);

      // Делаем запись в бд
      $image = new Image;
      $image->name = $file->getClientOriginalName();
      $image->href = 'images/' . $image_name;
      if (!$image->save()) {
        // Изображение не сохранилось отправляем код ошибки 400
          abort(400, "Bad request");
      }
      return (new Response('{"status": "OK"}', 200));
    }
  }

  public function destroy($id)
  {
    $image = Image::find($id);
    if (File::delete(public_path($image->href)) && $image->delete()) {
      return (new Response('{"status": "OK"}', 200));
    }
    abort(500, "Internal Server Error ");
  }

  public function deleteAll()
  {
    $images = Image::all();
    foreach ($images as $image) {
      File::delete(public_path($image->href));
      $image->delete();
    }
    return (new Response('{"status": "OK"}', 200));
  }

}
