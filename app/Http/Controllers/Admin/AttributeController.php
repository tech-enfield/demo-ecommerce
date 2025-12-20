<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AttributeExport;
use App\Http\Controllers\Controller;
use App\Imports\AttributeImport;
use App\Models\Attribute;
use App\Models\AttributeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Attribute::query();

        if($request->filled('name'))
        {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }

        $data = $query->paginate(10);

        $attributeGroup = AttributeGroup::get(['id','name']);
        return view('admin.attributes.index', ['data' => $data, 'attributeGroup' => $attributeGroup]);
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'attribute_group_id' => ['required', 'exists:attribute_groups,id'],
            'name' => ['required', 'string', 'unique:attributes,name'],
            'slug' => ['nullable', 'string', 'unique:attributes,slug'],
        ]);

        Attribute::create($validated);

        return redirect(route('admin.attributes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        if($attribute->values()->exists())
        {
            Session::flash('error', 'Cannot delete this attribute because this attribute has some assigned values. Delete them first.');
            return redirect()->back();
        }

        $attribute->delete();

        Session::flash('success', 'Attribute deleted successfully');

        return redirect(route('admin.attributes.index'));
    }

    public function import(){
        $data =  Attribute::paginate(10);
        return view('admin.attributes.import', ['data' => $data]);
    }


    public function importStore(Request $request, AttributeImport $attributeImport)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls|max:20480', // max 20MB
        ]);

        $path = $request->file('file')->store('temp', 'public');

        $attributeImport->import('storage/' . $path);

        Storage::disk('public')->delete($path);
        return back();
    }

    public function export(){
        return Excel::download(new AttributeExport, 'attributes-'. time() . '.xlsx');
    }
}
