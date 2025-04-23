@extends('layouts.header')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Funeral Record of {{ $funeralYear }}</h3>
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
                <a href="/funeral">Funeral</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/funeral_record">Funeral Record of {{ $funeralYear }} </a>
            </li>
            
            
            
            </ul>
        </div>


        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Funeral Registration Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="page-inner">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">

                    
                  <form method="POST" action="{{ route('funeral.record.store') }}">
                    @csrf
                    
                    <input type="hidden" id="funeralYear" name="funeralYear" value="{{ $funeralYear }}" />
                    <input type="hidden" id="funeralID" name="funeral_id" value="{{ $funeralID }}" />
                    <input type="hidden" id="status" name="status" value="0">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="FuneralDate">Date of Funeral</label>
                                <input type="date" class="form-control" id="FuneralDate" name="funeral_date" />
                                <small id="dateError" class="text-danger"></small> <!-- Error Message -->
                            </div>
                        </div>
                    </div>
                   
                    <!-- Name Details -->
                    <h5 class="fw-bold mb-3">Name of Deceased</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="deceasedFirstName">First Name</label>
                                <input type="text" class="form-control" id="deceasedFirstName" name="first_name" placeholder="Enter First Name" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="deceasedMiddleName">Middle Name</label>
                                <input type="text" class="form-control" id="deceasedMiddleName" name="middle_name" placeholder="Enter Middle Name" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="deceasedLastName">Last Name</label>
                                <input type="text" class="form-control" id="deceasedLastName" name="last_name" placeholder="Enter Last Name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="deceasedDOB">Date of Birth</label>
                                <input type="date" class="form-control" id="deceasedDOB" name="dob" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="deathDate">Date of Death</label>
                                <input type="date" class="form-control" id="deathDate" name="dod" />
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <h5 class="fw-bold mb-3">Contact Information of Relatives</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="relativeContact">Contact Number</label>
                                <input type="text" class="form-control" id="relativeContact" name="contact" placeholder="Enter Contact Number" />
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="card-action">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
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


        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Funeral Record</h4>
                                <button
                                class="btn btn-primary btn-round ms-auto"
                                data-bs-toggle="modal" data-bs-target="#formModal"
                                >
                                <i class="fa fa-plus"></i>
                                New Funeral Register
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                        <!-- Modal -->
                        
                        <div class="table-responsive">
                          <table id="add-row" class="display table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Record Code</th>
                                      <th style="width: 40%">Name of Deceased</th>
                                      <th>Date of Funeral</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Record Code</th>
                                      <th style="width: 40%">Name of Deceased</th>
                                      <th>Date of Funeral</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                                  @foreach($funeralRecords as $index => $record)
                                  <tr>
                                      <td>{{ $index + 1 }}</td>
                                      <td>{{ $record->record_code }}</td>
                                      <td>{{ $record->first_name }} {{ $record->middle_name }} {{ $record->last_name }}</td>
                                      <td>{{ \Carbon\Carbon::parse($record->funeral_date)->format('m/d/Y') }}</td>
                                      <td>
                                          <div class="form-button-action">
                                          <a href="{{ route('funeral.info', $record->id) }}" type="button" data-bs-toggle="tooltip" title="View Funeral Record" class="btn btn-link btn-primary btn-lg">
                                              <i class="fas fa-eye"></i>
                                          </a>
                                        <button type="button" data-bs-toggle="tooltip" title="Edit Funeral Record" class="btn btn-link btn-primary btn-lg"
                                            onclick="editFuneralRecord({{ json_encode($record)}})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                              <button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-danger btn-lg" title="Cancel"
                                              onclick="confirmcancel({{ $record['id'] }})">
                                              <i class="fas fa-times"></i>  <!-- Checkmark icon -->
                                      </button>
                                                    <button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-secondary btn-lg" title="Mark as Done"
                                              onclick="confirmcheck({{ $record['id'] }})">
                                              <i class="fas fa-check"></i>  <!-- Checkmark icon -->
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
</div>
<script> 
function editFuneralRecord(record) {
    // Set form fields with the existing record data
    document.getElementById('editFuneralId').value = record.id;
    document.getElementById('editRecordCode').value = record.record_code;
    document.getElementById('editFuneralDate').value = record.funeral_date;
    document.getElementById('editFirstName').value = record.first_name;
    document.getElementById('editMiddleName').value = record.middle_name;
    document.getElementById('editLastName').value = record.last_name;
    document.getElementById('editDob').value = record.dob;
    document.getElementById('editDod').value = record.dod;
    document.getElementById('editContact').value = record.contact;

    // Show the modal
    var editModal = new bootstrap.Modal(document.getElementById('editFuneralRecordModal'));
    editModal.show();
}
</script>

<!-- Edit Funeral Record Modal -->
<div class="modal fade" id="editFuneralRecordModal" tabindex="-1" aria-labelledby="editFuneralRecordLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFuneralRecordLabel">Edit Funeral Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editFuneralRecordForm" method="POST" action="{{ route('funeral.record.update') }}">
                @csrf
                @method('PUT') 
                <div class="modal-body">
                    <input type="hidden" name="funeral_id" id="editFuneralId">

                    <!-- Funeral Details -->
                    <h5 class="fw-bold mb-3">Funeral Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editRecordCode">Record Code</label>
                                <input type="text" class="form-control" id="editRecordCode" name="record_code" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editFuneralDate">Date of Funeral</label>
                                <input type="date" class="form-control" id="editFuneralDate" name="funeral_date" />
                            </div>
                        </div>
                    </div>

                    <!-- Name of Deceased -->
                    <h5 class="fw-bold mb-3">Name of Deceased</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="editFirstName">First Name</label>
                                <input type="text" class="form-control" id="editFirstName" name="first_name" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="editMiddleName">Middle Name</label>
                                <input type="text" class="form-control" id="editMiddleName" name="middle_name" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="editLastName">Last Name</label>
                                <input type="text" class="form-control" id="editLastName" name="last_name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editDob">Date of Birth</label>
                                <input type="date" class="form-control" id="editDob" name="dob" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editDod">Date of Death</label>
                                <input type="date" class="form-control" id="editDod" name="dod" />
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <h5 class="fw-bold mb-3">Contact Information of Relatives</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editContact">Contact Number</label>
                                <input type="text" class="form-control" id="editContact" name="contact" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmcancel(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Cancel the Funerel Book?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Cancel Book!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/funeral_record/destroy/' + id;
            }
        });
    }
</script>
<script>
    function confirmcheck(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to move the data into Records?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, move the data!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/funeral_record/status/' + id;
            }
        });
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      $('#FuneralDate').on('change', function() {  // ✅ Corrected the ID
          let selectedDate = $(this).val();
          
          if (!selectedDate) return; // Stop if no date selected
  
          $.ajax({
              url: '/check-funeral-date', // ✅ Correct route
              type: 'GET',
              data: { date: selectedDate },
              success: function(response) {
                  if (response.isFull) {
                      $('#FuneralDate').css('border-color', 'red').css('color', 'red'); // ✅ Corrected the ID
                      $('#dateError').text('This date is fully booked. Please select another date.');
                  } else {
                      $('#FuneralDate').css('border-color', '').css('color', ''); // ✅ Reset if available
                      $('#dateError').text('');
                  }
              },
              error: function(xhr) {
                  console.error("Error checking date:", xhr);
              }
          });
      });
  });
  </script>
  @if(session('success'))
  <script>
      Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: '{{ session('success') }}',
          confirmButtonText: 'OK'
      }).then(() => {
           // Redirect to the previous page after the alert
      });
  </script>
@endif
@include('layouts.footer')




@endsection


