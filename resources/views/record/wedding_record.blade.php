@extends('layouts.header')
@section('content')
<div class="container">
    < class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Wedding Record of {{ $weddingYear }}</h3>
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
                <a href="/wedding/">Wedding</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/wedding_record/{{ $weddingID }}">Wedding Record of {{ $weddingYear }}</a>
            </li>
            
            
            
            </ul>
        </div>
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

       

        <!--STEP MODAL-->
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="CategoryModalLabel">Wedding Registration Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="page-inner">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                        <form action="{{ route('wedding.record.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                          <div class="card-body">
                          
                            
                            <di class="step" id="step1">
                              <!-- Wedding Details -->
                             
                              <div class="row">
                                <input type="hidden" id="weddingYear" name="weddingYear" value="{{ $weddingYear }}" />
                                <input type="hidden" id="weddingID" name="wedding_id" value="{{ $weddingID }}" />
                                <input type="text" hidden value="0" name="status">
                                  
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="baptismDate">Date of Wedding</label>
                                      <input type="date" class="form-control" id="baptismDate" name="wedding_date" required>
                                      <small id="dateError" class="text-danger"></small>
                                  </div>
                                  </div>
                                </div>
                              <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                            </di  v>
                            
                            <div class="step d-none" id="step2">
                              <!-- Groom Information -->
                              <h5>Groom's Info</h5>
                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="groomFirstName">First Name</label>
                                    <input type="text" class="form-control" id="groomFirstName" name="groom_first_name"placeholder="Enter First Name" />
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="groomMiddleName">Middle Name</label>
                                    <input type="text" class="form-control" id="groomMiddleName"name="groom_middle_name" placeholder="Enter Middle Name" />
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="groomLastName">Last Name</label>
                                    <input type="text" class="form-control" id="groomLastName"name="groom_last_name" placeholder="Enter Last Name" />
                                  </div>
                                </div>
                              </div>
  
                              <!-- Groom's Birth Information -->
                            
                              <div class="row">
                                <div class="col-md-7">
                                  <div class="form-group">
                                    <label for="groomBirthDate">Date of Birth</label>
                                    <input type="date" class="form-control" name="groom_dob" id="groomBirthDate" />
                                  </div>
                                </div>
                                
                              </div>
  
                              <h5 class="fw-bold mb-3">Groom's Residence Address</h5>
                              <div class="row">
                                
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fatherProvince">Groom's Province</label>
                                        <select class="form-control" id="fatherProvince" name="groom_residence_province" required>
                                            <option value="">Select Province</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fatherCity">Groom's City/Municipality</label>
                                        <select class="form-control" id="fatherCity" name="groom_residence_city" required>
                                            <option value="">Select City/Municipality</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="groomBarangay">Barangay</label>
                                    <input type="text" class="form-control" id="groomBarangay"name="groom_barangay" placeholder="Enter Barangay" />
                                  </div>
                                </div>
                                <div class="col-md-5">
                                  <div class="form-group">
                                    <label for="groomStreetAddress">Street Address</label>
                                    <input type="text" class="form-control" id="groomStreetAddress"name="groom_street_address" placeholder="Enter Street Address" />
                                  </div>
                                </div>
                                
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="groomPurokNo">Purok No.</label>
                                    <input type="text" class="form-control" id="groomPurokNo" name="groom_purok_no"placeholder="Enter Purok No." />
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="groomContactNo">Contact No.</label>
                                    <input type="text" class="form-control" id="groomContactNo"name="groom_contact" placeholder="Enter Contact No." />
                                  </div>
                                </div>
                                <h5 class="fw-bold mb-3">Groom's Documents Presented</h5>
                              <div class="form-group mt-3">
                                <label for="groombapcer">Baptism Certificate</label>
                                <input type="file" class="form-control" name="groombapcer" id="groombapcer" accept="application/pdf" />
                              </div>

                              <div class="form-group mt-3">
                                <label for="groomconfir">Confirmation Certificate</label>
                                <input type="file" class="form-control" name="groomconfir" id="groomconfir" accept="application/pdf" />
                              </div>

                              <div class="form-group mt-3">
                                <label for="groomcenomar">CENOMAR</label>
                                <input type="file" class="form-control" name="groomcenomar" id="groomcenomar" accept="application/pdf" />
                              </div>

                              <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Back</button>
                              <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                            </div>

                            <div class="step d-none" id="step3">
                              <h5 class="fw-bold mb-3">Bride's Information</h5>
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="brideFirstName">First Name</label>
                                  <input type="text" class="form-control" id="brideFirstName"name="bride_first_name" placeholder="Enter First Name" />
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="brideMiddleName">Middle Name</label>
                                  <input type="text" class="form-control" id="brideMiddleName"name="bride_middle_name" placeholder="Enter Middle Name" />
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="brideLastName">Last Name</label>
                                  <input type="text" class="form-control" id="brideLastName"name="bride_last_name" placeholder="Enter Last Name" />
                                </div>
                              </div>
                            </div>

                        
                            <div class="row">
                              <div class="col-md-7">
                                <div class="form-group">
                                  <label for="brideBirthDate">Date of Birth</label>
                                  <input type="date" class="form-control" name="bride_dob"id="brideBirthDate" />
                                </div>
                              </div>
                              
                            </div>

                            <h5 class="fw-bold mb-3">Bride's Residence Address</h5>
                            <div class="row">
                              
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="motherProvince">Bride's Province</label>
                                      <select class="form-control" id="motherProvince" name="bride_residence_province" required>
                                          <option value="">Select Province</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="motherCity">Bride's City/Municipality</label>
                                      <select class="form-control" id="motherCity" name="bride_residence_city" required>
                                          <option value="">Select City/Municipality</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="brideBarangay">Barangay</label>
                                  <input type="text" class="form-control" id="brideBarangay"name="bride_barangay" placeholder="Enter Barangay" />
                                </div>
                              </div>
                              <div class="col-md-5">
                                <div class="form-group">
                                  <label for="brideStreetAddress">Street Address</label>
                                  <input type="text" class="form-control" id="brideStreetAddress" name="bride_street_address"placeholder="Enter Street Address" />
                                </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="bridePurokNo">Purok No.</label>
                                  <input type="text" class="form-control" id="bridePurokNo" name="bride_purok_no"placeholder="Enter Purok No." />
                                </div>
                              </div>
                            </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="groomContactNo">Contact No.</label>
                                    <input type="text" class="form-control" id="groomContactNo"name="groom_contact" placeholder="Enter Contact No." />
                                  </div>
                                </div>
                                <h5 class="fw-bold mb-3"> Brides Documents Presented</h5>
                                <div class="form-group mt-3">
                                <label for="PresentedFile">Baptism Certificate</label>
                                <input type="file" class="form-control" name="bridesbapcer" id="bridesbapcer" />
                                </div>
                                <div class="form-group mt-3">
                                  <label for="PresentedFile">Confirmation Certificate</label>
                                  <input type="file" class="form-control" name="bridesconfir" id="bridesconfir" />
                                  </div>
                                  <div class="form-group mt-3">
                                    <label for="PresentedFile">CENOMAR</label>
                                    <input type="file" class="form-control" name="bridescenomar" id="bridescenomar" />
                                    </div>
                              <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Back</button>
                              <button type="button" class="btn btn-primary" onclick="nextStep(4)">Next</button>
                              

                              
                              
                            </div>

                            <div class="step d-none" id="step4">
                              <!-- Wedding Details -->
                             
                              <div class="form-group">
                                <input type="text" id="priceInput" name="price" class="form-control" hidden>

                                <label for="residenceCity">Type of Wedding</label>
                                <select class="form-control" id="categorySelect" name="category">  
                                        <option value="" disabled selected>Select a category</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->name }}" data-price="{{ $cat->price }}">
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    <p>Price: <span id="priceDisplay">₱</span></p>
                                    
                            </div>
                                <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Back</button>
                              
                              <button class="btn btn-success" type="submit">Submit</button>
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

        <!--category model-->
      <div class="modal fade" id="CategoryModal" tabindex="-1" aria-labelledby="CategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="formModalLabel">New Wedding Category Price</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="baptismRecordForm" action="{{ route('wedding.price.store') }}" method="POST">
                @csrf
                <div class="container">
                  <div class="page-inner">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                            <!-- Example Form Fields -->
                            <div class="form-group mb-3">
                              <label for="baptism_name">Name of Category</label>
                              <input type="text" name="baptism_name" class="form-control" required>
                            </div>
      
                            <div class="form-group mb-3">
                              <label for="baptism_date">Price</label>
                              <input type="text" name="baptism_price" class="form-control" required>
                            </div>
                          </div> <!-- End card-body -->
                        </div> <!-- End card -->
                      </div> <!-- End col -->
                    </div> <!-- End row -->
                  </div> <!-- End page-inner -->
                </div> <!-- End container -->
      
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </form>
            </div> <!-- End modal-body -->
          </div> <!-- End modal-content -->
        </div> <!-- End modal-dialog -->
      </div> <!-- End modal -->

        
        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Wedding Records</h4>
                                <button
                                class="btn btn-primary btn-round ms-auto"
                                data-bs-toggle="modal" data-bs-target="#formModal"
                                >
                                <i class="fa fa-plus"></i>
                                New Wedding Record
                                </button>
                                <button
                                class="btn btn-primary btn-round ms-2"
                                data-bs-toggle="modal" data-bs-target="#CategoryModal"
                                >
                                <i class="fa fa-plus"></i>
                                New Category price
                                </button>
                                <a
                                class="btn btn-primary btn-round ms-2"
                                href="/wedding/price/table">
                                <i class="fa fa-table"></i>
                                Category Price Table
                                </a>
                            </div>
                        </div>
                          <div class="card-body">
                          <!-- Modal -->
                          <div
                              class="modal fade"
                              id="addRowModal"
                              tabindex="-1"
                              role="dialog"
                              aria-hidden="true"
                          >
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header border-0">
                                  <h5 class="modal-title">
                                      <span class="fw-mediumbold"> New</span>
                                      <span class="fw-light"> Series </span>
                                  </h5>
                                  <button
                                      type="button"
                                      class="close"
                                      data-dismiss="modal"
                                      aria-label="Close"
                                  >
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                  <p class="small">
                                      Create New Series
                                  </p>
                                  <form>
                                      <div class="row">
                                      <div class="col-sm-12">
                                          <div class="form-group form-group-default">
                                          <label>Year</label>
                                          <input
                                              id="addName"
                                              type="number"
                                              class="form-control"
                                              placeholder="Series Year"
                                              min ='0'
                                              
                                          />
                                          </div>
                                      </div>
                                      
                                      </div>
                                  </form>
                                  </div>
                                  <div class="modal-footer border-0">
                                  <button
                                      type="button"
                                      id="addRowButton"
                                      class="btn btn-primary"
                                  >
                                      Add
                                  </button>
                                  <button
                                      type="button"
                                      class="btn btn-danger"
                                      data-dismiss="modal"
                                  >
                                      Close
                                  </button>
                                  </div>
                              </div>
                              </div>
                          </div>

                        <div class="table-responsive">
                          <table id="add-row" class="display table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Record Code</th>
                                      <th style="width: 40%">Name of Couple</th>
                                      <th>Date of Wedding</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Record Code</th>
                                      <th style="width: 40%">Name of Couple</th>
                                      <th>Date of Wedding</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                              @foreach($WeddingRecords as $index => $record)
                                  <tr>
                                      <td>{{ $index + 1 }}</td>
                                      <td>{{ $record->record_code }}</td>
                                      <td>{{ $record->groom_first_name }} {{ $record->groom_middle_name }} {{ $record->groom_last_name }}  <br>
                                        {{ $record->bride_first_name }} {{ $record->bride_middle_name }} {{ $record->bride_last_name }}</td>
                                        @php
                                        $isOverdue = \Carbon\Carbon::parse($record->wedding_date)->isPast();
                                        $incomplete = $record->sundayone == 0 || $record->sundaytwo == 0 || $record->sundaythree == 0;
                                      @endphp
                                      
                                      <td class="{{ $isOverdue && $incomplete ? 'text-danger fw-bold' : '' }}">
                                        {{ \Carbon\Carbon::parse($record->wedding_date)->format('m/d/Y') }}
                                      </td>
                                      
                                      
                                      <td>
                                          <div class="form-button-action">
                                          <a href="{{ route('wedding.info', $record->id) }}" type="button" data-bs-toggle="tooltip" title="View Wedding Record" class="btn btn-link btn-primary btn-lg">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" data-bs-toggle="tooltip" title="Edit Wedding Record" class="btn btn-link btn-primary btn-lg"
                                        onclick='editFuneralRecord({!! json_encode($record) !!})'>
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

            <script> 
              function editFuneralRecord(record) {
    // Set form fields with the existing record data
    document.getElementById('weddingid').value = record.id;
    document.getElementById('sundayone').checked = record.sundayone == 1 ? true : false;
    document.getElementById('sundaytwo').checked = record.sundaytwo == 1 ? true : false;
    document.getElementById('sundaythree').checked = record.sundaythree == 1 ? true : false;
  
    // Disable checkboxes that are checked (sundayone, sundaytwo, sundaythree with value 1)
    document.getElementById('sundayone').disabled = record.sundayone == 1;
    document.getElementById('sundaytwo').disabled = record.sundaytwo == 1;
    document.getElementById('sundaythree').disabled = record.sundaythree == 1;

    // Show the modal
    var editModal = new bootstrap.Modal(document.getElementById('editFuneralRecordModal'));
    editModal.show();
}

              </script>
              
              <!-- Edit Funeral Record Modal -->
              <div class="modal fade" id="editFuneralRecordModal" tabindex="-1" aria-labelledby="editFuneralRecordLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content shadow-lg">
                    <div class="modal-header bg-primary text-white">
                      <h5 class="modal-title" id="editFuneralRecordLabel">Edit Wedding Record</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
              
                    <form id="editFuneralRecordForm" method="POST" action="{{ route('wedding.sunday.store') }}">
                      @csrf
                      @method('PUT')
                      <div class="modal-body py-4 px-5">
              
                        <input type="hidden" name="wedding_id" id="weddingid">
              
                        <!-- Section Title -->
                        <div class="mb-4">
                          <h5 class="fw-bold text-primary border-bottom pb-2">Wedding Meeting Requirement</h5>
                        </div>
              
                        <div class="row g-3">
                          <div class="col-md-4">
                            <div class="form-check d-flex align-items-center gap-2">
                              <input class="form-check-input" type="checkbox" id="sundayone" name="sundayone"
                                @if($record->sundayone == 1) checked disabled @endif>
                              <label class="form-check-label mb-0 ms-4 {{ $record->sundayone == 1 ? 'text-success fw-bold' : '' }}" for="sundayone">
                                1st Sunday
                              </label>
                            </div>
                          </div>
                        
                          <div class="col-md-4">
                            <div class="form-check d-flex align-items-center gap-2">
                              <input class="form-check-input" type="checkbox" id="sundaytwo" name="sundaytwo"
                                @if($record->sundaytwo == 1) checked disabled @endif>
                              <label class="form-check-label mb-0 ms-4 {{ $record->sundaytwo == 1 ? 'text-success fw-bold' : '' }}" for="sundaytwo">
                                2nd Sunday
                              </label>
                            </div>
                          </div>
                        
                          <div class="col-md-4">
                            <div class="form-check d-flex align-items-center gap-2">
                              <input class="form-check-input" type="checkbox" id="sundaythree" name="sundaythree"
                                @if($record->sundaythree == 1) checked disabled @endif>
                              <label class="form-check-label mb-0 ms-4 {{ $record->sundaythree == 1 ? 'text-success fw-bold' : '' }}" for="sundaythree">
                                3rd Sunday
                              </label>
                            </div>
                          </div>
                        </div>
                        
                        
                        
              
                      </div>
              
                      <div class="modal-footer bg-light">
                        <button type="submit" class="btn btn-success px-4">Update</button>
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
  .bg-success {
    background-color: lightgreen; /* Light green to indicate completion */
}
.text-white {
    color: white;
}

