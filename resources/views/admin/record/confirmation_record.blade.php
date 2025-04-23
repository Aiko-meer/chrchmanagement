@extends('layouts.header')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Confirmation Record of {{ $confirmationYear }}</h3>
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
                <a href="/confirmation">Confirmation</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/confirmation_record/{{ $confirmationID }}">Confirmation Record of {{ $confirmationYear }}</a>
            </li>
            
            
            
            </ul>
        </div>


        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Confirmation Registration Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="baptismRecordForm" action="{{ route('confirmation.record.store') }}" method="POST">
              @csrf
                <div class="container">
                  <div class="page-inner">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                        
                          
                          <input type="hidden" id="confirmationYear" name="confirmationYear" value="{{ $confirmationYear }}" />
                          <input type="hidden" id="confirmationID" name="confirmation_id" value="{{ $confirmationID }}" />
                          <input type="hidden" id="status" name="status" value="0">

                          <h5 class="fw-bold mb-3">Confirmation Record Details</h5>
                            <div class="row">
                              <div class="col-md-5">
                                  <div class="form-group">
                                      <label for="seriesYearNo">Series/Year No.</label>
                                      <input type="text" class="form-control" id="seriesYearNo" name="seriesYearNo" value="{{ $confirmationYear }}" readonly>
                                  </div>
                              </div>
                             
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="pageNo">Page No.</label>
                                        <input type="text" class="form-control" id="pageNo" name="pageNo" placeholder="Enter Page No." required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirmationDate">Date of Confirmation</label>
                                        <input type="date" class="form-control" id="confirmationDate" name="confirmationDate" required>
                                        <small id="dateError" class="text-danger"></small> <!-- Error Message -->
                                    </div>
                                </div>

                                
                            </div>
                            
                            <!-- Child Information -->
                            <h5 class="fw-bold mb-3">Child Information</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="childFirstName">First Name</label>
                                        <input type="text" class="form-control" id="childFirstName" name="childFirstName" placeholder="Enter First Name"required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="childMiddleName">Middle Name</label>
                                        <input type="text" class="form-control" id="childMiddleName" name="childMiddleName" placeholder="Enter Middle Name" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="childLastName">Last Name</label>
                                        <input type="text" class="form-control" id="childLastName" name="childLastName" placeholder="Enter Last Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="childDOB">Date of Birth</label>
                                        <input type="date" class="form-control" id="childDOB" name="childDOB" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="childBirthPlace">Place of Birth:</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="childProvince">Child's Province</label>
                                        <select class="form-control" id="childProvince" name="childProvince">
                                            <option value="">Select Province</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="childCity">Child's City/Municipality</label>
                                        <select class="form-control" id="childCity" name="childCity">
                                            <option value="">Select City/Municipality</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Father Information -->
                            <h5 class="fw-bold mb-3">Father's Information</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fatherFirstName">First Name</label>
                                        <input type="text" class="form-control" id="fatherFirstName" name="fatherFirstName" placeholder="Enter First Name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fatherMiddleName">Middle Name</label>
                                        <input type="text" class="form-control" id="fatherMiddleName" name="fatherMiddleName" placeholder="Enter Middle Name" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fatherLastName">Last Name</label>
                                        <input type="text" class="form-control" id="fatherLastName" name="fatherLastName" placeholder="Enter Last Name" required>
                                    </div>
                                </div>
                                
                            </div>

                            <!-- Mother Information -->
                            <h5 class="fw-bold mb-3">Mother's Information</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="motherFirstName">First Name</label>
                                        <input type="text" class="form-control" id="motherFirstName" name="motherFirstName" placeholder="Enter First Name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="motherMiddleName">Middle Name</label>
                                        <input type="text" class="form-control" id="motherMiddleName" name="motherMiddleName" placeholder="Enter Middle Name" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="motherLastName">Last Name</label>
                                        <input type="text" class="form-control" id="motherLastName" name="motherLastName" placeholder="Enter Last Name" required>
                                    </div>
                                </div>
                                
                            </div>

                            <h5 class="fw-bold mb-3">Residence Address</h5>
                            <div class="row">
                                <!-- Purok No. -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="purokNo">Purok No.</label>
                                        <input type="text" class="form-control" id="purokNo" name="purokNo" placeholder="Enter Purok No." />
                                    </div>
                                </div>

                                <!-- Street Address -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="streetAddress">Street Address</label>
                                        <input type="text" class="form-control" id="streetAddress" name="streetAddress" placeholder="Enter Street Address" />
                                    </div>
                                </div>

                                <!-- Barangay -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="barangay">Barangay</label>
                                        <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Enter Barangay" />
                                    </div>
                                </div>

                                <!-- Province -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="residenceProvince">Province</label>
                                        <select class="form-control" id="residenceProvince" name="residenceProvince">
                                            <option value="">Select Province</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Municipality/City -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="residenceCity">Municipality/City</label>
                                        <select class="form-control" id="residenceCity" name="residenceCity">
                                            <option value="">Select City/Municipality</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                          
                        
                            <h5 class="fw-bold mb-3">Name of Sponsor</h5>
                        <div class="row" id="godparent-rows">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="godparentFirstName">First Name</label>
                                <input type="text" class="form-control" id="godparentFirstName"  name="godparentFirstName" placeholder="Enter First Name" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="godparentMiddleName">Middle Name</label>
                                <input type="text" class="form-control" id="godparentMiddleName" name="godparentMiddleName" placeholder="Enter Middle Name" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="godparentLastName">Last Name</label>
                                <input type="text" class="form-control" id="godparentLastName" name="godparentLastName" placeholder="Enter Last Name" />
                                </div>
                            </div>
                        </div>
                           

                          </div>
                         
                          <div class="card-action">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                          </div>
                          
                        </div>

                      </div>
                    </div>
                  </div>
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
                                <h4 class="card-title">Confirmation</h4>
                                <button
                                class="btn btn-primary btn-round ms-auto"
                                data-bs-toggle="modal" data-bs-target="#formModal"
                                >
                                <i class="fa fa-plus"></i>
                                New Confirmation
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
                                      <th style="width: 40%">Name of Confirmands</th>
                                      <th>Date of Confirmation</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Record Code</th>
                                      <th style="width: 40%">Name of Confirmands</th>
                                      <th>Date of Confirmation</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                                  
                              @foreach($confirmatioRecords as $index => $record)
                                  <tr>
                                      <td>{{ $index + 1 }}</td>
                                      <td>{{ $record->record_code }}</td>
                                      <td>{{ $record->child_first_name }} {{ $record->child_middle_name }} {{ $record->child_last_name }}</td>
                                      <td>{{ \Carbon\Carbon::parse($record->confirmation_date)->format('m/d/Y') }}</td>
                                      <td>
                                          <div class="form-button-action">
                                          <a href="{{ route('confirmation.info', $record->id) }}" type="button" data-bs-toggle="tooltip" title="View Confirmation Record" class="btn btn-link btn-primary btn-lg">
                                              <i class="fas fa-eye"></i>
                                          </a>
                                        <button type="button" data-bs-toggle="tooltip" title="Edit Confirmation Record" class="btn btn-link btn-primary btn-lg"
                                            onclick="editConfirmationRecord({{ json_encode($record)}})">
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

