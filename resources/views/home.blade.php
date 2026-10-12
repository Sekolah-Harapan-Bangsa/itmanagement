<x-layout>
	<x-slot name="title">Dashboard</x-slot>
	<x-slot name="page_heading">Dashboard</x-slot>

	{{-- Ringkasan Kondisi Barang --}}
	<div class="row">
		@php
			$cards = [
				['label' => 'Total Barang', 'count' => $commodity_counts['commodity_in_total'], 'icon' => 'fa-columns', 'bg' => 'primary'],
				['label' => 'Kondisi Baik', 'count' => $commodity_counts['commodity_in_good_condition'], 'icon' => 'fa-check-circle', 'bg' => 'success'],
				['label' => 'Kondisi Rusak Ringan', 'count' => $commodity_counts['commodity_in_not_good_condition'], 'icon' => 'fa-exclamation-circle', 'bg' => 'warning'],
				['label' => 'Kondisi Rusak Berat', 'count' => $commodity_counts['commodity_in_heavily_damage_condition'], 'icon' => 'fa-times-circle', 'bg' => 'danger'],
			];
		@endphp

		@foreach($cards as $card)
		<div class="col-lg-3 col-md-6 col-sm-6 col-12">
			<div class="card card-statistic-1">
				<div class="card-icon bg-{{ $card['bg'] }}">
					<i class="fas fa-fw {{ $card['icon'] }}"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>{{ $card['label'] }}</h4>
					</div>
					<div class="card-body">
						{{ $card['count'] }}
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>

	{{-- Grafik Kondisi & Barang Termahal --}}
	<div class="row">
		<div class="col-md-6 col-lg-8">
			<div class="card">
				<x-bar-chart 
					chartTitle="Grafik Barang Berdasarkan Kondisi"
					chartID="chartCommodityCondition"
					:series="$charts['commodity_condition_count']['series']"
					:categories="$charts['commodity_condition_count']['categories']"
					:colors="['#47C363', '#FFA426', '#FC544B']"
				/>
			</div>
		</div>

		<div class="col-md-6 col-lg-4">
			<div class="card">
				<div class="card-header">
					<h4>5 Barang Termahal</h4>
				</div>
				<div class="card-body">
					@foreach($commodity_order_by_price as $order_by_price)
						<ul class="list-unstyled list-unstyled-border">
							<li class="media">
								<div class="media-body">
									@can('detail barang')
									<button data-id="{{ $order_by_price->id }}"
											class="float-right btn btn-info btn-sm show-modal"
											data-toggle="modal" data-target="#show_commodity">Detail</button>
									@endcan
									<div class="media-title">{{ $order_by_price->name }}</div>
									<span class="text-small text-muted">
										Harga: Rp{{ $order_by_price->indonesian_currency($order_by_price->price) }}
									</span>
								</div>
							</li>
						</ul>
					@endforeach

					@can('lihat barang')
					<div class="text-center pt-1 pb-1">
						<a href="{{ route('barang.index') }}" class="btn btn-primary btn-lg btn-round">
							Lihat Semua Barang
						</a>
					</div>
					@endcan
				</div>
			</div>
		</div>
	</div>

	{{-- Grafik Tambahan --}}
	<div class="row">
        <div class="col-12 col-lg-7 mb-4">
            <x-bar-chart
                chartTitle="Grafik Jumlah Barang Berdasarkan Tahun Pembelian"
                chartID="chartCommodityCountEachYear"
                :series="$charts['commodity_each_year_of_purchase_count']['series']"
                :categories="$charts['commodity_each_year_of_purchase_count']['categories']"
            />
        </div>
        <div class="col-12 col-lg-5 mb-4">
            <x-pie-chart
                chartTitle="Grafik Jumlah Barang Berdasarkan Perolehan"
                chartID="chartCommodityByCommodityAcquisitionCount"
                :series="$charts['commodity_by_commodity_acquisition_count']['series']"
                :categories="$charts['commodity_by_commodity_acquisition_count']['categories']"
            />
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 col-md-6 mb-4">
            <x-pie-chart
                chartTitle="Grafik Jumlah Barang Berdasarkan Material"
                chartID="chartCommodityByMaterial"
                :series="$charts['commodity_by_material_count']['series']"
                :categories="$charts['commodity_by_material_count']['categories']"
            />
        </div>
        <div class="col-12 col-md-6 mb-4">
            <x-pie-chart
                chartTitle="Grafik Jumlah Barang Berdasarkan Merk"
                chartID="chartCommodityByBrand"
                :series="$charts['commodity_by_brand_count']['series']"
                :categories="$charts['commodity_by_brand_count']['categories']"
            />
        </div>
    </div>
    
    <div class="row">
        <div class="col-12 mb-4">
            <x-bar-chart
                chartTitle="Grafik Jumlah Barang Berdasarkan Ruangan"
                chartID="chartCommodityCountEachLocation"
                :series="$charts['commodity_each_location_count']['series']"
                :categories="$charts['commodity_each_location_count']['categories']"
            />
        </div>
    </div>

	{{-- Modal dan JS --}}
	@push('modal')
		@include('commodities.modal.show')
	@endpush

	@push('js')
		@include('_script')
	@endpush
</x-layout>
