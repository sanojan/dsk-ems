@extends('layouts.adminlte')

@section('sidebar')
<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
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
            <a href="{{route('staff.index')}}" class="nav-link">
              <i class="nav-icon fas fa-table text-warning"></i>
              <p>View Staff Info</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('staff.create')}}" class="nav-link active">
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
          <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
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
            <h1 class="m-0 text-dark">Add New Exam</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New Exam</li>
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
            <div class="card card-secondary">
                <div class="card-header">
                <h3 class="card-title">Examinations of {{$staff->firstname}}</h3>
                </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="container">
                  {!! Form::open(['action' => 'ExamsController@store', 'method' => 'POST']) !!}
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        {{Form::label('title', 'Title')}}
                        {{Form::select('title', ['Efficiency Bar Exam' => 'Efficiency Bar Exam', 'Language Proficiency - Tamil' => 'Language Proficiency - Tamil', 'Language Proficiency - Sinhala' => 'Language Proficiency - Sinhala', 'Language Proficiency - English' => 'Language Proficiency - English'], '', ['class' => 'form-control'])}}
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{Form::label('completed_date', 'Completed On')}}
                          <div class="input-group date">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                              <i class="far fa-calendar-alt">
                              </i>
                              </span>
                            </div>
                          {{Form::date('completed_date', \Carbon\Carbon::now())}}
                          </div>
                          {{Form::hidden('staff_id', $staff->id, ['class' => 'form-control'])}}
                        </div>
                    </div>
                  </div>          
                </div> 
                <div class="card-footer">          
                    {{Form::submit('Submit', ['class' =>  'btn btn-secondary'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
                      
                  </div>
              <!-- col end -->    
              
                <!-- /.card-body -->
                <div class="col"></div>
              </div>
            
                
                
            <!-- row end -->    
            </div>
<!-- containerfluid -->

<!-- wrapper end -->
</div>


@endsection