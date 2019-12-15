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
        <a href="#" class="d-block">{{auth()->user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="/dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt text-primary"></i>
            <p>
              Dashboard
              
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-address-card text-warning"></i>
            <p>
              Staff Management
              <i class="fas fa-angle-left right"></i>
              <!--<span class="badge badge-info right">6</span>-->
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{route('staff.index')}}" class="nav-link active">
              <i class="nav-icon fas fa-table text-warning"></i>
              <p>View Staff Info</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('staff.create')}}" class="nav-link">
              <i class="nav-icon fas fa-user-plus text-warning"></i>
              <p>Add Staff Info</p>
            </a>
          </li>
          </ul>
        </li>
        
        
        <li class="nav-header">ACCOUNT SETTINGS</li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Extras
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pages/examples/login.html" class="nav-link">
                <i class="fas fa-key nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>            
            
          </ul>
        </li>

        <li class="nav-header">SYSTEM SETTINGS</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
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
        </li>

        <li class="nav-item">
          <a href="https://adminlte.io/docs/3.0" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>Documentation</p>
          </a>
        </li>
        
        
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link" 
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt text-danger nav-icon "></i>
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Staff Management</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Staff Management</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col"></div>
            <div class="col-10">
                @include('inc.messages')
          </div>
          <div class="col"></div>
        </div>
    <!-- Small boxes (Stat box) -->
    <div class="row">        
      <!-- ./col -->
      <div class="col"></div>
      <div class="col-10">
        <!-- staff list -->
        <div class="card">
            <div class="card-header">
              @if(count($staff) > 0)
                  <h3 class="card-title">Staff List</h3>
                  <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Profile picture</th>
                          <th>Fullname</th>
                          <th>Designation</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                  @foreach($staff as $employers)     
                    <tr>
                      <td>{{$employers->id}}</td>
                      <td><img src="{{ Storage::url("profile_pics/{$employers->profile_pic}") }}" alt="User Avatar" 
                        class="img-size-50 img-circle mr-3">
                      </td>
                      <td>{{$employers->firstname}} {{$employers->lastname}}</td>
                      <td>{{$employers->designation}}</td>
                      <td><a class="btn btn-app btn-success" href="{{route('staff.edit', $employers->id)}}">
                          <i class="fas fa-edit"></i> Edit
                        </a>
                      <a class="btn btn-app btn-primary" href="{{route('staff.show', $employers->id)}}">
                            <i class="fas fa-eye"></i> View Profile
                          </a>
                            {!! Form::open(['action' => ['StaffController@destroy', $employers->id], 'method' => 'POST', 'onclick' => 'return confirm(\'Are you sure?\')']) !!}
                              {{Form::hidden('_method', 'DELETE')}}
                              {{Form::submit('Delete', ['class' =>  'btn btn-app btn-danger'])}}
                              <i class="fas fa-edit"></i>
                            {!! Form::close() !!}
                      </td>
                    </tr>           
                  @endforeach
                      </tbody>
                    </table>
                  </div>
                    @else
                        <div class="card-body">
                            <p>No Staff Data found!</p>
                        </div>
                    @endif
                </div>
                <!-- /.card-header -->
                <!-- /.card-body -->
              </div>
              <!-- /.card -->     
      </div>
      <div class="col"></div>
    </div>
    </div>
@endsection