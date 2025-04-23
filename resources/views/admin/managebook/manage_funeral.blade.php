
                        <div class="card-body">
                        <!-- Modal -->
                        <h3 class="card-title">Funeral Record</h3>
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
                              <tbody>
                                  @foreach($FuneralRecords as $index => $record)
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
                                        <button type="button" class="btn btn-link btn-danger btn-lg" title="Move to Archive"
                                        onclick="funarchive({{ json_encode($record->id) }})">
                                        <i class="fa fa-archive"></i>
                                    </button>
                                            
                                          </div>
                                      </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                        </div>
                        <script>
                            function funarchive(id) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Do you want to Archive the Funeral Book?",
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, Archive Funeral Book!',
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