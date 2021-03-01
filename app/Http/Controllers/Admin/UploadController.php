<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function imageupload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        // Extensão do arquivo.
        $ext = $request->file->extension();
        // Nome do arquivo.
        $imageName = time().'.'.$ext;

        // Mover arquivo para pasta media/images
        $request->file->move(public_path('media/images'), $imageName);

        return [
            'location' => asset('media/images/'.$imageName)
        ];
    }
}
