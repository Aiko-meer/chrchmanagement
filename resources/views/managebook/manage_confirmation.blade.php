
<div class="card-body">
                        <!-- Modal -->
                     

                        <div class="table-responsive">
                          <table id="confirmation-record-table" class="display table table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th style="width: 5%">#</th>
                                      <th style="width: 15%">book Code</th>
                                      <th style="width: 40%">Name of Confirmands</th>
                                      <th>Date of Confirmation</th>
                                      <th style="width: 10%">Action</th>
                                  </tr>
                              </thead>
                             
                              <tbody>
                                  
                              @foreach($confirmationRecords as $index => $record)
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
                                        <button type="button" class="btn btn-link btn-danger btn-lg" title="Move to Archive"
                                        onclick="conarchive({{ json_encode($record->id) }})">
                                        <i class="fa fa-archive"></i>
                                    </button>
                                    
                                    @auth
                                    @if(session('user_type') == '1')
                                        <button type="button" class="btn btn-link btn-danger btn-lg" title="Move to Archive"
                                            onclick="confirmdelete({{ json_encode($record->id) }})">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    @endif
                                @endauth
                                
                                
                                            
                                          </div>
                                      </td>
                                  </tr>
                                  @endforeach
                                 
                              </tbody>
                          </table>
                      </div>
                        </div>
                        <script>
                            function conarchive(id) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Do you want to Archive the Confirmation Book?",
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, Archive Confirmation Book!',
                                    cancelButtonText: 'No, cancel',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect to the retrieval route
                                        window.location.href = '/confirmationrecord/archive/' + id;
                                    }
                                });
                            }
                        </script>
                        <script>
                            function confirmdelete(id) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Do you want to Delete the Confirmation Record?",
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, Delete Rec!',
                                    cancelButtonText: 'No, cancel',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect to the retrieval route
                                        window.location.href = '/confirmation/delete/' + id;
                                    }
                                });
                            }
                        </script>
