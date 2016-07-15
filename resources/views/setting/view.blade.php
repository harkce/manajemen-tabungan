@extends('adminlte.app')
@section('title')
Pengaturan
@endsection

@section('content')
<div class="row">
	<div class="col-lg-6">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-warning"></i> Ganti Password</h3>
			</div>
			<form method="post" action="{{ url('setting') }}">
			<div class="box-body">
				<div class="form-group">
					<label>Password baru</label>
					<input class="form-control" type="password" name="password" placeholder="Masukkan password baru" required>
				</div>
				<div class="form-group">
					<label>Konfirmasi password</label>
					<input class="form-control" type="password" name="password_verify" placeholder="Masukkan kembali password baru" required>
				</div>
			</div>
			<div class="box-footer">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id" value="1">
				<input type="submit" class="btn btn-success pull-right" value="Ganti Password">
			</div>
			</form>
		</div>
	</div>
</div>
@endsection