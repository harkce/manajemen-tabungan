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
.tfoot input {
	width: 100%;
    padding: 3px;
    box-sizing: border-box;
}
</style>
@endsection

@section('page_js')
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#transaksi tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#transaksi').DataTable();
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>
@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Riwayat Transaksi</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
				<table id="transaksi" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>No</th>
							<th>Nama Siswa</th>
							<th>Jenis Transaksi</th>
							<th>Banyaknya</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($transactions as $transaction)
						<tr>
							<th>{{ $transaction->created_at->format('d M Y') }}</th>
							<th>{{ $transaction->student->id }}</th>
							<th>{{ $transaction->student->name }}</th>
							<th>@if ($transaction->type) Setor @else Ambil @endif</th>
							<th>{{ $transaction->amount }}</th>
							<th>
								<form method="post" action="{{ url('transaction') }}" class="noline">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="_method" value="delete">
									<input type="hidden" name="id" value="{{ $transaction->id }}">
									<button type="submit" class="btn btn-danger" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></button>
								</form>
							</th>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Tanggal</th>
							<th>No</th>
							<th>Nama Siswa</th>
							<th>Jenis Transaksi</th>
							<th>Banyaknya</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection