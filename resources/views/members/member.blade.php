@extends('layouts.ministry')
@section('content')

<script>
  function editMember(id, first_name, middle_name, last_name, dob, civil_status, email, contact_number, position, status, purok_no, street_address, barangay, municipality, province, picture) {
    // Fill modal fields with member data
    document.getElementById('editMemberId').value = id;
    document.getElementById('editMemberForm').action = `/members/${id}`;
    document.getElementById('editFirstName').value = first_name;
    document.getElementById('editMiddleName').value = middle_name;
    document.getElementById('editLastName').value = last_name;
    document.getElementById('editDob').value = dob;
    document.getElementById('editCivilStatus').value = civil_status;
    document.getElementById('editEmail').value = email;
    document.getElementById('editContactNumber').value = contact_number;
    document.getElementById('editPosition').value = position;
    document.getElementById('editStatus').value = status;
    document.getElementById('editPurokNo').value = purok_no;
    document.getElementById('editStreetAddress').value = street_address;
    document.getElementById('editBarangay').value = barangay;
    document.getElementById('editMunicipality').value = municipality;
    document.getElementById('editProvince').value = province;

    const imageUrl = picture ? `/storage/${picture}` : 'default-image-path.jpg';
    document.getElementById('editMemberImage').src = imageUrl;
}

  </script>
  
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Ministry</h3>
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
                <a href="/member">Ministry</a>
            </li>
          
            
            
            
            </ul>
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
                 
                  <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                  <input type="hidden" id="status" name="status" value="Active" />
                  <div class="form-group">
                    <label for="uploadPicture">Upload Picture</label>
                    <input type="file" class="form-control" id="uploadPicture" name="picture" />
                  </div>

                  <!-- Personal Information -->
                  <h5 class="fw-bold mb-3">Personal Information</h5>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter First Name" required />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="middleName">Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middle_name" placeholder="Enter Middle Name" />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Enter Last Name" required />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required />
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
                        <input type="text" class="form-control" id="position" name="position" placeholder="Enter Ministry Role" />
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
                        <input type="text" class="form-control" id="streetAddress" name="street_address" placeholder="Enter Street Address" required />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="barangay">Barangay</label>
                        <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Enter Barangay" required />
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
                        <input type="text" class="form-control" id="province" name="province" placeholder="Enter Province" required />
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

