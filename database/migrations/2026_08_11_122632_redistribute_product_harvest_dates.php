<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Redistributes harvest_dates relative to Carbon::now() so freshness bars display a realistic mix
     * of Green (Fresh: 0-1 days), Yellow (Good: 2-3 days), and Red (Fast Sale: 4+ days).
     */
    public function up(): void
    {
        $products = DB::table('products')->orderBy('id')->get();
        $today = Carbon::now();

        // Specific subDays offset map by index to guarantee a beautiful mix across the 20 products
        // [Grade A: 0-1 days], [Grade B: 1-3 days], [Grade C: 3-5 days]
        $offsetMap = [
            0  => 0, // Fresh Harvest (0 days) - Green
            1  => 1, // Fresh Harvest (1 day)  - Green
            2  => 0, // Fresh Harvest (0 days) - Green
            3  => 1, // Fresh Harvest (1 day)  - Green
            4  => 0, // Fresh Harvest (0 days) - Green
            5  => 1, // Fresh Harvest (1 day)  - Green
            6  => 1, // Fresh Harvest (1 day)  - Green
            7  => 2, // Good Condition (2 days) - Yellow
            8  => 2, // Good Condition (2 days) - Yellow
            9  => 3, // Good Condition (3 days) - Yellow
            10 => 1, // Fresh Harvest (1 day)  - Green
            11 => 2, // Good Condition (2 days) - Yellow
            12 => 3, // Good Condition (3 days) - Yellow
            13 => 2, // Good Condition (2 days) - Yellow
            14 => 3, // Good Condition (3 days) - Yellow
            15 => 4, // Fast Sale (4 days) - Red
            16 => 5, // Fast Sale (5 days) - Red
            17 => 4, // Fast Sale (4 days) - Red
            18 => 5, // Fast Sale (5 days) - Red
            19 => 4, // Fast Sale (4 days) - Red
        ];

        foreach ($products as $idx => $product) {
            $daysOffset = $offsetMap[$idx % count($offsetMap)];
            
            // Adjust based on grade if present
            if ($product->quality_grade === 'A') {
                $daysOffset = $idx % 2; // 0 or 1 day
            } elseif ($product->quality_grade === 'B') {
                $daysOffset = ($idx % 3) + 1; // 1, 2, or 3 days
            } elseif ($product->quality_grade === 'C') {
                $daysOffset = ($idx % 3) + 3; // 3, 4, or 5 days
            }

            $newHarvestDate = $today->copy()->subDays($daysOffset)->format('Y-m-d');

            DB::table('products')->where('id', $product->id)->update([
                'harvest_date' => $newHarvestDate,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Additive migration — no destructive revert needed
    }
};

