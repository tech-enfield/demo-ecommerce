<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AttributeGroup::query();

        if($request->filled('name'))
        {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }

        $data = $query->paginate(10);
        // $data = AttributeGroup::paginate(10);
        return view('admin.attributes.group.index', ['data' => $data]);
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
            'name' => ['required', 'string', 'unique:attribute_groups,name'],
            'slug' => ['nullable', 'string', 'unique:attribute_groups,slug']
        ]);

        AttributeGroup::create($validated);

        return redirect(route('admin.attributes.groups.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(AttributeGroup $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttributeGroup $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttributeGroup $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttributeGroup $group)
    {
        $hasAttributes = $group->attributes()->exists();
        if ($hasAttributes) {
            Session::flash('error', 'Cannot delete this group because this group has some assigned attributes. Delete them first.');
            return redirect()
            ->back();
            // ->with('error', 'Cannot delete this group because this group has some assigned attributes.');
    }

    // Otherwise delete safely
    $group->delete();

    return redirect()
        ->route('admin.attributes.groups.index')
        ->with('success', 'Attribute group deleted successfully.');
    }
}
