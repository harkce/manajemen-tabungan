@extends('adminlte.app')
@section('title')
Transaksi
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
	<div class="col-lg-6">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Transaksi Baru</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<form method="post" action="{{ url('/transaction/add') }}">
			<div class="box-body">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label>Nomor Identitas</label>
					<input type="number" name="id" placeholder="Masukkan nomor identitas siswa" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Jenis Transaksi</label>
					<select class="form-control" name="type" required>
						<option selected disabled>Pilih jenis transaksi</option>
						<option value="1">Setor</option>
						<option value="0">Tarik</option>
					</select>
				</div>
				<div class="form-group">
					<label>Banyaknya</label>
					<input type="number" name="amount" placeholder="Banyaknya transaksi (Rp)" class="form-control" required>
				</div>
			</div>
			<div class="box-footer">
				<input type="submit" class="btn btn-success pull-right" value="Tambah Transaksi">
			</div>
			</form>
		</div>
	</div>
	<div class="col-lg-6">
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
							<th>Total Saldo</th>
							<th>Aktifitas Terakhir</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($savings as $saving)
						<tr>
							<th>{{ $saving->student->id }}</th>
							<th>{{ $saving->student->name }}</th>
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