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
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                    
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview menu-open">
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
                  <a href="{{route('staff.index')}}" class="nav-link active">
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
                </ul>
              </li>
              
              
              <li class="nav-header">ACCOUNT SETTINGS</li>
          
          <li class="nav-item">
            <a href="{{route('change.passwordview')}}" class="nav-link">
              <i class="fas fa-key nav-icon"></i>
              <p>Change Password</p>
            </a>
          </li>
          @if(Gate::allows('admin'))
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
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('services.create')}}" class="nav-link">
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
                <i class="fas fa-sign-out-alt nav-icon "></i>
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
            <h1 class="m-0 text-dark">Edit Service History</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Edit Service History</li>
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
              <!-- Staff search card -->
              
              <!-- staff search end -->

                  <div class="card card-info">
                      <div class="card-header">
                      <h3 class="card-title">Service History Information of {{$servicehistories->staff->firstname}}</h3>
                      </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="container">
                            <div class="row">
                                {!! Form::model($servicehistories, ['method' => 'PATCH', 'route' => ['servicehistories.update', $servicehistories->id]]) !!}
                                <table class="table table-hover" id="dependant_table">
                                    <thead>
                                      <tr>
                                        <th>Workplace</th>
                                        <th>Designation</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Service Name</th>
                                        <th>Service Class</th>
                                      </tr>
                                    </thead>
                                    <tbody id="dependant_table">
                                      <tr>
                                        <td>
                                            {{Form::text('workplace', null, ['class' => 'form-control form-control-sm'])}}</td>
                                        <td>
                                          <select class="form-control form-control-sm" name="designation" id="designation">
                                          <option value="{{$servicehistories->designation}}" selected="selected">{{$servicehistories->designation}}</option>
                                            @foreach ($designations as $designation) 
                                                <option value="{{$designation->name}}">
                                                  {{$designation->name}}
                                                </option>
                                            @endforeach
                                        </select></td>
                                        <td>
                                            {{Form::date('start_date', \Carbon\Carbon::parse($servicehistories->start_date), ['class' => 'form-control form-control-sm'])}}</td>
                                        <td>
                                            {{Form::date('end_date', \Carbon\Carbon::parse($servicehistories->end_date), ['class' => 'form-control form-control-sm'])}}</td>
                                        <td><select class="form-control form-control-sm" name="service" id="service">
                                        <option value="{{$servicehistories->service_name}}" selected="selected">{{$servicehistories->service_name}}</option>
                                          @foreach ($services as $service) 
                                              <option value="{{$service->name}}">
                                                {{$service->name}}
                                              </option>
                                          @endforeach
                                      </select>
                                            </td>
                                        <td>
                                            {{Form::select('class', ['Class I' => 'Class I', 'Class II' => 'Class II', 'Class III' => 'Class III'], null, ['class' => 'form-control form-control-sm'])}}</td>
                                      </tr> 
                                      <tr>
                                    <td colspan='6'>
                                    
                                    {{Form::checkbox('current_wp', '1')}} Currently work here
                                    
                                    </td>
                                    </tr>    
                                    </tbody>
                                  </table>
                            </div>
                            
                        </div>
                        <div class="card-footer">          
                            {{Form::submit('Submit', ['class' =>  'btn btn-info float-left'])}}
                            {!! Form::close() !!}

                            {!! Form::open(['action' => ['ServiceHistoriesController@destroy', $servicehistories->id], 'method' => 'POST', 'onclick' => 'return confirm(\'Are you sure?\')']) !!}
                              {{Form::hidden('_method', 'DELETE')}}
                              {{Form::submit('Delete', ['class' =>  'btn btn-danger '])}}
                              
                            {!! Form::close() !!}
                        </div>
                            
                      
                    </div>
              <!-- col end -->    
              </div>
                <!-- /.card-body -->
                <div class="col"></div>
              </div>
            
                
                
            <!-- row end -->    
            </div>
<!-- containerfluid -->

<!-- wrapper end -->
</div>


@endsection