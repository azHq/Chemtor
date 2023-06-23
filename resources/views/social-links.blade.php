<?php $page="social-links";?>
@extends('layout.mainlayout')
@section('content')		
	<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid">
					@component('components.breadcrumb')                
	                  @slot('title') Settings  @endslot
	                  @slot('li_1') Dashboard @endslot
	                  @slot('li_2') Settings @endslot
	                  @slot('li_3') <i class="fa fa-cog" aria-hidden="true"></i> @endslot
	                @endcomponent
				
					<div class="row">
						<div class="col-lg-12">

							@component('components.settings-page')  
							@endcomponent

							<div class="row">
						<div class="col-lg-6 col-md-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Social Link Settings</h5>
								</div>
								<div class="card-body pt-0">
									<form>
										<div class="settings-form">
											<div class="links-info">
												<div class="row form-row links-cont">
													<div class="form-group form-placeholder d-flex">
														<button class="btn social-icon">
															<i class="feather-facebook"></i>
														</button>
														<input type="text" class="form-control" placeholder="https://www.facebook.com">
														<a href="#" class="btn trash">
															<i class="feather-trash-2"></i>
														</a>
													</div>
												</div>
											</div>
											<div class="links-info">
												<div class="row form-row links-cont">
													<div class="form-group form-placeholder d-flex">
														<button class="btn social-icon">
															<i class="feather-twitter"></i>
														</button>
														<input type="text" class="form-control" placeholder="https://www.twitter.com">
														<a href="#" class="btn trash">
															<i class="feather-trash-2"></i>
														</a>
													</div>
												</div>
											</div>
											<div class="links-info">
												<div class="row form-row links-cont">
													<div class="form-group form-placeholder d-flex">
														<button class="btn social-icon">
															<i class="feather-youtube"></i>
														</button>
														<input type="text" class="form-control" placeholder="https://www.youtube.com">
														<a href="#" class="btn trash">
															<i class="feather-trash-2"></i>
														</a>
													</div>
												</div>
											</div>
											<div class="links-info">
												<div class="row form-row links-cont">
													<div class="form-group form-placeholder d-flex">
														<button class="btn social-icon">
															<i class="feather-linkedin"></i>
														</button>
														<input type="text" class="form-control" placeholder="https://www.linkedin.com">
														<a href="#" class="btn trash">
															<i class="feather-trash-2"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group text-end">
											<a href="javascript:void(0);" class="btn add-links">
												<i class="fa fa-plus me-1"></i> Add More
											</a>
										</div>
										<div class="form-group mb-0">
											<div class="settings-btns">
												<button type="submit" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Submit</button>
												<button type="submit" class="btn btn-secondary btn-rounded">Cancel</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
							
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Wrapper -->
			
		</div>
		<!-- /Main Wrapper -->
@component('components.modal-popup')                
@endcomponent
@component('components.theme-settings')                
@endcomponent		
@endsection
	  