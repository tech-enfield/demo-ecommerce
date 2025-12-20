<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AttributeValue::query();

        if($request->filled('attribute_name'))
        {
            $query->whereHas('attribute', function($aV) use ($request) {
                $aV->where('name', 'like', '%'.$request->query('attribute_name').'%');
            });
        }

        $data = $query->paginate(10);
        // $data = AttributeValue::paginate(10);
        $attributes = Attribute::get(['id', 'name']);
        return view('admin.attributes.values.index', ['data' => $data, 'attributes' => $attributes]);
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
            'value' => ['required', 'string'],
            'slug' => ['nullable', 'unique:attribute_values,slug'],
            'attribute_id' => ['required', 'exists:attributes,id']
        ]);

        AttributeValue::create($validated);

        Session::flash('success', 'Attribute Value created successfully.');
        return redirect(route('admin.attributes.values.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(AttributeValue $value)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttributeValue $value)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttributeValue $value)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttributeValue $value)
    {
        $value->delete();

        Session::flash('success', 'Attribute Value deleted successfully');

        return redirect(route('admin.attributes.values.index'));
    }
}
