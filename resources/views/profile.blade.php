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
          <a href="/dashboard" class="nav-link">
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
          <a href="https://adminlte.io/docs/3.0" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>About</p>
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
          <h1 class="m-0 text-dark">User Profile</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Profile</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

<section class="content">
  <div class="container-fluid">
    <div class="row">        
    <div class="col"></div>
    <div class="col-10">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Welcome, {{auth()->user()->name}}!</h3>
        </div>
        <div class="container">
            <p><b>Your account details</b></p>
            <div class="row">
                
                <div class="col-md-3">
                    Email:<br />
                    System Admin privileges: <br />
                    Account Type: <br />
                    Account Permissions: <br />
                </div>
                <div class="col-md-3">
                {{ $user->email }}<br />
                @if($user->admin == 1)
                Yes<br />
                @else
                No<br />
                @endif

                @if($user->role == "user")
                Standard User <br/>
                You can view staff data only.
                @elseif($user->role == "manager")
                Admin <br/>
                You can view, edit staff data and generate reports.
                @elseif($user->role == "admin")
                System Admin <br/>
                You have full control over the system
                @endif
                </div>
                
            </div>
        </div>
    </div>
    </div>
    <div class="col"></div>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
</div>
@endsection