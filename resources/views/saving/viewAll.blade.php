@extends('adminlte.app')
@section('title')
Tabungan Siswa
@endsection

@section('page_css')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">

<style type="text/css">
.noline {
	display:inline;
    margin:0px;
    padding:0px;
}
</style>
@endsection

@section('page_js')
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
$(function() {
	$("#tabungan").DataTable();
});
</script>
@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Daftar Tabungan</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				<table id="tabungan" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Siswa</th>
							<th>Total Pemasukan</th>
							<th>Total Pengambilan</th>
							<th>Total Saldo</th>
							<th>Aktifitas Terakhir</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($savings as $saving)
						<tr>
							<th>{{ $saving->student->id }}</th>
							<th>{{ $saving->student->name }}</th>
							<th>{{ $saving->getTotalMasuk($saving->student->id) }}</th>
							<th>{{ $saving->getTotalKeluar($saving->student->id) }}</th>
							<th>{{ $saving->getTotalSaldo($saving->student->id) }}</th>
							<th>{{ $saving->updated_at->format('d M Y') }}</th>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection