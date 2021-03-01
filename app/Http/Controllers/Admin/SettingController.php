<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [];

        $dbSettings = Setting::get();
        foreach($dbSettings as $dbSetting) {
            $settings[$dbSetting['name']] = $dbSetting['content'];
        }

        return view('admin.settings.index', [
            'settings' => $settings
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->only([
            'title', 'subtitle', 'email', 'bgcolor', 'textcolor'
        ]);

        $validator = Validator::make($data, [
            'title' => 'string|max:255',
            'subtitle' => 'string|max:255',
            'email' => 'required|email',
            'bgcolor' => 'string|regex:/#[A-Z0-9]{6}/i',
            'textcolor' => 'string|regex:/#[A-Z0-9]{6}/i'
        ]);

        if($validator->fails()) {
            return redirect()
                ->route('settings')
                ->withErrors($validator);
        }

        // Salvar
        foreach($data as $item => $value)
        {
            Setting::where('name', $item)->update([
                'content' => $value
            ]);
        }

        return redirect()
            ->route('settings')
            ->with('warning', 'Informações alteradas com sucesso!');;
    }

}
