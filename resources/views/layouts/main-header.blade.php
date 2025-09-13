
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">

							<a ><img src="{{URL::asset('assets/img/brand/M.png')}}" class="logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
					</div>
					<div class="main-header-right">
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}" class=""></div>
											<div class="mr-3 my-auto">
												<h6>{{Auth::user()->name}} </h6><span> Owner</span>
											</div>
										</div>
									</div>
									<form method="POST" action="{{ route('logout') }}">
										@csrf
										<a class="dropdown-item" href="route('logout')"
												onclick="event.preventDefault();
															this.closest('form').submit();"><i class="bx bx-log-out"></i> تسجيل الخروج</a>
									</form>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
