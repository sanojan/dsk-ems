@extends('layouts.adminlte')

@section('sidebar')
<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
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
                </ul>
              </li>
              
              
              <li class="nav-header">ACCOUNT SETTINGS</li>
              
              <li class="nav-item">
                <a href="{{route('change.passwordview')}}" class="nav-link">
                  <i class="fas fa-key nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
      
              <li class="nav-header">SYSTEM SETTINGS</li>
              <li class="nav-item has-treeview menu-open">
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
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('services.create')}}" class="nav-link active">
                      <i class="fas fa-tools nav-icon"></i>
                      <p>Services</p>
                    </a>
                  </li>            
                  
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.users.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Users
                  </p>
                </a>
              </li>
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
  <!-- messages -->
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
            <h1 class="m-0 text-dark">Add New Service</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New Service</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">        
            <!-- ./col -->
            <div class="col"></div>
            <div class="col-10">
              <!-- existing designations card -->
              
              <!-- existing designations end -->
                  <div class="card card-dark">
                      <div class="card-header">
                          <h3 class="card-title">Services</h3>
                      </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="container">
                            {!! Form::open(['action' => 'ServiceController@store', 'method' => 'POST']) !!}
                                  <div class="form-group">
                                    {{Form::label('name', 'Enter service name')}}
                                    {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Service'])}}
                                  </div>
                        </div>
                        <div class="card-footer">          
                            {{Form::submit('Add', ['class' =>  'btn btn-dark'])}}
                        </div>
                            {!! Form::close() !!}
                      
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Existing services on system</h3>
                      </div>
                      <!-- /.card-header -->
                      @if(count($services) > 0)
                      <div class="card-body p-0">
                          <div class="container">
                              <ul>
                            
                              @foreach ($services as $service) 
                                <li>{{$service->name}}
                                  
                                  {!! Form::open(['action' => ['ServiceController@destroy', $service->id], 'method' => 'POST']) !!}
                                  {{Form::hidden('_method', 'DELETE')}}
                                  <a href="{{route('services.edit', $service->id)}}" class="btn btn-default btn-xs">Edit</a>  
                                  {{Form::submit('Delete', ['class' => 'btn btn-danger btn-xs', 'onclick' => 'return confirm(\'Are you sure?\')'])}}
                                {!! Form::close() !!}
                                
                              </li>
                              @endforeach
                              </ul>
                          </div>
                      </div>
                      @else
                        <div class="card-body">
                        <p>No services found!</p>
                        </div>
                      @endif
                      <!-- /.card-body -->
                    </div>
                    {{$services->links()}}
              <!-- col end -->    
              </div>
                <!-- /.card-body -->
                <div class="col"></div>
              
            
                
                
            <!-- row end -->    
            </div>
<!-- containerfluid -->

<!-- wrapper end -->
</div>


@endsection