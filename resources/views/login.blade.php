@extends('layout.mainlayout')
@section('content')		
<!-- Main Wrapper -->
<div class="main-wrapper">
			<div class="account-content">
				
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="{{url('index')}}"><img src="{{ URL::asset('/assets/img/logo.png')}}" style="width: 15%;"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Login</h3>
							<p class="account-subtitle">Access to our dashboard</p>
							
							<!-- Account Form -->
							<form method="POST" action="{{ route('login.custom') }}">
								@csrf
								<div class="form-group">
									<label>Email Address</label>
									<input type="text" placeholder="Email" id="Email" class="form-control" name="email" value="admin@chemtor.com">
									<div class="text-danger pt-2">
                                    	@error('0')
	                            			{{$message}}
	                                	@enderror
	                                	@error('email')
	                            			{{$message}}
	                                	@enderror
	                                </div>
								</div>
								<div class="form-group">
									<label>Password</label>
									<div class="pass-group">
										<input type="password" placeholder="Password" id="password" class="form-control pass-input " name="password" value="123456">
										<span class="fa fa-eye-slash toggle-password"></span>
										<div class="text-danger pt-2">
											@error('0')
												{{$message}}
											@enderror
		                                	@error('password')
		                            			{{$message}}
		                                	@enderror
		                            	</div>
									</div>
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit">Login</button>
								</div>
								{{-- <div class="account-footer">
									<p>Don't have an account yet? <a href="{{url('register')}}">Register</a></p>
								</div> --}}
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
@endsection