<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\RatedBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class RatingController extends BaseController
{
    /**
     * Get rating for a product
     * GET /api/ratings?product_id=1
     */
    public function index(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $rating = Rating::where('product_id', $request->product_id)->first();

        return response()->json([
            'success' => true,
            'data' => $rating ?? [
                'rating' => 0,
                'count' => 0,
            ],
        ]);
    }

    /**
     * Store or update rating
     * POST /api/ratings
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_id' => ['required', 'exists:products,id'],
                'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            ]);

            $userId = Auth::id();

            // Check if user already rated
            $userRating = RatedBy::where('product_id', $request->product_id)
                ->where('user_id', $userId)
                ->first();

            if ($userRating) {
                $userRating->update([
                    'rating' => $request->rating,
                ]);
            } else {
                RatedBy::create([
                    'product_id' => $request->product_id,
                    'user_id' => $userId,
                    'rating' => $request->rating,
                ]);
            }

            // Recalculate rating
            $avgRating = RatedBy::where('product_id', $request->product_id)->avg('rating');
            $count = RatedBy::where('product_id', $request->product_id)->count();

            Rating::updateOrCreate(
                ['product_id' => $request->product_id],
                [
                    'rating' => round($avgRating, 1),
                    'count' => $count,
                ]
            );

            return response()->json([
                // 'success' => true,
                // 'message' => 'Rating submitted successfully',
                // 'data' => [
                    'rating' => (float) round($avgRating, 1),
                    'count' => (int) $count,
                // ],
            ]);
        } catch (Throwable $t) {
            return $this->sendError($t->getMessage());
        }
    }

    /**
     * Show a single rating record
     * GET /api/ratings/{rating}
     */
    public function show(Rating $rating)
    {
        return response()->json([
            'success' => true,
            'data' => $rating,
        ]);
    }

    /**
     * Update rating (alias of store)
     */
    public function update(Request $request, Rating $rating)
    {
        return $this->store($request);
    }

    /**
     * Remove user's rating
     * DELETE /api/ratings/{product_id}
     */
    public function destroy($productId)
    {
        $userId = Auth::id();

        RatedBy::where('product_id', $productId)
            ->where('user_id', $userId)
            ->delete();

        // Recalculate
        $avgRating = RatedBy::where('product_id', $productId)->avg('rating');
        $count = RatedBy::where('product_id', $productId)->count();

        if ($count > 0) {
            Rating::updateOrCreate(
                ['product_id' => $productId],
                [
                    'rating' => round($avgRating, 1),
                    'count' => $count,
                ]
            );
        } else {
            Rating::where('product_id', $productId)->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Rating removed',
        ]);
    }
}