<div class="modal fade" id="editMemberModal" tabindex="-1" aria-labelledby="editMemberLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMemberLabel">Edit Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method="POST" id="editMemberForm" enctype="multipart/form-data">
      @csrf
      @method('PUT')

          <input type="hidden" id="editMemberId" name="id">

          <div class="row">
              <div class="col-md-12 text-center">
                  <img id="editMemberImage" src="default-image-path.jpg" alt="Member Image" class="img-thumbnail mb-3" style="max-height: 200px;">
                  <div class="form-group">
                      <label for="editImage">Upload New Picture</label>
                      <input type="file" class="form-control" id="editImage" name="image">
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="editFirstName">First Name</label>
                <input type="text" class="form-control" id="editFirstName" name="first_name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editMiddleName">Middle Name</label>
                <input type="text" class="form-control" id="editMiddleName" name="middle_name">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editLastName">Last Name</label>
                <input type="text" class="form-control" id="editLastName" name="last_name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editDob">Date of Birth</label>
                <input type="date" class="form-control" id="editDob" name="dob">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editCivilStatus">Civil Status</label>
                <select class="form-control" id="editCivilStatus" name="civil_status">
                  <option value="Single">Single</option>
                  <option value="Married">Married</option>
                  <option value="Widowed">Widowed</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Contact Information -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="editEmail">Email Address</label>
                <input type="email" class="form-control" id="editEmail" name="email">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editContactNumber">Contact Number</label>
                <input type="text" class="form-control" id="editContactNumber" name="contact_number">
              </div>
            </div>
          </div>

          <!-- Position and Status -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="editPosition">Position</label>
                <input type="text" class="form-control" id="editPosition" name="position">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editStatus">Status</label>
                <select class="form-control" id="editStatus" name="status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Residence Address -->
          <h5 class="fw-bold mt-4">Residence Address</h5>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="editPurokNo">Purok No.</label>
                <input type="text" class="form-control" id="editPurokNo" name="purok_no">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editStreetAddress">Street Address</label>
                <input type="text" class="form-control" id="editStreetAddress" name="street_address">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editBarangay">Barangay</label>
                <input type="text" class="form-control" id="editBarangay" name="barangay">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editMunicipality">Municipality</label>
                <input type="text" class="form-control" id="editMunicipality" name="municipality">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editProvince">Province</label>
                <input type="text" class="form-control" id="editProvince" name="province">
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Ministry</h4>
                                <button
                                class="btn btn-primary btn-round ms-auto"
                                data-bs-toggle="modal" data-bs-target="#formModal"
                                >
                                <i class="fa fa-plus"></i>
                                New Ministry
                                </button>
                                <button
                                class="btn btn-primary btn-round "
                                data-bs-toggle="modal" data-bs-target="#formModal1"
                                >
                                <i class="fa fa-plus"></i>
                                New Ministry Role
                                </button>
                                
                            </div>
                        </div>
                        <div class="card-body">
                      

                        <div class="table-responsive">
                            <table
                            id="add-row"
                            class="display table table-striped table-hover"
                       
                            >
                            <thead>
                                <tr>
                                <th style="width: 50%"> Full Name </th>
                                <th style="width: 20%">Ministry Role</th>
                                <th style="width: 20%">Status</th>
                                
                                <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th style="width: 50%"> Full Name </th>
                                <th style="width: 20%">Position</th>
                                <th style="width: 20%">Status</th>
                                
                                <th style="width: 10%">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach ($members as $member)
                                <tr>
                                <td>  {{ $member->first_name }} {{ $member->middle_name }} {{ $member->last_name }}</td>
                                <td>{{ $member->position }}</td>
                                <td>{{ $member->status }}</td>

                                <td>
                                    <div class="form-button-action">
                                    <button
                                      type="button"
                                      class="btn btn-link btn-primary btn-lg"
                                      data-bs-toggle="modal"
                                      data-bs-target="#editMemberModal"
                                      onclick="editMember(
                                        '{{ $member->id }}',
                                        '{{ $member->first_name }}',
                                        '{{ $member->middle_name }}',
                                        '{{ $member->last_name }}',
                                        '{{ $member->dob }}',
                                        '{{ $member->civil_status }}',
                                        '{{ $member->email }}',
                                        '{{ $member->contact_number }}',
                                        '{{ $member->position }}',
                                        '{{ $member->status }}',
                                        '{{ $member->purok_no }}',
                                        '{{ $member->street_address }}',
                                        '{{ $member->barangay }}',
                                        '{{ $member->municipality }}',
                                        '{{ $member->province }}',
                                        '{{ $member->picture }}'
                                    )"
                                  >
                                      <i class="fa fa-edit"></i>
                                  </button>
                                    <button
                                        type="button"
                                        data-bs-toggle="tooltip"
                                        title="Move to Archive"
                                        class="btn btn-link btn-danger"
                                        data-original-title="Remove"
                                        onclick="window.location.href='/members/archive/{{ $member->id }}'"
                                    >
                                        <i class="fas fa-archive"></i>
                                    </button>
                                    </div>
                                </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
                

                
            </div>
    </div>
    <div class="modal fade" id="formModal1" tabindex="-1" aria-labelledby="newMemberModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newMemberModalLabel">New Ministry  Folder</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="page-inner">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                     
                      <form action="{{ route('member.ministry') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">
                      <input type="hidden" id="status" name="status" value="Active" />
                      
    
                      <!-- Personal Information -->
                      <h5 class="fw-bold mb-3">Ministry Name</h5>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="firstName">Ministry  Name:</label>
                            <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Enter Minstry Name" required />
                          </div>
                        </div>
                       
                      </div>
    
                      <!-- Contact Information -->
                     
    
                      <!-- Residence Address -->
                   
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





@include('layouts.footer')




@endsection


