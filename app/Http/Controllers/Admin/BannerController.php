<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Imports\BannerImport;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Banner::Query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        $data = $query->paginate(10);
        // $data = Banner::paginate(10);

        return view('admin.banner.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $bannerRequest)
    {
        $path = $bannerRequest->file('image')->store('banners/', 'public');

        $data = $bannerRequest->only(['title', 'hyper_link']);

        $data['path'] = $path;
        Banner::create($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner, Request $request)
    {
        $query = Banner::Query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        $data = $query->paginate(10);

        return view('admin.banner.edit', ['data' => $data, 'banner' => $banner]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $path = $banner->path;
        $status = true;
        if ($request->file('image')) {
            if ($banner->path && Storage::disk('public')->exists($banner->path)) {
                Storage::disk('public')->delete($banner->path);
            }
            $path = $request->file('image')->store('banners/', 'public');
        }
        if ($request->status == 0) {
            $status = false;
        }

        $data = $request->only(['title', 'hyper_link', 'order']);
        $data['path'] = $path;
        $data['status'] = $status;

        $banner->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        if ($banner->path && Storage::disk('public')->exists($banner->path)) {
            Storage::disk('public')->delete($banner->path);
        }

        $banner->delete();

        return back();
    }

    public function importStore(Request $request, BannerImport $bannerImport)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls|max:20480', // max 20MB
        ]);

        $path = $request->file('file')->store('temp', 'public');

        $bannerImport->import('storage/' . $path);

        Storage::disk('public')->delete($path);
        return back();
    }
}
