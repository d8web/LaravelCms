<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(5);

        return view('admin.pages.index', [
            'pages' => $pages
        ]);
    }

    public function createPage()
    {
        return view('admin.pages.create');
    }

    public function storePage(Request $request)
    {
        $data = $request->only(['title', 'body']);
        // Criando slug com Str
        $data['slug'] = Str::slug($data['title'], '-');

        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'body' => 'string',
            'slug' => 'required|string|max:255|unique:pages,slug'
        ]);

        if($validator->fails()) {
            return redirect()
                ->route('pages.create')
                ->withErrors($validator)
                ->withInput();
        }

        $page = new Page();
        $page->title = $data['title'];
        $page->slug = $data['slug'];
        $page->body = $data['body'];
        $page->save();

        return redirect()->route('pages');
    }

    public function edit($page)
    {
        $page = Page::find($page);

        return view('admin.pages.edit', [
            'page' => $page
        ]);

        return redirect()->route('pages');
    }

    public function update($id, Request $request)
    {
        $page = Page::find($id);
        if($page)
        {
            $data = $request->only(['title', 'body']);

            if($data['title'] !== $page['title'])
            {
                $data['slug'] = Str::slug($data['title'], '-');
                $validator = Validator::make($data, [
                    'title' => 'required|string|max:255',
                    'body' => 'string',
                    'slug' => 'required|string|max:255|unique:pages,slug'
                ]);

            } else {
                $validator = Validator::make($data, [
                    'title' => 'required|string|max:255',
                    'body' => 'string'
                ]);
            }

            if($validator->fails()) {
                return redirect()
                    ->route('page.edit', [
                        'page' => $id
                    ])
                    ->withErrors($validator)
                    ->withInput();
            }

            $page->title = $data['title'];
            $page->body = $data['body'];

            if(!empty($data['slug'])) {
                $page->slug = $data['slug'];
            }

            $page->save();
        }

        return redirect()->route('pages');
    }

    public function destroy($page)
    {
        $page = Page::find($page);
        if($page) {
            $page->delete();
        }

        return redirect()->route('pages');
    }

}
