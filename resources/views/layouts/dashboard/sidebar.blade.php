<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{asset('build/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{ Auth::user()->username}}</p>
				<a href="#"><i class="fa fa-circle text-success"></i> En linea</a>
			</div>
		</div>
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">Navegacion Principal</li>
			<li>
				<a href="{{ URL('/home' )}}" class="sub">
					<i class="fa fa-dashboard text-white"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{ URL('/users' )}}" class="sub">
					<i class="fa fa-user text-white"></i>
					<span>Usuarios</span>
				</a>
			</li>
			<li>
				<a href="{{ URL('/vehiculos' )}}" class="sub">
					<i class="fa fa-home text-white"></i>
					<span>Vehiculos</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>