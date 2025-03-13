@extends('layouts.header')
@section('content')

<script>
  document.addEventListener("DOMContentLoaded", function () {
      const godparentsContainer = document.getElementById("godparents-container");
      const addGodparentBtn = document.getElementById("add-godparent-btn");

      // Clear container to ensure it starts empty
      godparentsContainer.innerHTML = '';

      // Function to create a new godparent entry
      function createGodparentEntry() {
          const godparentEntry = document.createElement("div");
          godparentEntry.classList.add("godparent-entry");

          godparentEntry.innerHTML = `
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" class="form-control" name="godparentFirstName[]" placeholder="Enter First Name" />
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Middle Name</label>
                          <input type="text" class="form-control" name="godparentMiddleName[]" placeholder="Enter Middle Name" />
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" class="form-control" name="godparentLastName[]" placeholder="Enter Last Name" />
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Purok No.</label>
                          <input type="text" class="form-control" name="godparentPurok[]" placeholder="Enter Purok No." />
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Street Address</label>
                          <input type="text" class="form-control" name="godparentStreetAddress[]" placeholder="Enter Street Address" />
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Barangay</label>
                          <input type="text" class="form-control" name="godparentBarangay[]" placeholder="Enter Barangay" />
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Province</label>
                          <select class="form-control godparentProvince" name="godparentProvince[]">
                              <option value="">Select Province</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Municipality/City</label>
                          <select class="form-control godparentCity" name="godparentCity[]">
                              <option value="">Select Municipality/City</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-12">
                      <button type="button" class="btn btn-danger remove-godparent">Remove</button>
                  </div>
              </div>
              <hr />
          `;

          // Add event listener for removing a godparent entry
          godparentEntry.querySelector(".remove-godparent").addEventListener("click", function () {
              godparentEntry.remove();
          });

          return godparentEntry;
      }

      // Add new godparent entry when the button is clicked
      addGodparentBtn.addEventListener("click", function () {
          const newGodparentEntry = createGodparentEntry();
          godparentsContainer.appendChild(newGodparentEntry);

          // Populate provinces for the new entry
          populateProvinces(newGodparentEntry.querySelector('.godparentProvince'));
      });

      // Populate provinces dynamically
      function populateProvinces(provinceSelector) {
          fetch('https://psgc.gitlab.io/api/provinces/')
              .then(response => response.json())
              .then(data => {
                  let provinceOptions = '<option value="">Select Province</option>';
                  data.forEach(province => {
                      provinceOptions += `<option value="${province.name}">${province.name}</option>`;
                  });
                  provinceSelector.innerHTML = provinceOptions;
              })
              .catch(error => console.error('Error loading provinces:', error));
      }

      // Populate cities dynamically when a province is selected
      function populateCities(provinceSelector, citySelector) {
          const selectedProvinceName = provinceSelector.value;
          if (selectedProvinceName) {
              fetch('https://psgc.gitlab.io/api/provinces/')
                  .then(response => response.json())
                  .then(data => {
                      const province = data.find(p => p.name === selectedProvinceName);
                      if (province) {
                          return fetch(`https://psgc.gitlab.io/api/provinces/${province.code}/cities-municipalities/`);
                      } else {
                          throw new Error('Province not found');
                      }
                  })
                  .then(response => response.json())
                  .then(data => {
                      let cityOptions = '<option value="">Select City/Municipality</option>';
                      data.forEach(city => {
                          cityOptions += `<option value="${city.name}">${city.name}</option>`;
                      });
                      citySelector.innerHTML = cityOptions;
                  })
                  .catch(error => console.error('Error loading cities:', error));
          } else {
              citySelector.innerHTML = '<option value="">Select City/Municipality</option>';
          }
      }

      // Handle province selection change only when triggered by the user
      godparentsContainer.addEventListener("change", function (event) {
          if (event.isTrusted && event.target.classList.contains('godparentProvince')) {
              const citySelector = event.target.closest('.row').querySelector('.godparentCity');
              populateCities(event.target, citySelector);
          }
      });
  });
</script>

