@extends('layouts.header')
@section('content')

<script>
  function editVolunteer(id, name,email,password,type) {
      // Fill modal fields with volunteer data
      document.getElementById('editVolunteerId').value = id
      document.getElementById('editVolunteerForm').action = `/user/update/${id}`;
      document.getElementById('Name').value = name;
      document.getElementById('Email').value = email;
      document.getElementById('type').value = type;

     
  }
</script>
<script>
  function validatePassword(event) {
      let password = document.getElementById("newPassword").value;
      let confirmPassword = document.getElementById("confirmPassword").value;
      let passwordField = document.getElementById("newPassword");
      let confirmPasswordField = document.getElementById("confirmPassword");
      let errorText = document.getElementById("passwordError");

      if (password !== confirmPassword) {
          errorText.style.display = "block"; // Show error message
          passwordField.style.border = "2px solid red"; // Highlight in red
          confirmPasswordField.style.border = "2px solid red"; // Highlight in red
          event.preventDefault(); // Prevent form submission
          return false;
      } else {
          errorText.style.display = "none"; // Hide error message
          passwordField.style.border = ""; // Reset border
          confirmPasswordField.style.border = ""; // Reset border
          return true; // Allow form submission
      }
  }
</script>



<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3"></h3>
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
                <a href="/volunteer"></a>
            </li>
          
            
            
            
            </ul>
        </div>

      
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="newMemberModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMemberModalLabel">New  User Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                 
                <form action="{{ route('user.store') }}" onsubmit="return validatePassword(event)" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">
                    
                        
                     

                        <!-- Personal Information -->
                        <h5 class="fw-bold mb-3">User Information</h5>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="firstName">Name</label>
                              <input type="text" class="form-control" id="firstName" name="name" placeholder="Enter First Name" required />
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="middleName">Email</label>
                              <input type="email" class="form-control" id="middleName" name="email" placeholder="Enter Middle Name" />
                            </div>
                          </div>
                        
                          <div class="col-md-5">
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="password">
                                <small id="passwordError" class="text-danger" style="display:none;">Passwords do not match!</small>
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password">
                            </div>
                        </div>
                        
                        
                        </div>

                          <!-- Position and Status -->
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
                  <label for="editVolunteerPosition">Position</label>
                  <select name="type" id="">
                    <option value="1">Super Admin</option>
                    <option value="2">Admin</option>
                  </select>
              </div>
          </div>
      </div>

                        <!-- Submit and Cancel buttons -->
                        <div class="form-group mt-4">
                          <button type="submit" class="btn btn-primary">Submit</button>
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
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

<div class="modal fade" id="editVolunteerModal" tabindex="-1" aria-labelledby="editMemberLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMemberLabel">Edit Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="" method="POST" onsubmit="return validatePassword(event)" id="editVolunteerForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" id="editVolunteerId" name="id">

       

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="editVolunteerFirstName">Name</label>
                    <input type="text" class="form-control" id="Name" name="name">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="editVolunteerMiddleName">Email</label>
                    <input type="text" class="form-control" id="Email" name="email">
                </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                  <label for="newPassword">New Password</label>
                  <input type="password" class="form-control" id="newPassword" name="password">
                  <small id="passwordError" class="text-danger" style="display:none;">Passwords do not match!</small>
              </div>
              <div class="form-group">
                  <label for="confirmPassword">Confirm Password</label>
                  <input type="password" class="form-control" id="confirmPassword" name="confirm_password">
              </div>
          </div>
          
          
            
        </div>

            <!-- Position and Status -->
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label for="editVolunteerPosition">Position</label>
                      <select name="type" id="type">
                        <option value="1">Super Admin</option>
                        <option value="2">Admin</option>
                      </select>
                  </div>
              </div>
          </div>

        

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit"  class="btn btn-primary">Save Changes</button>
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
                                <h4 class="card-title"></h4>
                                <button
                                class="btn btn-primary btn-round ms-auto"
                                data-bs-toggle="modal" data-bs-target="#formModal"
                                >
                                <i class="fa fa-plus"></i>
                               New 
                                </button>
                               
                                
                            
                            </div>
                        </div>
                        <div class="card-body">
                        <!-- Modal -->
                        
                        <div class="table-responsive">
                          <table id="add-row" class="display table table-striped table-hover">
                              <thead>
                                  <tr>
                                    <th style="width: 50%"> Name </th>
                                    <th style="width: 50%"> Email</th>
                                    <th style="width: 50%"> Type </th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                      <th style="width: 50%"> Name </th>
                                      <th style="width: 50%"> Email</th>
                                      <th style="width: 50%"> Type </th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                                  @foreach ($users as $user)
                                      <tr>
                                          <td>{{ $user->name}}</td>
                                        
                                          <td>{{ $user->email }}</td>
                                          <td>
                                            @if ($user->type == 1)
                                            Super Admin
                                        @elseif ($user->type == 2)
                                            Admin
                                        @else
                                            {{ $user->type }} <!-- If unknown type, print the raw value -->
                                        @endif

                                          </td>
                                          <td>
                                              <div class="form-button-action">
                                                  <button
                                                      type="button"
                                                      class="btn btn-link btn-primary btn-lg"
                                                      data-bs-toggle="modal"
                                                      data-bs-target="#editVolunteerModal"
                                                      onclick="editVolunteer(
                                                          '{{ $user->id }}',
                                                          '{{ $user->name }}',
                                                          '{{ $user->email }}',
                                                          '{{ $user->password }}',
                                                          '{{$user->type}}',
                                                      )">
                                                      <i class="fa fa-edit"></i>
                                                  </button>
                                                  <button type="button" class="btn btn-link btn-danger btn-lg" title="Move to Archive"
                                                  onclick="userdelete({{ json_encode($user->id) }})">
                                                  <i class="fa fa-times"></i>
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
<script>
                                function userdelete(id) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Do you want to Delete the User?",
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, Delete User!',
                                    cancelButtonText: 'No, cancel',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect to the retrieval route
                                        window.location.href = '/user/delete/' + id;
                                    }
                                });
                            }
                        </script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <!-- Bootstrap Bundle with Popper.js (required for tooltips) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

      <script>
        document.addEventListener("DOMContentLoaded", function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

      </script>
      <!-- Include SweetAlert Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Check if Laravel validation errors exist
        @if ($errors->any())
            let errorMessage = "";
            @foreach ($errors->all() as $error)
                errorMessage += "{{ $error }}\n"; // Collect all error messages
            @endforeach

            // Trigger SweetAlert for errors
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: errorMessage,
            });
        @endif

        // Check if a success message exists
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "{{ session('success') }}",
            });
        @endif
    });
</script>

</div>
@include('layouts.footer')
@endsection


