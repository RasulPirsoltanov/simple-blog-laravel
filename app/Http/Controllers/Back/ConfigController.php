<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function indexConfig()
    {
        $config = Config::find(1);
        return view('backend.config.index', compact('config'));
    }
    public function updateConfig(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'activ' => 'required',
        ]);
        $config = Config::find(1);
        $config->title = $request->title;
        $config->aktiv = $request->activ;
        $config->facebook = $request->facebook;
        $config->instagram = $request->instagram;
        $config->linkedin = $request->linkedin;
        $config->github = $request->github;
        $config->twitter = $request->twitter;
        $config->youtube = $request->youtube;

        if ($request->hasFile('logo')) {
            $logoname = Str::slug($request->title) . '.' . $request->logo->getClientOriginalExtension();
            $directory = 'upload/config/logo/';
            if (file_exists($config->logo)) {
                unlink($config->logo);
            }
            $request->logo->move($directory, $logoname);
            $logoname = $directory . $logoname;
        }
        if ($request->hasFile('favicon')) {
            $imagename = Str::slug($request->title) . '.' . $request->favicon->getClientOriginalExtension();
            $directory = 'upload/config/favicon/';
            if (file_exists($config->favicon)) {
                unlink($config->favicon);
            }
            $request->favicon->move($directory, $imagename);
            $imagename = $directory . $imagename;
        }
        $config->logo = $logoname ?? $config->logo;
        $config->favicon = $imagename ?? $config->favicon;

        $config->save();
        return redirect()->back()->with('success', 'Yenilikler qeyd edildi!');
    }
}
