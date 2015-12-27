@extends('layouts.login')

@section('content')
	<div class="container">
		<div class="col-sm-offset-2 col-sm-8">
			<div class="panel panel-primary" style="margin: 120px auto;">
				<div class="panel-heading">
					Login
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<!-- New Task Form -->
					<form action="{{ url('login') }}" method="POST" class="form-horizontal">
						{{ csrf_field() }}

						<!-- E-Mail Address -->
						<div class="form-group">
							<label for="email" class="col-sm-3 control-label">E-Mail</label>

							<div class="col-sm-6">
								<input type="email" name="email" class="form-control" value="{{ old('email') }}">
							</div>
						</div>

						<!-- Password -->
						<div class="form-group">
							<label for="password" class="col-sm-3 control-label">Password</label>

							<div class="col-sm-6">
								<input type="password" name="password" class="form-control">
							</div>
						</div>

						<!-- Login Button -->
						<div class="form-group">
							<div class="col-sm-offset-5 col-sm-8">
								<button type="submit" class="btn btn-success">
									<i class="fa fa-btn fa-sign-in"></i>&nbsp Login
								</button>

							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection