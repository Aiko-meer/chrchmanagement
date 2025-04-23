
                        <div class="separator" style="border-top: 2px solid #ddd; margin: 20px 0;"></div>
                        <div class="card-body">
                        <h3 class="card-title">Wedding Booked</h3>
                        <div class="table-responsive">
                          <table id="wedding-record-row" class="display table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">Record Code</th>
                                      <th style="width: 40%">Name of Couple</th>
                                      <th>Date of Wedding</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </thead>
                            
                              <tbody>
                              @foreach($WeddingRecords as $index => $record)
                                  <tr>
                                      <td>{{ $index + 1 }}</td>
                                      <td>{{ $record->record_code }}</td>
                                      <td>{{ $record->groom_first_name }} {{ $record->groom_middle_name }} {{ $record->groom_last_name }}  <br>
                                        {{ $record->bride_first_name }} {{ $record->bride_middle_name }} {{ $record->bride_last_name }}</td>
                                      <td>{{ \Carbon\Carbon::parse($record->wedding_date)->format('m/d/Y') }}</td>
                                      <td>
                                          <div class="form-button-action">
                                            <a href="{{ route('wedding.info', $record->id) }}" type="button" data-bs-toggle="tooltip" title="View Wedding Record" class="btn btn-link btn-primary btn-lg">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        <button type="button" data-bs-toggle="tooltip" title="Edit Wedding Record"
                                        class="btn btn-link btn-primary btn-lg"
                                        onclick="editWeddingRecord({{ json_encode($record)}})">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                              <button type="button" class="btn btn-link btn-danger btn-lg" title="Move to Archive"
                                              onclick="wedarchive({{ json_encode($record->id) }})">
                                              <i class="fa fa-archive"></i>
                                          </button>
                                              
                                          </div>
                                      </td>
                                  </tr>
                                  @endforeach
                                 
                              </tbody>
                          </table>
                      </div>
                      <div class="modal fade" id="updateFormModal" tabindex="-1" aria-labelledby="updateFormModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="updateFormModalLabel">Update Wedding Record</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="container">
                                <div class="page-inner">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="card">
                                        <form action="{{ route('weddings.update') }}" method="POST" enctype="multipart/form-data">
                                          @csrf
                                          @method('PUT')
                                          <div class="card-body">
                                            <h5 class="fw-bold mb-3">Update Wedding Record</h5>
                                     
                                            <input type="hidden" id="updateWeddingID" name="id"  />
                      
                                            <!-- Date of Wedding -->
                                            <div class="row">
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label for="updateWeddingDate">Date of Wedding</label>
                                                  <input type="date" class="form-control" name="wedding_date" id="updateWeddingDate"  />
                                                </div>
                                              </div>
                                            </div>
                      
                                            <!-- Groom's Information -->
                                            <h5 class="fw-bold mb-3">Groom's Information</h5>
                                            <div class="row">
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label for="updateGroomFirstName">First Name</label>
                                                  <input type="text" class="form-control" id="updateGroomFirstName" name="groom_first_name"  />
                                                </div>
                                              </div>
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label for="updateGroomMiddleName">Middle Name</label>
                                                  <input type="text" class="form-control" id="updateGroomMiddleName" name="groom_middle_name"  />
                                                </div>
                                              </div>
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label for="updateGroomLastName">Last Name</label>
                                                  <input type="text" class="form-control" id="updateGroomLastName" name="groom_last_name"  />
                                                </div>
                                              </div>
                                            </div>
                      
                                            <div class="row">
                                              <div class="col-md-7">
                                                <div class="form-group">
                                                  <label for="updateGroomBirthDate">Date of Birth</label>
                                                  <input type="date" class="form-control" name="groom_dob" id="updateGroomBirthDate"  />
                                                </div>
                                              </div>
                                            </div>
                      
                                            <!-- Groom's Residence Address -->
                                            <h5 class="fw-bold mb-3">Groom's Residence Address</h5>
                                                  <div class="row">
                                                    
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="updateGroomProvince">Groom's Province</label>
                                                            <select class="form-control" id="updateGroomProvince" name="groom_province">
                                                                <option value="">Select Province</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="updateGroomCity">Groom's City/Municipality</label>
                                                            <select class="form-control" id="updateGroomCity" name="groom_city">
                                                                <option value="">Select City/Municipality</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label for="updateGroomBarangay">Barangay</label>
                                                        <input type="text" class="form-control" id="updateGroomBarangay"name="groom_barangay" placeholder="Enter Barangay" />
                                                      </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                      <div class="form-group">
                                                        <label for="updateGroomStreetAddress">Street Address</label>
                                                        <input type="text" class="form-control" id="updateGroomStreetAddress"name="groom_street_address" placeholder="Enter Street Address" />
                                                      </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3">
                                                      <div class="form-group">
                                                        <label for="updateGroomPurokNo">Purok No.</label>
                                                        <input type="text" class="form-control" id="updateGroomPurokNo" name="groom_purok_no"placeholder="Enter Purok No." />
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label for="updateGroomContactNo">Contact No.</label>
                                                        <input type="text" class="form-control" id="updateGroomContactNo"name="groom_contact" placeholder="Enter Contact No." />
                                                      </div>
                                                    </div>
                      
                                            <!-- Similar fields for Bride's information -->
                                            <h5 class="fw-bold mb-3">Bride's Information</h5>
                                                  <div class="row">
                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label for="updateBrideFirstName">First Name</label>
                                                        <input type="text" class="form-control" id="updateBrideFirstName"name="bride_first_name" placeholder="Enter First Name" />
                                                      </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label for="updateBrideMiddleName">Middle Name</label>
                                                        <input type="text" class="form-control" id="updateBrideMiddleName"name="bride_middle_name" placeholder="Enter Middle Name" />
                                                      </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label for="updateBrideLastName">Last Name</label>
                                                        <input type="text" class="form-control" id="updateBrideLastName"name="bride_last_name" placeholder="Enter Last Name" />
                                                      </div>
                                                    </div>
                                                  </div>
                      
                                              
                                                  <div class="row">
                                                    <div class="col-md-7">
                                                      <div class="form-group">
                                                        <label for="updateBrideBirthDate">Date of Birth</label>
                                                        <input type="date" class="form-control" name="bride_dob"id="updateBrideBirthDate" />
                                                      </div>
                                                    </div>
                                                    
                                                  </div>
                                            <h5 class="fw-bold mb-3">Bride's Residence Address</h5>
                                                  <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="updateBrideProvince">Bride's Province</label>
                                                            <select class="form-control" id="updateBrideProvince" name="bride_province">
                                                                <option value="">Select Province</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="updateBrideCity">Bride's City/Municipality</label>
                                                            <select class="form-control" id="updateBrideCity" name="bride_city">
                                                                <option value="">Select City/Municipality</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label for="updateBrideBarangay">Barangay</label>
                                                        <input type="text" class="form-control" id="updateBrideBarangay"name="bride_barangay" placeholder="Enter Barangay" />
                                                      </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                      <div class="form-group">
                                                        <label for="updateBrideStreetAddress">Street Address</label>
                                                        <input type="text" class="form-control" id="updateBrideStreetAddress" name="bride_street_address"placeholder="Enter Street Address" />
                                                      </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                      <div class="form-group">
                                                        <label for="updateBridePurokNo">Purok No.</label>
                                                        <input type="text" class="form-control" id="updateBridePurokNo" name="bride_purok_no"placeholder="Enter Purok No." />
                                                      </div>
                                                    </div>
                                                    
                                                  
                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label for="updateBrideContactNo">Contact No.</label>
                                                        <input type="text" class="form-control" id="updateBrideContactNo"name="bride_contact" placeholder="Enter Contact No." />
                                                      </div>
                                                    </div>
                                                  </div>
                                            <!-- Documents Presented -->
                                            <h5 class="fw-bold mb-3">Documents Presented</h5>
                                            <div class="form-group mt-3">
                                              <label for="updatePresentedFile">Documents Presented</label>
                                              <input type="file" class="form-control" name="presented_file" id="updatePresentedFile" />
                                            </div>
                      
                                          </div>
                                          <div class="card-action">
                                            <button class="btn btn-primary">Update</button>
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
                        <script>
                            function wedarchive(id) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Do you want to Archive the Wedding Book?",
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, Archive Wedding Book!',
                                    cancelButtonText: 'No, cancel',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect to the retrieval route
                                        window.location.href = '/bookrecord/archive/' + id;
                                    }
                                });
                            }
                        </script> 
<script>
   
    // Function to populate the update form
    function editWeddingRecord(record) {
        
        document.getElementById("updateWeddingID").value = record.id;
        document.getElementById("updateWeddingDate").value = record.wedding_date;

        // Groom Information
        document.getElementById("updateGroomFirstName").value = record.groom_first_name;
        document.getElementById("updateGroomMiddleName").value = record.groom_middle_name;
        document.getElementById("updateGroomLastName").value = record.groom_last_name;
        document.getElementById("updateGroomBirthDate").value = record.groom_dob;
        
        document.getElementById("updateGroomBarangay").value = record.groom_barangay;
        document.getElementById("updateGroomStreetAddress").value = record.groom_street_address;
        document.getElementById("updateGroomPurokNo").value = record.groom_purok_no;
        document.getElementById("updateGroomContactNo").value = record.groom_contact;
        const childProvinceDropdown = $('#updateGroomProvince');
        childProvinceDropdown.val(record.groom_residence_province).change();
        setTimeout(() => {
            $('#updateGroomCity').val(record.groom_residence_city);
        }, 500);



        // Bride Information
        document.getElementById("updateBrideFirstName").value = record.bride_first_name;
        document.getElementById("updateBrideMiddleName").value = record.bride_middle_name;
        document.getElementById("updateBrideLastName").value = record.bride_last_name;
        document.getElementById("updateBrideBirthDate").value = record.bride_dob;
        
        document.getElementById("updateBrideBarangay").value = record.bride_barangay;
        document.getElementById("updateBrideStreetAddress").value = record.bride_street_address;
        document.getElementById("updateBridePurokNo").value = record.bride_purok_no;
        document.getElementById("updateBrideContactNo").value = record.bride_contact;
        const brideProvinceDropdown = $('#updateBrideProvince');
        brideProvinceDropdown.val(record.bride_residence_province).change();
        setTimeout(() => {
            $('#updateBrideCity').val(record.bride_residence_city);
        }, 500);
        // Document
        document.getElementById("updatePresentedFile").textContent = record.document || "No file uploaded";

        var updateModal = new bootstrap.Modal(document.getElementById('updateFormModal'));
        updateModal.show();
    }

    // Event listener for edit button click
    

    // Form submission handler for the update form
    document.getElementById("updateForm").addEventListener("submit", (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);

        fetch(`/weddings/update`, {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (response.ok) {
                    // Reload the page or update the UI to reflect changes
                    alert("Wedding record updated successfully!");
                    location.reload();
                } else {
                    alert("Error updating wedding record.");
                }
            })
            .catch((error) => console.error("Error submitting update form:", error));
    });

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
