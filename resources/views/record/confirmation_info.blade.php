@extends('layouts.header')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Confirmands Information</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="/">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/confirmation">Confirmation of {{ $confirmationYear }} Records</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="/confirmation/{{  $confirmationID }}">Confirmands Information</a>
                </li>
            </ul>
        </div>

        <!-- Baptism Record Information -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Confirmands Record Details</h5>
                <div class="d-flex align-items-center">
                                <h5 class="card-title"></h5>
                                <a
                                    href="{{ url('confirmation_certificate/' . $confirmationRecord->id) }}"
                                    class="btn btn-secondary btn-round ms-auto"
                                >
                                    <i class="fa fa-eye"></i>
                                    View Certificate
                                </a>
                                <button
                                class="btn btn-primary btn-round ms-2"
                                data-bs-toggle="modal" data-bs-target="#formModal"
                                >
                                <i class="fa fa-plus"></i>
                               Add into Ministry
                                </button>
                            </div>
                            <br>
                <div class="table-responsive"><!-- Book and Record Info -->
                    <table class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th colspan = '2'>Page No: {{ $confirmationRecord->page_no }}/Record Code: {{ $confirmationRecord->record_code }}/Series Year No: {{ $confirmationRecord->series_year_no }} </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="width: 15%"><strong>Name:</strong></td>
                            <td>{{ $confirmationRecord->child_first_name }} {{ $confirmationRecord->child_middle_name }} {{ $confirmationRecord->child_last_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Date of Birth:</strong></td>
                            <td>{{ $confirmationRecord->child_dob }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Place of Birth:</strong></td>
                            <td>{{ $confirmationRecord->child_city }}, {{ $confirmationRecord->child_province }}</td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Father's Name:</strong></td>
                            <td>{{ $confirmationRecord->father_first_name }} {{ $confirmationRecord->father_middle_name }} {{ $confirmationRecord->father_last_name }}</td>
                        </tr>
                        
                        <tr>
                            <td style="width: 15%"><strong>Mother's Name:</strong></td>
                            <td>{{ $confirmationRecord->mother_first_name }} {{ $confirmationRecord->mother_middle_name }} {{ $confirmationRecord->mother_last_name }}</td>
                        </tr>
                        
                        <tr>
                            <td style="width: 15%"><strong>Residence:</strong></td>
                            <td>{{ $confirmationRecord->purok_no }},{{ $confirmationRecord->street_address }},{{ $confirmationRecord->barangay }},{{ $confirmationRecord->residence_city }}, {{ $confirmationRecord->residence_province }}</td>
                        </tr>
                        
                        <tr>
                            <td colspan = '2'><strong>Sponsors</strong></td>
                            
                        </tr>

                    
                            <tr>
                                <td style="width: 15%"><strong>Sponsor's Name:</strong></td>
                                <td> {{ $confirmationRecord->godparent_first_name }} {{ $confirmationRecord->godparent_middle_name }} {{ $confirmationRecord->godparent_last_name }}</td>
                            </tr>
                            
                        
                        <tr>
                            <td style="width: 15%"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Priest/Minister</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="width: 15%"><strong>Date of Confirmation</strong></td>
                            <td>{{ $confirmationRecord->confirmation_date}}</td>
                        </tr>
                            
                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="newMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newMemberModalLabel">New Ministry Registration Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="page-inner">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                   
                    <form action="{{ route('member.bapminis') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    <input type="hidden" id="status" name="status" value="Active" />
                    <div class="form-group" hidden>
                      <label for="uploadPicture">Upload Picture</label>
                      <input type="file" class="form-control" id="uploadPicture" name="picture" />
                    </div>
  
                    <!-- Personal Information -->
                    <h5 class="fw-bold mb-3">Personal Information</h5>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="firstName">First Name</label>
                          <input type="text" class="form-control" id="firstName" name="first_name" value="{{ $confirmationRecord->child_first_name }}" placeholder="{{ $confirmationRecord->child_first_name }}" required />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="middleName">Middle Name</label>
                          <input type="text" class="form-control" id="middleName" name="middle_name" value="{{ $confirmationRecord->child_middle_name }}" placeholder="{{ $confirmationRecord->child_middle_name }}" />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="lastName">Last Name</label>
                          <input type="text" class="form-control" id="lastName" name="last_name" value="{{ $confirmationRecord->child_last_name }}" placeholder="{{ $confirmationRecord->child_last_name }}" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="dob">Date of Birth</label>
                          <input type="date" class="form-control" id="dob" name="dob"
                          value="{{ $confirmationRecord->child_dob }}" required />
                   
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="civilStatus">Civil Status</label>
                          <select class="form-control" id="civilStatus" name="civil_status" required>
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="age">Age</label>
                          <input type="number" class="form-control" id="age" name="age" placeholder="Enter Age" required />
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="gender">Gender</label>
                          <select class="form-control" id="gender" name="gender" required>
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="position">Ministry Role</label>
                          <select class="form-control" id="gender" name="position" id="">
                            @foreach ($ministries as $min )
                            <option >{{$min->ministry}}</option>
                            @endforeach
                           
                          </select>
                        </div>
                      </div>
                    </div>
  
                    <!-- Contact Information -->
                    <h5 class="fw-bold mb-3">Contact Information</h5>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="email">Email Address</label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Address" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="contactNumber">Contact Number</label>
                          <input type="text" class="form-control" id="contactNumber" name="contact_number" placeholder="Enter Contact Number" required />
                        </div>
                      </div>
                    </div>
  
                    <!-- Residence Address -->
                    <h5 class="fw-bold mb-3">Residence Address</h5>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="purokNo">Purok No.</label>
                          <input type="text" class="form-control" id="purokNo" name="purok_no" placeholder="Enter Purok No." required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="streetAddress">Street Address</label>
                          <input type="text" class="form-control" id="streetAddress" name="street_address" value="{{$confirmationRecord->street_address}}" placeholder="{{$confirmationRecord->street_address}}" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="barangay">Barangay</label>
                          <input type="text" class="form-control" id="barangay" name="barangay" value="{{$confirmationRecord->barangay}}" placeholder="$confirmationRecord->barangay" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="municipality">Municipality</label>
                          <input type="text" class="form-control" id="municipality" name="municipality" placeholder="Enter Municipality" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="province">Province</label>
                          <input type="text" class="form-control" id="province" name="province" value="{{ $confirmationRecord->residence_province }}" placeholder="{{ $confirmationRecord->residence_province }}" required />
                        </div>
                      </div>
                    </div>
  
                    <!-- Submit and Cancel buttons -->
                    <div class="form-group mt-4">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                  </form>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Duplicate Member',
        text: '{{ session("error") }}',
    });
</script>
@endif

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session("success") }}',
    });
</script>
@endif
@include('layouts.footer')

@endsection