<script>
    // Function to get the ID from the URL
    function getIdFromUrl() {
        const urlSegments = window.location.pathname.split('/'); // Split the URL by '/'
        const id = urlSegments[urlSegments.length - 1]; // Get the last segment (the ID)
        document.getElementById('baptismId').value = id; // Set the value of the hidden input
    }

    // Call the function when the document is ready
    document.addEventListener('DOMContentLoaded', getIdFromUrl);
    
</script>
<script>
   function editBaptismRecord(record) {
        // Set form action URL
        const form = document.getElementById('editBaptismRecordForm');
        form.action = form.action.replace(':id', record.id);

        // Populate form fields with existing record data
        document.getElementById('editSeriesYearNo').value = record.series_year_no;
        document.getElementById('editBookNo').value = record.book_no;
        document.getElementById('editRecordCode').value = record.record_code;
        document.getElementById('editPageNo').value = record.page_no;
        document.getElementById('editBaptismDate').value = record.baptism_date;

        // Child Information
        document.getElementById('editChildFirstName').value = record.child_first_name;
        document.getElementById('editChildMiddleName').value = record.child_middle_name;
        document.getElementById('editChildLastName').value = record.child_last_name;
        document.getElementById('editChildDob').value = record.child_dob;
        document.getElementById('editChildProvince').value = record.child_province;
        document.getElementById('editChildCity').value = record.child_city;

        // Father Information
        document.getElementById('editFatherFirstName').value = record.father_first_name;
        document.getElementById('editFatherMiddleName').value = record.father_middle_name;
        document.getElementById('editFatherLastName').value = record.father_last_name;
        document.getElementById('editFatherProvince').value = record.father_province;
        document.getElementById('editFatherCity').value = record.father_city;

        // Mother Information
        document.getElementById('editMotherFirstName').value = record.mother_first_name;
        document.getElementById('editMotherMiddleName').value = record.mother_middle_name;
        document.getElementById('editMotherLastName').value = record.mother_last_name;
        document.getElementById('editMotherProvince').value = record.mother_province;
        document.getElementById('editMotherCity').value = record.mother_city;

        // Residence Address
        document.getElementById('editPurokNo').value = record.purok_no;
        document.getElementById('editStreetAddress').value = record.street_address;
        document.getElementById('editBarangay').value = record.barangay;
        document.getElementById('editResidenceProvince').value = record.residence_province;
        document.getElementById('editResidenceCity').value = record.residence_city;

        // Remove any existing godparent entries before populating new ones
        fetch(`/godparents/${record.id}`)
    .then(response => response.json())
    .then(data => {
        // Clear existing entries
        const godparentList = document.getElementById('godparentList');
        godparentList.innerHTML = '';

        // Populate godparent fields
        data.forEach((godparent, index) => {
            addGodparentField(
                godparent.id,
                godparent.first_name,
                godparent.middle_name,
                godparent.last_name,
                godparent.purok_no,
                godparent.street_address,
                godparent.barangay,
                godparent.municipality_city,
                godparent.province,
                index
            );
        });
    })
    .catch(error => console.error('Error fetching godparents:', error));

        function addGodparentField(id,firstName, middleName, lastName, purokNo, streetAddress, barangay, municipalityCity, province, index) {
    const godparentList = document.getElementById('godparentList');

    const godparentDiv = document.createElement('div');
    godparentDiv.classList.add('godparent-entry', 'mb-3');

    godparentDiv.innerHTML = `
        <h5 class="mt-2">Godparent ${index + 1}</h5>
        <div class="row">
        <input type="hidden" name="godparent_id[]" value="${id}" />
            <div class="col-md-4">
                <div class="form-group">
                    <label for="editGodparentFirstName${index}">First Name</label>
                    <input type="text" class="form-control" id="editGodparentFirstName${index}" name="godparent_first_name[]" value="${firstName}" required />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="editGodparentMiddleName${index}">Middle Name</label>
                    <input type="text" class="form-control" id="editGodparentMiddleName${index}" name="godparent_middle_name[]" value="${middleName}" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="editGodparentLastName${index}">Last Name</label>
                    <input type="text" class="form-control" id="editGodparentLastName${index}" name="godparent_last_name[]" value="${lastName}" required />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="editGodparentPurokNo${index}">Purok No.</label>
                    <input type="text" class="form-control" id="editGodparentPurokNo${index}" name="godparent_purok_no[]" value="${purokNo}" required />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="editGodparentStreetAddress${index}">Street Address</label>
                    <input type="text" class="form-control" id="editGodparentStreetAddress${index}" name="godparent_street_address[]" value="${streetAddress}" required />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="editGodparentBarangay${index}">Barangay</label>
                    <input type="text" class="form-control" id="editGodparentBarangay${index}" name="godparent_barangay[]" value="${barangay}" required />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                    <div class="form-group">
                        <label for="editGodparentProvince${index}">Province</label>
                        <input type="text" class="form-control" id="editGodparentProvince${index}" name="godparent_province[]" value="${province}" required />
                    </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="editGodparentMunicipalityCity${index}">Municipality/City</label>
                    <input type="text" class="form-control" id="editGodparentMunicipalityCity${index}" name="godparent_municipality_city[]" value="${municipalityCity}" required />
                </div>
            </div>
            
        </div>
    `;

    // Append the new godparent fields to the list
    godparentList.appendChild(godparentDiv);
}
        $('#editBaptismRecordModal').modal('show');
    }
    
    
