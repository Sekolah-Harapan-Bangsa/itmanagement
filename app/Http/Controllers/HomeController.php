<?php

namespace App\Http\Controllers;

use App\Commodity;
use App\CommodityLocation;
use App\Repositories\CommodityAcquisitionRepository;
use App\Repositories\CommodityRepository;

class HomeController extends Controller
{
    public function __construct(
        public CommodityRepository $commodityRepository,
        public CommodityAcquisitionRepository $commodityAcquisitionRepository
    ) {
        $this->middleware('auth');
    }

    public function index()
    {
        $commodity_order_by_price = Commodity::inRandomOrder()->take(5)->get();

        // Hitung jumlah barang berdasarkan kondisi
        $commodity_condition_count = $this->commodityRepository->countCommodityCondition()->map(function ($commodity) {
            return collect([
                'condition_name' => $commodity->getConditionName(),
                'count' => (int) $commodity->count,
            ]);
        });

        // Total ringkasan angka untuk tampilan card
        $commodity_counts = [
            'commodity_in_total' => $commodity_condition_count->sum('count') ?? 0,
            'commodity_in_good_condition' => $commodity_condition_count->firstWhere('condition_name', 'Baik')['count'] ?? 0,
            'commodity_in_not_good_condition' => $commodity_condition_count->firstWhere('condition_name', 'Kurang Baik')['count'] ?? 0,
            'commodity_in_heavily_damage_condition' => $commodity_condition_count->firstWhere('condition_name', 'Rusak Berat')['count'] ?? 0,
        ];

        // Data lain untuk grafik
        $commodity_each_year_of_purchase_count = $this->commodityRepository->countCommodityEachYear();
        $commodity_each_location_count = CommodityLocation::has('commodities')->withCount('commodities')->get();

        $commodity_by_commodity_acquisition_count = $this->commodityAcquisitionRepository
            ->countCommodityByCommodityAcquisition();

        $commodity_by_material_count = $this->commodityRepository->countCommodityByMaterial()->map(function ($commodity) {
            return collect([
                'name' => $commodity->material,
                'material_count' => (int) $commodity->count,
            ]);
        });

        $commodity_by_brand_count = $this->commodityRepository->countCommodityByBrand()->map(function ($commodity) {
            return collect([
                'name' => $commodity->brand,
                'brand_count' => (int) $commodity->count,
            ]);
        });

        // Siapkan data chart untuk blade
        $charts = [
            'commodity_condition_count' => [
                'categories' => $commodity_condition_count->pluck('condition_name')->toArray(),
                'series' => $commodity_condition_count->pluck('count')->map(fn($v) => (int) $v)->toArray(),
            ],
            'commodity_each_year_of_purchase_count' => [
                'categories' => $commodity_each_year_of_purchase_count->pluck('year_of_purchase')->toArray(),
                'series' => $commodity_each_year_of_purchase_count->pluck('count')->map(fn($v) => (int) $v)->toArray(),
            ],
            'commodity_each_location_count' => [
                'categories' => $commodity_each_location_count->pluck('name')->toArray(),
                'series' => $commodity_each_location_count->pluck('commodities_count')->map(fn($v) => (int) $v)->toArray(),
            ],
            'commodity_by_commodity_acquisition_count' => [
                'categories' => $commodity_by_commodity_acquisition_count->pluck('name')->toArray(),
                'series' => $commodity_by_commodity_acquisition_count->pluck('commodities_count')->map(fn($v) => (int) $v)->toArray(),
            ],
            'commodity_by_material_count' => [
                'categories' => $commodity_by_material_count->pluck('name')->toArray(),
                'series' => $commodity_by_material_count->pluck('material_count')->map(fn($v) => (int) $v)->toArray(),
            ],
            'commodity_by_brand_count' => [
                'categories' => $commodity_by_brand_count->pluck('name')->toArray(),
                'series' => $commodity_by_brand_count->pluck('brand_count')->map(fn($v) => (int) $v)->toArray(),
            ],
        ];

        return view('home', compact(
            'commodity_order_by_price',
            'commodity_counts',
            'charts'
        ));
    }
}
