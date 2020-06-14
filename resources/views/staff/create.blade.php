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
            <a href="{{route('staff.index')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>View Staff Info</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('staff.create')}}" class="nav-link active">
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
            <h1 class="m-0 text-dark">Add New Staff</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Add New Staff</li>
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
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Personal Information</h3>
                </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="container">
                  {!! Form::open(['action' => 'StaffController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                  @csrf
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        {{Form::label('title', 'Title')}}
                        {{Form::select('title', ['Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Miss.' => 'Miss.'], 'Mr.', ['class' => 'form-control form-control-sm'])}}
                      </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                          {{Form::label('firstname', 'Firstname')}}
                          {{Form::text('firstname', '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Firstname'])}}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                          {{Form::label('lastname', 'Lastname')}}
                          {{Form::text('lastname', '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Lastname'])}}
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                          {{Form::label('gender', 'Gender')}}
                          {{Form::select('gender', ['Male' => 'Male', 'Female' => 'Female', 'Non Specified' => 'Non Specified'], 'Male', ['class' => 'form-control form-control-sm'])}}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{Form::label('dob', 'Date Of Birth')}}
                          
                          {{Form::date('dob', \Carbon\Carbon::now(), ['class' => 'form-control form-control-sm'])}}
                         
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                          {{Form::label('cicil_status', 'Civil Status')}}
                          {{Form::select('civil_status', ['Single' => 'Single', 'Married' => 'Married', 'Divorced' => 'Divorced', 'Widowed' => 'Widowed'], 'Single', ['class' => 'form-control form-control-sm'])}}
                        </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('nationality', 'Nationality')}}
                            {{Form::select('nationality', ['Sinhale' => 'Sinhale', 'Sri Lankan Tamil' => 'Sri Lankan Tamil', 'Sri Lankan Moor' => 'Sri Lankan Moor', 'Indian Tamil' => 'Indian Tamil', 'Sri Lankan Malay' => 'Sri Lankan Malay', 'Burgher/
                            Eurasian' => 'Burgher/
                            Eurasian', 'Indian Moor' => 'Indian Moor'], 'Sri Lankan Tamil', ['class' => 'form-control form-control-sm'])}}
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('religion', 'Religion')}}
                            {{Form::select('religion', ['Buddhist' => 'Buddhist', 'Hindu' => 'Hindu', 'Islam' => 'Islam', 'Christian' => 'Christian', 'Other' => 'Other'], 'Other', ['class' => 'form-control form-control-sm'])}}
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                          {{Form::label('nic', 'NIC')}}
                          {{Form::text('nic', '', ['class' => 'form-control form-control-sm', 'placeholder' => 'NIC'])}}
                          </div>
                      </div>                     
                  </div>
                  <div class="row">
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('appointment_no', 'Appointment No.')}}
                            {{Form::text('appointment_no', '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Appointment No.'])}}
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('appointment_date', 'Appointment Date')}}
                            
                          {{Form::date('appointment_date', \Carbon\Carbon::now(), ['class' => 'form-control form-control-sm'])}}
                          </div>
                          
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                          {{Form::label('personal_file_no', 'Personal File No.')}}
                          {{Form::text('personal_file_no', '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Personal File No.'])}}
                          </div>
                      </div>                     
                  </div>
                  <div class="row">
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('recruitment_type', 'Recruitment Type')}}
                            {{Form::select('recruitment_type', ['Permanant' => 'Permanant', 'Temporary' => 'Temporary', 'Graduate Trainee' => 'Graduate Trainee'], 'Permanant', ['class' => 'form-control form-control-sm'])}}
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('officer_branch', 'Officer Branch')}}

                            {{Form::select('officer_branch', ['Administration Branch' => 'Administration Branch', 'Accounts Branch' => 'Accounts Branch', 'SSO Branch' => 'SSO Branch', 'Planning Branch' => 'Planning Branch', 'Land Branch' => 'Land Branch', 'Not Applicable' => 'Not Applicable'], 'Not Applicable', ['class' => 'form-control form-control-sm'])}}
                            
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                          {{Form::label('officer_subject', 'Officer Subject')}}
                          {{Form::text('officer_subject', '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Officer Subject'])}}
                          </div>
                      </div>                     
                  </div>
                  <div class="row">
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('designation', 'Designation')}}
                              <select class="form-control form-control-sm" name="designation" id="designation">
                                  @foreach ($designations as $designation) 
                                      <option value="{{$designation->name}}">
                                        {{$designation->name}}
                                      </option>
                                  @endforeach
                              </select>
                      </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('service', 'Service')}}
                            <select class="form-control form-control-sm" name="service" id="service">
                              @foreach ($services as $service) 
                                  <option value="{{$service->name}}">
                                    {{$service->name}}
                                  </option>
                              @endforeach
                          </select>
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('class', 'Class')}}
                            {{Form::select('class', ['Class I' => 'Class I', 'Class II' => 'Class II', 'Class III' => 'Class III'], 'Class III', ['class' => 'form-control form-control-sm'])}}
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('mobile_no', 'Mobile No')}}
                            {{Form::text('mobile_no', '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Mobile'])}}
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('landline_no', 'Landline No')}}
                            {{Form::text('landline_no', '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Landline'])}}
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                            {{Form::label('email', 'Email')}}
                            {{Form::email('email', '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Email'])}}
                          </div>
                      </div>
                  </div>   
                  <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('permanant_address', 'Permanant Address')}}
                            {{Form::textarea('permanant_address', '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Permanant Address', 'rows' => '5'])}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{Form::label('temporary_address', 'Temporary Address')}}
                            {{Form::textarea('temporary_address', '', ['class' => 'form-control form-control-sm', 'placeholder' => 'Temporary Address', 'rows' => '5'])}}
                        </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                          {{Form::label('profile_pic', 'Profile Picture')}}
                          {{Form::file('profile_pic')}}
                      </div>
                  </div>
                </div> 
                <div class="card-footer">          
                    {{Form::submit('Submit', ['class' =>  'btn btn-primary'])}}
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