</script>
<script>
$(document).ready(function() {
  $(document).ready(function() {
  $('#baptismRecordForm').on('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    const submitButton = $(this).find('button[type="submit"]');
    submitButton.prop('disabled', true).text('Submitting...');

    $('.form-error').remove(); // Clear previous error messages

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(response) {
    console.log("✅ Success Response:", response); // Debugging

    if (response.success) {
        Swal.fire({
            title: 'Success!',
            text: response.message,
            icon: 'success',
            confirmButtonText: 'Okay'
        }).then(() => {
            location.reload(); // Reload the page after closing the alert
        });
    } else {
        // If success = false, handle it as an error
        Swal.fire({
            title: 'Limit Reached!',
            text: response.message,
            icon: 'warning',
            confirmButtonText: 'Okay'
        });
    }
},
        error: function(xhr) {
    submitButton.prop('disabled', false).text('Submit');

    console.log("❌ Error Response:", xhr); 
    console.log("❌ Status Code:", xhr.status); // Log status code
    console.log("❌ Response JSON:", xhr.responseJSON); // Log full response

    if (xhr.status === 400) {
        Swal.fire({
            title: 'Limit Reached!',
            text: xhr.responseJSON?.message || 'Sorry, no more bookings allowed for this date.',
            icon: 'warning',
            confirmButtonText: 'Okay'
        });
    } 
    else if (xhr.status === 422) {
        const errors = xhr.responseJSON.errors;
        for (const field in errors) {
            const errorMsg = `<div class="form-error text-danger">${errors[field][0]}</div>`;
            $(`#${field}`).after(errorMsg);
        }
    } 
    else {
        Swal.fire({
            title: 'Error!',
            text: 'An error occurred. Please try again later.',
            icon: 'error',
            confirmButtonText: 'Okay'
        });
    }
}

    });
  });
});

}
</script>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Baptism Book No. {{ $bookFolder->book_number }} of {{ $baptismYear }} Records</h3>
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
                <a href="/baptism">Baptism</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/book/{{ $baptismID }}">Baptism Book  of {{ $baptismYear }} Records</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="/book_record/{{ $bookFolder->id }}">Baptism Book No. {{ $bookFolder->book_number }} of {{ $baptismYear }} Records</a>
            </li>
            
            
            </ul>
        </div>

       
      <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="formModalLabel">Baptism Record Form</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="baptismRecordForm" action="{{ route('baptism.record.store', $baptism_id) }}" method="POST">
              @csrf
                <div class="container">
                  <div class="page-inner">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                          <input type="hidden" id="baptismId" name="baptism_id" value="{{ $baptism_id }}" />
                          <input type="hidden" id="baptism" name="baptismid" value="{{ $baptismID }}" />
                          <input type="hidden" id="baptismyear" name="baptismYear" value="{{ $baptismYear }}" />
                          
                          <!-- Series/Year No., Book No., Page No., Record Code, and Date of Baptism -->
                          <h5 class="fw-bold mb-3">Baptism Record Details</h5>
                            <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="seriesYearNo">Series/Year No.</label>
                                      <input type="text" class="form-control" id="seriesYearNo" name="seriesYearNo" value="{{ $baptismYear }}" readonly>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="bookNo">Book No.</label>
                                      <input type="text" class="form-control" id="bookNo" name="bookNo" value="{{ $bookFolder->book_number }}" readonly>
                                  </div>
                              </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pageNo">Page No.</label>
                                        <input type="text" class="form-control" id="pageNo" name="pageNo" placeholder="Enter Page No." required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
    <div class="form-group">
        <label for="baptismDate">Date of Baptism</label>
        <input type="date" class="form-control" id="baptismDate" name="baptismDate" required>
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
                                        <input type="text" class="form-control" id="childFirstName" name="status" value="0" placeholder="Enter First Name">
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
                                <div class="col-md-12">
                                    <label for="fatherBirthPlace">Place of Birth:</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fatherProvince">Father's Province</label>
                                        <select class="form-control" id="fatherProvince" name="fatherProvince">
                                            <option value="">Select Province</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fatherCity">Father's City/Municipality</label>
                                        <select class="form-control" id="fatherCity" name="fatherCity">
                                            <option value="">Select City/Municipality</option>
                                        </select>
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
                                <div class="col-md-12">
                                    <label for="motherBirthPlace">Place of Birth:</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="motherProvince">Mother's Province</label>
                                        <select class="form-control" id="motherProvince" name="motherProvince">
                                            <option value="">Select Province</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="motherCity">Mother's City/Municipality</label>
                                        <select class="form-control" id="motherCity" name="motherCity">
                                            <option value="">Select City/Municipality</option>
                                        </select>
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

                            <!-- Godparent Information (Dynamic Fields) -->
                            <h5 class="fw-bold mb-3">Godparent Information</h5>
                            <div id="godparents-container">
                            
                           
                                
                          
                              

                          </div>
                          <button type="button" id="add-godparent-btn" class="btn btn-primary">Add Godparent</button>
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
      </div>
      
    

        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Baptism Book No. {{ $bookFolder->book_number }} of {{ $baptismYear }} Records</h4>
                                <button
                                class="btn btn-primary btn-round ms-auto"
                                data-bs-toggle="modal" data-bs-target="#formModal"
                                >
                                <i class="fa fa-plus"></i>
                                New Baptism
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
                                      <th style="width: 40%">Name of Child</th>
                                      <th>Date of Baptism</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </thead>
                              <tfoot>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th>Record Code</th>
                                      <th>Name of Child</th>
                                      <th>Date of Baptism</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </tfoot>
                              <tbody>
                                  @foreach($bookRecords as $index => $record)
                                  <tr>
                                      <td>{{ $index + 1 }}</td>
                                      <td>{{ $record->record_code }}</td>
                                      <td>{{ $record->child_first_name }} {{ $record->child_middle_name }} {{ $record->child_last_name }}</td>
                                      <td>{{ \Carbon\Carbon::parse($record->baptism_date)->format('m/d/Y') }}</td>
                                      <td>
                                          <div class="form-button-action">
                                          <a href="{{ route('book.record.info', $record->id) }}" type="button" data-bs-toggle="tooltip" title="View Baptism Record" class="btn btn-link btn-primary btn-lg">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" data-bs-toggle="tooltip" title="Edit Baptism Record" class="btn btn-link btn-primary btn-lg"
                                        onclick="editBaptismRecord({{ json_encode($record) }})">
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
<div class="modal fade" id="editBaptismRecordModal" tabindex="-1" aria-labelledby="editBaptismRecordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editBaptismRecordModalLabel">Edit Baptism Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editBaptismRecordForm" action="{{ route('baptism.record.update', ':id') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <!-- Series/Year, Book No., Page No. -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="editSeriesYearNo">Series/Year No.</label>
                <input type="text" class="form-control" id="editSeriesYearNo" name="series_year_no" required />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editBookNo">Book No.</label>
                <input type="text" class="form-control" id="editBookNo" name="book_no" required />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editPageNo">Page No.</label>
                <input type="text" class="form-control" id="editPageNo" name="page_no" required />
              </div>
            </div>
          </div>

          <!-- Record Code, Date of Baptism -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="editRecordCode">Record Code</label>
                <input type="text" class="form-control" id="editRecordCode" name="record_code" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editBaptismDate">Date of Baptism</label>
                <input type="date" class="form-control" id="editBaptismDate" name="baptism_date" required />
              </div>
            </div>
          </div>

          <!-- Child Information -->
          <h5 class="mt-4">Child's Information</h5>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="editChildFirstName">First Name</label>
                <input type="text" class="form-control" id="editChildFirstName" name="child_first_name" required />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editChildMiddleName">Middle Name</label>
                <input type="text" class="form-control" id="editChildMiddleName" name="child_middle_name" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editChildLastName">Last Name</label>
                <input type="text" class="form-control" id="editChildLastName" name="child_last_name" required />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="editChildDob">Date of Birth</label>
                <input type="date" class="form-control" id="editChildDob" name="child_dob" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editChildProvince">Province</label>
                <input type="text" class="form-control" id="editChildProvince" name="child_province" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editChildCity">City</label>
                <input type="text" class="form-control" id="editChildCity" name="child_city" required />
              </div>
            </div>
          </div>


          <!-- Father's Information -->
          <h5 class="mt-4">Father's Information</h5>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="editFatherFirstName">First Name</label>
                <input type="text" class="form-control" id="editFatherFirstName" name="father_first_name" required />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editFatherMiddleName">Middle Name</label>
                <input type="text" class="form-control" id="editFatherMiddleName" name="father_middle_name" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editFatherLastName">Last Name</label>
                <input type="text" class="form-control" id="editFatherLastName" name="father_last_name" required />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="editFatherProvince">Province</label>
                <input type="text" class="form-control" id="editFatherProvince" name="father_province" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editFatherCity">City</label>
                <input type="text" class="form-control" id="editFatherCity" name="father_city" required />
              </div>
            </div>
          </div>

          <!-- Mother's Information -->
          <h5 class="mt-4">Mother's Information</h5>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="editMotherFirstName">First Name</label>
                <input type="text" class="form-control" id="editMotherFirstName" name="mother_first_name" required />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editMotherMiddleName">Middle Name</label>
                <input type="text" class="form-control" id="editMotherMiddleName" name="mother_middle_name" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editMotherLastName">Last Name</label>
                <input type="text" class="form-control" id="editMotherLastName" name="mother_last_name" required />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="editMotherProvince">Province</label>
                <input type="text" class="form-control" id="editMotherProvince" name="mother_province" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editMotherCity">City</label>
                <input type="text" class="form-control" id="editMotherCity" name="mother_city" required />
              </div>
            </div>
          </div>

          <!-- Residence Information -->
          <h5 class="mt-4">Residence Information</h5>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="editPurokNo">Purok No.</label>
                <input type="text" class="form-control" id="editPurokNo" name="purok_no" required />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editStreetAddress">Street Address</label>
                <input type="text" class="form-control" id="editStreetAddress" name="street_address" required />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="editBarangay">Barangay</label>
                <input type="text" class="form-control" id="editBarangay" name="barangay" required />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="editResidenceProvince">Province</label>
                <input type="text" class="form-control" id="editResidenceProvince" name="residence_province" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="editResidenceCity">City/Municipality</label>
                <input type="text" class="form-control" id="editResidenceCity" name="residence_city" required />
              </div>
            </div>
          </div>
          <div id="godparentList"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#baptismDate').on('change', function() {
        let selectedDate = $(this).val();
        
        if (!selectedDate) return; // Stop if no date selected

        $.ajax({
            url: '/check-baptism-date', // Laravel route to check the date
            type: 'GET',
            data: { date: selectedDate },
            success: function(response) {
                if (response.isFull) {
                    $('#baptismDate').css('border-color', 'red').css('color', 'red');
                    $('#dateError').text('This date is fully booked. Please select another date.');
                } else {
                    $('#baptismDate').css('border-color', '').css('color', '');
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
            text: "Do you want to Cancel the Baptism Book?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Cancel Book!',
            cancelButtonText: 'No, cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the retrieval route
                window.location.href = '/delete_record/' + id;
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
                window.location.href = '/checkbaptism/' + id;
            }
        });
    }
</script>

@include('layouts.footer')




@endsection


