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
          <div class="col-md-2">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                src="{{ Storage::url("profile_pics/{$staff->profile_pic}") }}"
                       alt="User profile picture" width="500" height="600">
                </div>

              <h3 class="profile-username text-center">{{$staff->title}} {{$staff->firstname}} {{$staff->lastname}}</h3>

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
          <div class="col-md-10">
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
                      <div class="row">
                      <div class="col-4">
                        
                        <b>Firstname: </b><br />
                        <b>Lastname: </b><br />
                        <b>Gender: </b><br />
                        <b>Date of Birth: </b><br />
                        <b>Civil Status: </b><br />
                        <b>Religion: </b><br />
                        <b>Nationality: </b><br />
                        <b>NIC No: </b><br />
                        <b>Designation: </b><br />
                        <b>Service: </b><br />
                        <b>Class: </b><br />                        
                        <b>Appointment Date: </b><br />
                        <b>Appointment No: </b><br />

                        <b>Personal File No: </b><br />
                        <b>Officer Subject: </b><br />
                        <b>Officer Branch: </b><br />
                        <b>Officer Category: </b><br />
                        <b>W&OP No: </b><br />
                        <b>Increment Date: </b><br />
                        <b>Salary Code: </b><br />
                        <b>Banking Details: </b><br />
                        <b>Total Service: </b><br />
                        <b>Retirement Date: </b><br />
                      </div>

                      <div class="col-8">
                        
                        {{$staff->firstname}}<br />
                        {{$staff->lastname}}<br />
                        {{$staff->gender}}<br />
                        {{$staff->dob}}<br />
                        {{$staff->civil_status}}<br />
                        {{$staff->religion}}<br />
                        {{$staff->nationality}}<br />
                        {{$staff->nic}}<br />
                        {{$staff->designation}}<br />
                        {{$staff->service}}<br />
                        {{$staff->class}}<br />
                        {{$staff->appointment_date}}<br />
                        {{$staff->appointment_no}}<br />
                        {{$staff->personal_file_no}}<br />
                        {{$staff->officer_subject}}<br />
                        {{$staff->officer_branch}}<br />
                        {{$staff->recruitment_type}}<br />
                        {{$staff->wop_no}}<br />
                        {{$staff->increment_date}}<br />
                        {{$staff->salary_code}}<br />
                        Account No: {{$staff->bank_acc_no}} ({{$staff->bank_name}} - {{$staff->bank_branch}})<br />
                        {{ $exp }}<br />
                        {{$retirement_date}}<br />
                      </div> 
                      </div>
                      </div>

      
                  
                    </div>
                     
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-dependants" role="tabpanel" aria-labelledby="custom-tabs-two-dependants-tab">
                      @foreach($dependants as $dep)
                      <div class="row">
                      <div class="col">
                      <div class="row">
                      <div class="col-2">
                        <b>Fullname:</b><br /> 
                        <b>Relationship: </b><br />
                        <b>Date Of Birth: </b><br />
                        <b>NIC No: </b><br />
                        <b>Designation: </b><br/>
                        <b>Workplace: </b><br />
                      </div>
                      <div class="col-4">
                      {{$dep->firstname}} {{$dep->lastname}}<br />
                      {{$dep->relationship}}<br />
                      {{$dep->dob}}<br />
                      {{$dep->nic}}<br />
                      {{$dep->designation}}<br />
                      {{$dep->workplace}}<br />
                      </div>
                      </div>
                      </div>
                      </div>
                      <hr>
                      @endforeach
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-service_history" role="tabpanel" aria-labelledby="custom-tabs-two-service_history-tab">
                      @foreach($service_histories as $serv)
                      <div class="row">
                      <div class="col">
                      <div class="row">
                      <div class="col-4">
                        @if($serv->current_wp == 1)
                        <b><u>Workplace (Current):</u> </b><br />
                        @else
                        <b>Workplace: </b><br />
                        @endif
                      <b>Designation: </b><br />
                      <b>Start Date: </b><br />
                      <b>End Date: </b><br />
                      <b>Duration: </b><br />
                      
                      <b>Service Name: </b><br />
                      <b>Service Class: </b><br />
                      </div>

                      <div class="col-4">
                      {{$serv->workplace}}<br />
                      {{$serv->designation}}<br />
                      {{$serv->start_date}}<br />
                      {{$serv->end_date}}<br/>
                      {{Carbon\Carbon::parse($serv->start_date)->diff(Carbon\Carbon::parse($serv->end_date))->format('%y Year(s), %m Month(s) and %d Day(s)')}}
                      <br />
                      {{$serv->service_name}}<br />
                      {{$serv->service_class}}<br />
                      </div>
                      </div>
                      </div>
                      </div>
                      <hr>
                    @endforeach
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-examinations" role="tabpanel" aria-labelledby="custom-tabs-two-examinations-tab">
                    @foreach($staff->exams as $exam)
                      <b>Title: </b>{{$exam->title}}<br />
                      <b>Completed On: </b>{{$exam->completed_date}}<br />
                      <b>Remarks: </b>{{$exam->remarks}}<br />
                      <hr>
                  @endforeach
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-qualifications" role="tabpanel" aria-labelledby="custom-tabs-two-qualifications-tab">
                    <div class="row">
                      <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                          <tr>
                            <th class="sorting_asc">Title</th>
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
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-contact" role="tabpanel" aria-labelledby="custom-tabs-two-contact-tab">
                  <div class="row">
                      <div class="col">
                      <div class="row">
                      <div class="col-4">                                         
                      <b>Landline No: </b><br />
                      <b>Mobile No: </b><br />
                      <b>Permanant Address: </b><br />
                      <b>Temporary Address: </b><br />
                      <b>Email: </b><br />
                      </div>

                      <div class="col-8">
                      {{$staff->landline_no}}<br />
                      {{$staff->mobile_no}}<br />
                      {{$staff->permanant_address}}<br />
                      {{$staff->temporary_address}}<br />
                      {{$staff->email}}<br />
                      </div>
                      </div>
                      
                      
                      </div>

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