<div class="modal fade" id="formModal1" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabel">Edit Confirmation Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="confirmationRecordForm"  action="{{ route('confirmation.record.update') }}" method="POST">
          @csrf
          @method('PUT') <!-- Spoof PUT method -->
          
          <div class="container">
            <div class="page-inner">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                      <input type="hidden" id="ConfirmationID" name="confirmation_id"  />
                      
                      <h5 class="fw-bold mb-3">Confirmation Record Details</h5>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="SeriesYearNo">Series/Year No.</label>
                            <input type="text" class="form-control" id="SeriesYearNo" name="SeriesYearNo"  readonly>
                          </div>
                        </div>
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="PageNo">Page No.</label>
                            <input type="text" class="form-control" id="PageNo" name="PageNo"  required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="ConfirmationDate">Date of Confirmation</label>
                            <input type="date" class="form-control" id="ConfirmationDate" name="ConfirmationDate"  required>
                          </div>
                        </div>
                      </div>

                      <!-- Child Information -->
                      <h5 class="fw-bold mb-3">Child Information</h5>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="ChildFirstName">First Name</label>
                            <input type="text" class="form-control" id="ChildFirstName" name="ChildFirstName"  required>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="ChildMiddleName">Middle Name</label>
                            <input type="text" class="form-control" id="ChildMiddleName" name="ChildMiddleName">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="ChildLastName">Last Name</label>
                            <input type="text" class="form-control" id="ChildLastName" name="ChildLastName"  required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="ChildDOB">Date of Birth</label>
                            <input type="date" class="form-control" id="ChildDOB" name="ChildDOB"  required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="motherProvince">Child's Province</label>
                            <select class="form-control" id="motherProvince" name="motherProvince">
                              <option value="">Select Province</option>
                             
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="motherCity">Child's City/Municipality</label>
                            <select class="form-control" id="motherCity" name="motherCity">
                              <option value="">Select City/Municipality</option>
                         
                            </select>
                          </div>
                        </div>
                      </div>

                      <!-- Father Information -->
                      <h5 class="fw-bold mb-3">Father's Information</h5>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="FatherFirstName">First Name</label>
                            <input type="text" class="form-control" id="FatherFirstName" name="FatherFirstName"  required>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="FatherMiddleName">Middle Name</label>
                            <input type="text" class="form-control" id="FatherMiddleName" name="FatherMiddleName" >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="FatherLastName">Last Name</label>
                            <input type="text" class="form-control" id="FatherLastName" name="FatherLastName"  required>
                          </div>
                        </div>
                      </div>

                      <h5 class="fw-bold mb-3">Mother's Information</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="MotherFirstName">First Name</label>
                                        <input type="text" class="form-control" id="MotherFirstName" name="MotherFirstName" placeholder="Enter First Name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="MotherMiddleName">Middle Name</label>
                                        <input type="text" class="form-control" id="MotherMiddleName" name="MotherMiddleName" placeholder="Enter Middle Name" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="MotherLastName">Last Name</label>
                                        <input type="text" class="form-control" id="MotherLastName" name="MotherLastName" placeholder="Enter Last Name" required>
                                    </div>
                                </div>
                                
                            </div>
                            <h5 class="fw-bold mb-3">Residence Address</h5>
                            <div class="row">
                                <!-- Purok No. -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="PurokNo">Purok No.</label>
                                        <input type="text" class="form-control" id="PurokNo" name="PurokNo" placeholder="Enter Purok No." />
                                    </div>
                                </div>

                                <!-- Street Address -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="StreetAddress">Street Address</label>
                                        <input type="text" class="form-control" id="StreetAddress" name="StreetAddress" placeholder="Enter Street Address" />
                                    </div>
                                </div>

                                <!-- Barangay -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Barangay">Barangay</label>
                                        <input type="text" class="form-control" id="Barangay" name="Barangay" placeholder="Enter Barangay" />
                                    </div>
                                </div>

                                <!-- Province -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fatherProvince">Province</label>
                                        <select class="form-control" id="fatherProvince" name="fatherProvince">
                                            <option value="">Select Province</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Municipality/City -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fatherCity">Municipality/City</label>
                                        <select class="form-control" id="fatherCity" name="fatherCity">
                                            <option value="">Select City/Municipality</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <h5 class="fw-bold mb-3">Name of Sponsor</h5>
                        <div class="row" id="godparent-rows">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="GodparentFirstName">First Name</label>
                                <input type="text" class="form-control" id="GodparentFirstName"  name="GodparentFirstName" placeholder="Enter First Name" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="GodparentMiddleName">Middle Name</label>
                                <input type="text" class="form-control" id="GodparentMiddleName" name="GodparentMiddleName" placeholder="Enter Middle Name" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="GodparentLastName">Last Name</label>
                                <input type="text" class="form-control" id="GodparentLastName" name="GodparentLastName" placeholder="Enter Last Name" />
                                </div>
                            </div>
                        </div>

                        
                      
                      <div class="card-action">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    function confirmcancel(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Cancel the Confirmation Book?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Cancel Book!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/confirmation/delete/' + id;
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
                window.location.href = '/confirmation/status/' + id;
            }
        });
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script>
                              $(document).ready(function() {
                                  $('#confirmationDate').on('change', function() {  // ✅ Corrected the ID
                                      let selectedDate = $(this).val();
                                      
                                      if (!selectedDate) return; // Stop if no date selected
                              
                                      $.ajax({
                                          url: '/check-confirmation-date', // ✅ Correct route
                                          type: 'GET',
                                          data: { date: selectedDate },
                                          success: function(response) {
                                              if (response.isFull) {
                                                  $('#confirmationDate').css('border-color', 'red').css('color', 'red'); // ✅ Corrected the ID
                                                  $('#dateError').text('This date is fully booked. Please select another date.');
                                              } else {
                                                  $('#confirmationDate').css('border-color', '').css('color', ''); // ✅ Reset if available
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
<script>
function editConfirmationRecord(record) {
    // Dynamically update the form action URL with the record ID
    const form = document.getElementById('confirmationRecordForm');
    form.action = form.action.replace(':id', record.id);
    console.log('Record:', record);
    
    // Set hidden confirmation ID
    document.getElementById('ConfirmationID').value = record.id;

    // Populate Confirmation Record Details
    document.getElementById('SeriesYearNo').value = record.series_year_no || '';
    document.getElementById('PageNo').value = record.page_no || '';
    document.getElementById('ConfirmationDate').value = record.confirmation_date || '';

    // Populate Child Information
    document.getElementById('ChildFirstName').value = record.child_first_name || '';
    document.getElementById('ChildMiddleName').value = record.child_middle_name || '';
    document.getElementById('ChildLastName').value = record.child_last_name || '';
    document.getElementById('ChildDOB').value = record.child_dob || '';
    
    const childProvinceDropdown = $('#motherProvince');
    childProvinceDropdown.val(record.child_province).change();
    setTimeout(() => {
        $('#motherCity').val(record.child_city);
    }, 500);

    // Populate Father's Information
    document.getElementById('FatherFirstName').value = record.father_first_name || '';
    document.getElementById('FatherMiddleName').value = record.father_middle_name || '';
    document.getElementById('FatherLastName').value = record.father_last_name || '';

    // Populate Mother's Information
    document.getElementById('MotherFirstName').value = record.mother_first_name || '';
    document.getElementById('MotherMiddleName').value = record.mother_middle_name || '';
    document.getElementById('MotherLastName').value = record.mother_last_name || '';

    document.getElementById('PurokNo').value = record.purok_no || '';
    document.getElementById('StreetAddress').value = record.street_address || '';
    document.getElementById('Barangay').value = record.barangay || '';

    // Set province and city values after dynamically loading provinces
    const residenceProvinceDropdown = $('#fatherProvince');
    residenceProvinceDropdown.val(record.residence_province).change();

    // Wait for cities to populate before setting city value
    setTimeout(() => {
        $('#fatherCity').val(record.residence_city);
    }, 500); // Adjust timeout if necessary
  
    document.getElementById('GodparentFirstName').value = record.godparent_first_name || '';
    document.getElementById('GodparentMiddleName').value = record.godparent_middle_name || '';
    document.getElementById('GodparentLastName').value = record.godparent_last_name || '';

    // Populate Residence Address
   


    // Open the modal using Bootstrap's Modal API
    const modal = new bootstrap.Modal(document.getElementById('formModal1'));
    modal.show();
}



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