</style>
<script>
  $(document).ready(function() {
      $('#weddingDate').on('change', function() {  // ✅ Corrected the ID
          let selectedDate = $(this).val();
          
          if (!selectedDate) return; // Stop if no date selected
  
          $.ajax({
              url: '/check-wedding-date', // ✅ Correct route
              type: 'GET',
              data: { date: selectedDate },
              success: function(response) {
                  if (response.isFull) {
                      $('#weddingDate').css('border-color', 'red').css('color', 'red'); // ✅ Corrected the ID
                      $('#dateError').text('This date is fully booked. Please select another date.');
                  } else {
                      $('#weddingDate').css('border-color', '').css('color', ''); // ✅ Reset if available
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
    function confirmcancel(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to Cancel the Wedding Book?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Cancel Book!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/wedding/destroy/' + id;
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
                window.location.href = '/wedding/status/' + id;
            }
        });
    }
</script>


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
<script>
  function showStep(step) {
    // Hide all steps
    document.querySelectorAll('.step').forEach((el) => el.classList.add('d-none'));
  
    // Show the selected step
    const targetStep = document.getElementById(`step${step}`);
    targetStep.classList.remove('d-none');
  
    // Scroll the step into view
    targetStep.scrollIntoView({ behavior: 'smooth', block: 'start' });
  
    // Also scroll modal body to top as fallback
    const modalBody = document.querySelector('#CategoryModal .modal-body');
    if (modalBody) {
      modalBody.scrollTop = 0;
    }
  }
  
  function nextStep(step) {
    showStep(step);
  }
  
  function prevStep(step) {
    showStep(step);
  }
  </script>
  <script>
    document.getElementById('categorySelect').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.getAttribute('data-price');

        // Display price in <span>
        document.getElementById('priceDisplay').textContent = '₱' + price;

        // Set value in input field
        document.getElementById('priceInput').value = price;
    });
</script>
<script>
  $(document).ready(function () {
      $('#baptismDate').on('change', function () {
          const selectedDateStr = $(this).val();
          const selectedDate = new Date(selectedDateStr);
  
          // Reset UI
          $('#baptismDate').css('border-color', '').css('color', '');
          $('#dateError').text('');
          $('button[type="submit"]').prop('disabled', false);
  
          if (!selectedDateStr) return;
  
          // 1. Check if it's Sunday
          if (selectedDate.getDay() === 0) {
              $('#baptismDate').css('border-color', 'red').css('color', 'red');
              $('#dateError').text('Booking on Sundays is not allowed.');
              $('button[type="submit"]').prop('disabled', true);
              return; // Don't proceed with AJAX if Sunday
          }
  
          // 2. AJAX check for fully booked date
          $.ajax({
              url: '/check-baptism-date',
              type: 'GET',
              data: { date: selectedDateStr },
              success: function (response) {
                  if (response.isFull) {
                      $('#baptismDate').css('border-color', 'red').css('color', 'red');
                      $('#dateError').text('This date is fully booked. Please select another date.');
                      $('button[type="submit"]').prop('disabled', true);
                  } else {
                      $('#baptismDate').css('border-color', '').css('color', '');
                      $('#dateError').text('');
                      $('button[type="submit"]').prop('disabled', false);
                  }
              },
              error: function (xhr) {
                  console.error("Error checking date:", xhr);
              }
          });
      });
  });
  </script>
  <script>
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file && file.type !== 'application/pdf') {
                alert('Only PDF files are allowed.');
                this.value = ''; // Clear the invalid file
            }
        });
    });
    </script>
    
  
  

@include('layouts.footer')




@endsection


