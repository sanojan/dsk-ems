@extends('layouts.adminlte')

  <!-- Main Sidebar Container -->
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <div class="row">
          <div class="col"></div>
          <div class="col-10">
              @include('inc.messages')
        </div>
        <div class="col"></div>
      </div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active">Staff Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                src="{{ Storage::url("profile_pics/{$staff->profile_pic}") }}"
                       alt="User profile picture">
                </div>

              <h3 class="profile-username text-center">{{$staff->firstname}} {{$staff->lastname}}</h3>

                <p class="text-muted text-center">{{$staff->designation}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Age</b> <a class="float-right">{{\Carbon\Carbon::parse($staff->dob)->age}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Total Leaves</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Tasks</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-danger btn-block disabled"><b>View Leaves</b></a>
                <a href="#" class="btn btn-success btn-block disabled"><b>View Salary</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
            <!-- /.card -->
          </div>

          <!-- /.col -->
          <div class="col-md-9">
              <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-personal-tab" data-toggle="pill" href="#custom-tabs-two-personal" role="tab" aria-controls="custom-tabs-two-personal" aria-selected="true">Personal Info</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-dependants-tab" data-toggle="pill" href="#custom-tabs-two-dependants" role="tab" aria-controls="custom-tabs-two-dependants" aria-selected="false">Dependants</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-service_history-tab" data-toggle="pill" href="#custom-tabs-two-service_history" role="tab" aria-controls="custom-tabs-two-service_history" aria-selected="false">Service History</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-examinations-tab" data-toggle="pill" href="#custom-tabs-two-examinations" role="tab" aria-controls="custom-tabs-two-examinations" aria-selected="false">Examinations</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-qualifications-tab" data-toggle="pill" href="#custom-tabs-two-qualifications" role="tab" aria-controls="custom-tabs-two-qualifications" aria-selected="false">Qualifications</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-two-contact-tab" data-toggle="pill" href="#custom-tabs-two-contact" role="tab" aria-controls="custom-tabs-two-contact" aria-selected="false">Contact Info</a>
                    </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-personal" role="tabpanel" aria-labelledby="custom-tabs-two-personal-tab">
                    <div class="row">
                      <div class="col">
                        <b>Title: </b>{{$staff->title}}<br />
                        <b>Firstname: </b>{{$staff->firstname}}<br />
                        <b>Lastname: </b>{{$staff->lastname}}<br />
                        <b>Gender: </b>{{$staff->gender}}<br />
                        <b>Date of Birth: </b>{{$staff->dob}}<br />
                        <b>Civil Status: </b>{{$staff->civil_status}}<br />
                        <b>Religion: </b>{{$staff->religion}}<br />
                        <b>Nationality: </b>{{$staff->nationality}}<br />
                        <b>NIC No: </b>{{$staff->nic}}<br />
                        
                      </div>
                      <div class="col">
                        <b>Designation: </b>{{$staff->designation}}<br />
                        <b>Service: </b>{{$staff->service}}<br />
                        <b>Class: </b>{{$staff->class}}<br />
                        <b>Joined Date: </b><br />
                        <b>Total Service: </b>
                        {{ $exp }}<br />
                        <b>Retirement Date: </b>{{$retirement_date}}<br />
                      </div>
                    </div>
                     
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-dependants" role="tabpanel" aria-labelledby="custom-tabs-two-dependants-tab">
                      @foreach($dependants as $dep)
                        <b>{{$dep->firstname}} {{$dep->lastname}}</b><br />
                        <hr>
                        <b>Relationship: </b>{{$dep->relationship}}<br />
                        <b>Date Of Birth: </b>{{$dep->dob}}<br />
                        <b>Designation: </b>{{$dep->designation}}<br/>
                        <b>Workplace: </b>{{$dep->workplace}}<br /><br />
                      @endforeach
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-service_history" role="tabpanel" aria-labelledby="custom-tabs-two-service_history-tab">
                      @foreach($service_histories as $serv)
                      <b>Workplace: </b>{{$serv->workplace}}<br />
                      <b>Designation: </b>{{$serv->designation}}<br />
                      <b>Branch: </b>{{$serv->branch}}<br/>
                      <b>Start Date: </b>{{$serv->start_date}}<br/>
                      <b>End Date: </b>{{$serv->end_date}}<br />
                      <b>Duration: </b>
                      @php  
                        $end = \Carbon\Carbon::parse($serv->end_date);
                        $start = \Carbon\Carbon::parse($serv->start_date)
                      @endphp
                      {{$end->diffInYears($start)}} Years<br />
                      <b>Service Name: </b>{{$serv->service_name}}<br />
                      <b>Service Class: </b>{{$serv->service_class}}<br />
                      <hr>
                    @endforeach
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-examinations" role="tabpanel" aria-labelledby="custom-tabs-two-examinations-tab">
                    @foreach($staff->exams as $exam)
                      <b>Title: </b>{{$exam->title}}<br />
                      <b>Completed On: </b>{{$exam->completed_date}}<br />
                      <hr>
                  @endforeach
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-qualifications" role="tabpanel" aria-labelledby="custom-tabs-two-qualifications-tab">
                    @foreach($staff->qualifications as $qualification)
                      <b>Title: </b>{{$qualification->title}}<br />
                      <b>Field: </b>{{$qualification->field}}<br />
                      <b>Medium: </b>{{$qualification->medium}}<br />
                      <b>Duration: </b>{{$qualification->duration}}<br />
                      <b>Effective Date: </b>{{$qualification->effective_date}}<br />
                      <b>School/College/University: </b>{{$qualification->institute}}<br />
                      <hr>
                  @endforeach
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-contact" role="tabpanel" aria-labelledby="custom-tabs-two-contact-tab">
                      <b>Landline No: </b>+94{{$staff->landline_no}}<br />
                      <b>Mobile No: </b>+94{{$staff->mobile_no}}<br />
                      <b>Permanant Address: </b>{{$staff->permanant_address}}<br />
                      <b>Temporary Address: </b>{{$staff->temporary_address}}<br />
                      <b>Email: </b>{{$staff->email}}<br />
                   </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
