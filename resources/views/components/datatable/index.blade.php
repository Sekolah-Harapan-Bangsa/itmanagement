<div class="table-responsive">
	<table class="table table-bordered table-hover my-2" id="datatable" style="width: 100%">
		{{ $slot }}
	</table>
</div>

@push('js')
<script>
	$(document).ready(function() {
		new DataTable('#datatable', {
			lengthMenu: [5, 10, 15, {label: "All", value: -1}],
			language: {
				url: "/assets/lang/id.json",
			},
		});
	});
</script>
@endpush
