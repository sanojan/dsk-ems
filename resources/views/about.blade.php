@extends('layouts.adminlte')

@section('sidebar')
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">DSK-EMS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
      <img src="{{ Storage::url('profile_pics/noimage.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{route('users.profile')}}" class="d-block">{{auth()->user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/dashboard" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-address-card"></i>
            <p>
              Staff Management
              <i class="fas fa-angle-left right"></i>
              <!--<span class="badge badge-info right">6</span>-->
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('staff.index')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>View Staff Info</p>
            </a>
          </li>
          @if(Gate::allows('admin') || Gate::allows('manager'))
          <li class="nav-item">
            <a href="{{route('staff.create')}}" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>Add Staff Info</p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="{{route('reports.index')}}" class="nav-link">
              <i class="nav-icon fas fa-file-pdf"></i>
              <p>Generate Reports</p>
            </a>
          </li>
          @endif
          </ul>
        </li>
        
        
     

        <li class="nav-header">ACCOUNT SETTINGS</li>
              
              <li class="nav-item">
                <a href="{{route('change.passwordview')}}" class="nav-link">
                  <i class="fas fa-key nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              @if(Gate::allows('admin') || Gate::allows('manager'))
              <li class="nav-header">SYSTEM SETTINGS</li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-file-invoice"></i>
                  <p>
                    Form Data
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('designations.create')}}" class="nav-link">
                      <i class="fas fa-briefcase nav-icon"></i>
                      <p>Designations</p>
                    </a>
                  </li>            
                  
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('services.create')}}" class="nav-link">
                      <i class="fas fa-tools nav-icon"></i>
                      <p>Services</p>
                    </a>
                  </li>            
                  
                </ul>
              </li>
              @endif
              @if(Gate::allows('admin'))
              <li class="nav-item">
                <a href="{{route('admin.users.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Users
                  </p>
                </a>
              </li>
              @endif
              <li class="nav-item">
          <a href="{{route('about')}}" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>About</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-question-circle"></i>
            <p>Help</p>
          </a>
        </li>
        
        
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link" 
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
           </form>
          
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
@endsection

@section('content')
<div class="content-wrapper">
  <div class="row">
          <div class="col"></div>
          <div class="col-10">
              @include('inc.messages')
          </div>
          <div class="col"></div>
  </div>
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">About</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">About</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
    <div class="row">
      <!-- Small boxes (Stat box) -->
      <!-- /.container-fluid -->
      <div class="card">
              <div class="card-header">
                
                  
                    About DS-EMS
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                I (Mr. Alagurasa Sanojan) who has been serving as an ICT Assistant at Divisional Secretariat, Kalmunai for over a year developed this employee management system (EMS) for the usage of divisinal secretariats.
                One thing I have noticed since the first day at my job, Administration section of almost every divisional secretariat is lacking efficient management of data. The main reason was, usage of manual file based data management. Even though Divisional secretariats are dealing with enormous type of data, when it comes to Admin area or branch the officers ,specially management service officers have to deal with personal files of all the employees. In file based system when there's a need for providing staff details they have to go through bunch of files in the racks and it is a time consuming job. Therefore, I came up with the idea of developing a web based EMS to store and manage staff data at divisional secretariats and started the developing work on August 2019. After, all most six months I was able to present a EMS with basic functionalities. I introduced this system as a trial at Kalmunai Divisional Secretariat Administration branch to store staff details during this period I had hosted this system on a local server. In September 2020 I recieved the approval from Mr.Nazeer the divisional secretary and my reporting officer to use this system as a official way to manage data during day to day tasks. Now, this system is up and running on a shared hosted server and can be accessed from anywhere in the world over internet. In the mean time I have added siginificant feature such as generating reports from the data, controlling users in the system and along the way I am looking to add staff leave and salary management to this EMS. Finally, I hope this system will serve to get better results at our divisional secretariat and that will lead to introduce this to all other divisions in our district.
                <br />
                <i>Feel free to share your thoughts on this project and send your suggestions on the sytem</i>
                <br />
                <i>If you have good knowledge on web applications development and want to collaborate on this project please send your details to dsk.ict@gmail.com</i>
              </div>
              <!-- /.card-body -->
        </div>
        </div>
    </div>
  </section>
</div>
@endsection