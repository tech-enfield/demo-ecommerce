<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SaleRequest;
use App\Models\ProductVariant;
use App\Models\Sale;
use App\Services\ProductVariantStockDecreaseServiceClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Sale::query();

        if ($request->filled('product_variant_sku')) {
            $query->whereHas('productVariant', function ($pV) use ($request) {
                $pV->where('sku', 'like', '%' . $request->query('product_variant_sku') . '%');
            });
        }

        if ($request->filled('entry_by')) {
            $query->whereHas('saleEnteredBy', function ($user) use ($request) {
                $user->where('name', 'like', '%' . $request->query('entry_by') . '%');
            });
        }

        $data = $query->paginate(10);

        $productVariants = ProductVariant::where('stock_quantity', '>=', 1)->where('manage_stock', 1)->get(['id', 'sku', 'stock_quantity']);
        return view('admin.sales.index', ['data' => $data, 'productVariants' => $productVariants]);
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
    public function store(SaleRequest $saleRequest)
    {
        $userId = Auth::id();

        $productVariant = ProductVariant::find($saleRequest->product_variant);

        if ($saleRequest->quantity > $productVariant->stock_quantity) {
            Session::flash('error', 'The sale quantity is greater than the stock quantity');
            return back();
        }

        Sale::create([
            'sale_entry_by' => $userId,
            'product_variant_id' => $saleRequest->product_variant,
            'quantity' => $saleRequest->quantity,
            'sold_for' => $saleRequest->sold_for,
        ]);

        $newStock = $productVariant->stock_quantity - $saleRequest->quantity;

        $productVariant->update([
            'stock_quantity' => $newStock,
            'stock_status'   => $newStock == 0 ? 'out_of_stock' : 'in_stock',
        ]);

        Session::flash('success', 'Sale entry successful.');
        return redirect(route('admin.sales.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('admin.sales.show', ['sale' => $sale]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $query = Sale::query();

        $data = $query->paginate(10);

        $productVariants = ProductVariant::where('stock_quantity', '>=', 1)->where('manage_stock', 1)->get(['id', 'sku', 'stock_quantity']);
        return view('admin.sales.edit', ['data' => $data, 'productVariants' => $productVariants, 'sale' => $sale]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaleRequest $saleRequest, Sale $sale)
    {
        if ($sale->quantity != $saleRequest->quantity) {
            $diffInQuantity =  $sale->quantity - $saleRequest->quantity;
            $productVariant = ProductVariant::find($saleRequest->product_variant);
            if ($diffInQuantity < 0) {
                $absoluteDiffInQuantity = abs($diffInQuantity);
                if ($absoluteDiffInQuantity > $productVariant->stock_quantity) {
                    Session::flash('error', 'The stock quantity is ' . $productVariant->stock_quantity . ' but the sale quantity is increased by ' . $absoluteDiffInQuantity);
                    return back();
                } else {
                    $newStock = $productVariant->stock_quantity - $absoluteDiffInQuantity;
                    $productVariant->update([
                        'stock_quantity' => $newStock,
                        'stock_status'   => $newStock == 0 ? 'out_of_stock' : 'in_stock',
                    ]);
                }
            } else {
                $newStock = $productVariant->stock_quantity + $diffInQuantity;

                $productVariant->update([
                    'stock_quantity' => $newStock,
                    'stock_status'   => 'in_stock',
                ]);
            }
        }

        $sale->update([
            'quantity' => $saleRequest->quantity,
            'sold_for' => $saleRequest->sold_for
        ]);

        return redirect(route('admin.sales.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return back();
    }
}
