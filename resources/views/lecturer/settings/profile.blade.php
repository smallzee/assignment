@extends('lecturer.layouts.app')
@section('lecturer')

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">User Profile</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i class="fa fa-home"></i>Home</a></li>
					<li>User Profile</li>
				</ul>
			</div>	
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h4>User Profile</h4>
						</div>
						<div class="widget-inner">
							<form class="edit-profile m-b30" method="POST" action="{{ route('lecturer_profile') }}" enctype="multipart/form-data">
								@csrf
								<div class="">
									<div class="form-group row">
										<div class="col-sm-10  ml-auto">
											<h3>1. Personal Details</h3>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Lecturer ID</label>
										<div class="col-sm-7">
											<input class="form-control" type="" readonly value="{{Auth::user()->matric_number}}">
											{{-- <span class="help">If you want your invoices addressed to a company. Leave blank to use your full name.</span> --}}
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Email</label>
										<div class="col-sm-7">
											<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{Auth::user()->email}}">
											@error('email')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">First Name</label>
										<div class="col-sm-7">
											<input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" value="{{Auth::user()->first_name}}">
											@error('first_name')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Last Name</label>
										<div class="col-sm-7">
											<input class="form-control @error('last_name') is-invalid @enderror" name="last_name" type="text" value="{{Auth::user()->last_name}}">
											@error('last_name')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Phone Number</label>
										<div class="col-sm-7">
											<input class="form-control @error('mobile') is-invalid @enderror" name="mobile" type="number" value="{{Auth::user()->mobile}}">
											@error('mobile')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
									
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Profile Picture</label>
										<div class="col-sm-7">
											<input class="form-control @error('avatar') is-invalid @enderror" type="file" name="avatar" accept="image/png, image/jpeg, image/jpg" max="50000">
											@error('avatar')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
									<div class="seperator"></div>
									
									<div class="form-group row">
										<div class="col-sm-10 ml-auto">
											<h3>2. Address</h3>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Address</label>
										<div class="col-sm-7">
											<input class="form-control @error('address') is-invalid @enderror" name="address" type="text" value="{{Auth::user()->address}}">
											@error('address')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">City</label>
										<div class="col-sm-7">
											<input class="form-control @error('city') is-invalid @enderror" name="city" type="text" value="{{Auth::user()->city}}">
											@error('city')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">State</label>
										<div class="col-sm-7">
											<input class="form-control @error('state') is-invalid @enderror" name="state" type="text" value="{{Auth::user()->state}}">
											@error('state')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
                </div>                                
								<div class="">
									<div class="">
										<div class="row">
											<div class="col-sm-2">
											</div>
											<div class="col-sm-7">
												<button type="submit" class="btn">Save changes</button>
												<button type="reset" class="btn-secondry">Cancel</button>
											</div>
										</div>
									</div>
								</div>
							</form>
							<form class="edit-profile" method="post" action="{{ route('lecturer-change-password') }}">
                                @csrf
								<div class="">
									<div class="form-group row">
										<div class="col-sm-10 ml-auto">
											<h3>4. Password</h3>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Current Password</label>
										<div class="col-sm-7">
											<input class="form-control @error('old_password') is-invalid @enderror" type="password" name="old_password" placeholder="Current password">
											@error('old_password')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">New Password</label>
										<div class="col-sm-7">
											<input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password" placeholder="New password">
											@error('new_password')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Re Type Password</label>
										<div class="col-sm-7">
											<input class="form-control @error('confirm_new_password') is-invalid @enderror" type="password" name="confirm_new_password" placeholder="Repeat new password">
											@error('confirm_new_password')
													<span class="invalid-feedback mb-2" role="alert" style="display: block">
															<strong>{{ $message }}</strong>
													</span>
											@enderror
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-2">
									</div>
									<div class="col-sm-7">
										<button type="submit" class="btn">Save changes</button>
										<button type="reset" class="btn-secondry">Cancel</button>
									</div>
								</div>
									
							</form>
						</div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>
		</div>
	</main>
@endsection