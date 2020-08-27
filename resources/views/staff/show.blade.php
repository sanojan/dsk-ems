@extends('layouts.adminlte')

  <!-- Main Sidebar Container -->
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
                       alt="User profile picture" width="500" height="600">
                </div>

              <h3 class="profile-username text-center">{{$staff->title}} {{$staff->firstname}}</h3>

                <p class="text-muted text-center">{{$staff->designation}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Age</b> <a class="float-right">{{\Carbon\Carbon::parse($staff->dob)->age}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Total Leaves</b> <a class="float-right">Not Updated!</a>
                  </li>
                  <li class="list-group-item">
                    <b>Tasks</b> <a class="float-right">Not Updated!</a>
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
                      <table class="table table-sm table-hover">
                      <tbody>
                        <tr>
                        <td>Name with Initials:</td>
                        <td>{{$staff->firstname}}</td>
                        </tr>
                        <tr>
                        <td>Fullname:</td>
                        <td>{{$staff->lastname}}</td>
                        </tr>
                        <tr>
                        <td>Gender:</td>
                        <td>{{$staff->gender}}</td>
                        </tr>
                        <tr>
                        <td>Date of Birth:</td>
                        <td>{{$staff->dob}}</td>
                        </tr>
                        <tr>
                        <td>Civil Status:</td>
                        <td>{{$staff->civil_status}}</td>
                        </tr>
                        <tr>
                        <td>Religion:</td>
                        <td>{{$staff->religion}}</td>
                        </tr>
                        <tr>
                        <td>Nationality:</td>
                        <td>{{$staff->nationality}}</td>
                        </tr>
                        <tr>
                        <td>NIC No:</td>
                        <td>{{$staff->nic}}</td>
                        </tr>
                        <tr>
                        <td>Designation:</td>
                        <td>{{$staff->designation}}</td>
                        </tr>
                        <tr>
                        <td>Service:</td>
                        <td>{{$staff->service}}</td>
                        </tr>
                        <tr>
                        <td>Class:</td>
                        <td>{{$staff->class}}</td>
                        </tr>
                        <tr>
                        <td>Appointment Date:</td>
                        <td>{{$staff->appointment_date}}</td>
                        </tr>
                        <tr>
                        <td>Appointment No: </td> 
                        <td>{{$staff->appointment_no}}</td> 
                        </tr>
                        <tr>
                        <td>Personal File No:</td>    
                        <td>{{$staff->personal_file_no}}</td>
                        </tr>
                        <tr>
                        <td>Officer Branch:</td>
                        <td>{{$staff->officer_branch}}</td>
                        </tr>
                        <td>Officer Category:</td>
                        <td>{{$staff->recruitment_type}}</td>
                        </tr>
                        <tr>
                        <td>W&OP No:</td>
                        <td>{{$staff->wop_no}}</td>
                        </tr>
                        <tr>
                        <td>Officer Subject:</td>
                        <td>{{$staff->officer_subject}}</td>
                        </tr>
                        <tr>
                        <td>Increment Date:</td>
                        <td>{{$staff->increment_date}}</td>
                        </tr>
                        <tr>
                        <td>Salary Code:</td>
                        <td>{{$staff->salary_code}}</td>
                        </tr>
                        <tr>
                        <td>Banking Details:</td>
                        <td>Account No: {{$staff->bank_acc_no}} ({{$staff->bank_name}} - {{$staff->bank_branch}})</td>
                        </tr>
                        <td>Total Service:</td>
                        <td>{{ $exp }}</td>
                        </tr>
                        <tr>
                        <td>Retirement Date:</td>
                        <td>{{$retirement_date}}</td>
                        </tr>
                        </tbody>
                        </table>  
                  </div>

                  <div class="tab-pane fade" id="custom-tabs-two-dependants" role="tabpanel" aria-labelledby="custom-tabs-two-dependants-tab">
                  <table class="table table-sm table-hover">
                  <thead>
                  <tr>
                  <th>Name with Initials</th>
                  <th>Fullname</th>
                  <th>Relationship</th>
                  <th>Date Of Birth</th>
                  <th>NIC No</th>
                  <th>Designation</th>
                  <th>Workplace</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($dependants as $dep)
                      <tr>
                      <td>{{$dep->firstname}}</td>
                      <td>{{$dep->lastname}}</td>
                      <td>{{$dep->relationship}}</td>
                      <td>{{$dep->dob}}</td>
                      <td>{{$dep->nic}}</td>
                      <td>{{$dep->designation}}</td>
                      <td>{{$dep->workplace}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  </table>
                  </div>
            
                  <div class="tab-pane fade" id="custom-tabs-two-service_history" role="tabpanel" aria-labelledby="custom-tabs-two-service_history-tab">
                  <table class="table table-sm table-hover">
                  <thead>
                  <tr>
                  <th>Workplace</th>
                  <th>Designation</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Duration</th>
                  <th>Service Name</th>
                  <th>Service Class</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($service_histories as $serv)                   
                  <tr>
                  <td>{{$serv->workplace}}</td>
                  <td>{{$serv->designation}}</td>  
                  <td>{{$serv->start_date}}</td>
                  <td>@if($serv->current_wp == 1)
                      Up to date
                      @else
                      {{$serv->end_date}}
                      @endif
                  </td>
                  <td>{{Carbon\Carbon::parse($serv->start_date)->diff(Carbon\Carbon::parse($serv->end_date))->format('%y Year(s), %m Month(s) and %d Day(s)')}}
                  </td>
                  <td>{{$serv->service_name}}</td>
                  <td>{{$serv->service_class}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </div>
              
                  <div class="tab-pane fade" id="custom-tabs-two-examinations" role="tabpanel" aria-labelledby="custom-tabs-two-examinations-tab">
                  <table class="table table-sm table-hover">
                  <thead>
                  <tr>
                  <th>Title</th>
                  <th>Completed On</th>
                  <th>Remarks</th>
                  </tr>
                  </thead>
                  <tbody>  
                  @foreach($staff->exams as $exam)
                  <tr>
                  <td>{{$exam->title}}</td>
                  <td>{{$exam->completed_date}}</td>
                  <td>{{$exam->remarks}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </div>

                  <div class="tab-pane fade" id="custom-tabs-two-qualifications" role="tabpanel" aria-labelledby="custom-tabs-two-qualifications-tab">
                      <table class="table table-sm table-hover">
                        <thead>
                          <tr>
                            <th>Title</th>
                            <th>Medium</th>
                            <th>Institute</th>
                            <th>Stream/Field</th>
                            <th>Center No</th>
                            <th>Index No</th>
                            <th>Subject</th>
                            <th>Grade</th>
                            <th>Attempt</th>
                            <th>Duration</th>
                            <th>Effective Date</th>
                            <th>Year</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($qualifications as $qualification)
                          <tr>
                            <td>{{$qualification->title}}</td>
                            <td>{{$qualification->medium}}</td>
                            <td>{{$qualification->institute}}</td>
                            <td>{{$qualification->field}}</td>
                            <td>{{$qualification->center_no}}</td>
                            <td>{{$qualification->index_no}}</td>
                            <td>{{$qualification->subject}}</td>
                            <td>{{$qualification->grade}}</td>
                            <td>{{$qualification->attempt}}</td>
                            <td>{{$qualification->duration}}</td>
                            <td>{{$qualification->effective_date}}</td>
                            <td>{{$qualification->year}}</td>
                          </tr>   
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  <div class="tab-pane fade" id="custom-tabs-two-contact" role="tabpanel" aria-labelledby="custom-tabs-two-contact-tab">
                  <table class="table table-sm table-hover">
                  <tbody>
                  <tr>
                  <td>Landline No:</td>
                  <td>{{$staff->landline_no}}</td>
                  </tr>
                  <tr>
                  <td>Mobile No:</td>
                  <td>{{$staff->mobile_no}}</td>
                  </tr>
                  <tr>
                  <td>Permanant Address:</td>
                  <td>{{$staff->permanant_address}}</td>
                  </tr>
                  <tr>
                  <td>Temporary Address:</td>
                  <td>{{$staff->temporary_address}}</td>
                  </tr>
                  <tr>
                  <td>Email:</td>
                  <td>{{$staff->email}}</td>
                  </tr>
                  </tbody>
                  </table>
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
