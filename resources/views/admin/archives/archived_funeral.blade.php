<div class="card-body">
                        
<h3 class="card-title">Funeral Folder</h3>
                        <div class="table-responsive">
                            <table
                            id="add-row"
                            class="display table table-striped table-hover"
                       
                            >
                            <thead>
                                <tr>
                                    <th> Year</th>
                                    <th>No. Funeral Records</th>
                                    
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th> Year</th>
                                    <th>No. Funeral Records</th>
                                    
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($FuneralrecordCounts as $funeral)
                                    <tr>
                                    <td><i class="fas fa-book"> - </i> {{ $funeral['year'] }}</td>
                                        <td>{{ $funeral['funeral_count'] }} Total Funeral Record of {{ $funeral['year'] }} </td>
                                        <td>
                                            <div class="form-button-action">
                                                <button
                                                    type="button"
                                                    data-bs-toggle="tooltip"
                                                    title="Edit Task"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Task"
                                                    onclick="window.location.href='/funeralfolder/archive/month/{{ $funeral['year'] }}'"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-secondary btn-lg" title="Retrieve"
                                              onclick="confirmRetrieveFolderfuneral({{ $funeral['year'] }})">
                                          <i class="fas fa-undo"></i>
                                          </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        </div>
                        <div class="separator" style="border-top: 2px solid #ddd; margin: 20px 0;"></div>

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
                                        <button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-secondary btn-lg" title="Retrieve"
                                        onclick="confirmRetrieveRecordfuneral({{ $record['id'] }})">
                                    <i class="fas fa-undo"></i>
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
                            function confirmRetrieveFolderfuneral(year) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Do you want to retrieve this Funeral Folder?",
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, retrieve it!',
                                    cancelButtonText: 'No, cancel',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect to the retrieval route
                                        window.location.href = '/funeralfolder/archive/retrieve/' + year;
                                    }
                                });
                            }
                            function confirmRetrieveRecordfuneral(id) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "Do you want to retrieve this Funeral record?",
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, retrieve it!',
                                    cancelButtonText: 'No, cancel',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect to the retrieval route
                                        window.location.href = '/funeral_record_archived/retrieve/' + id;
                                    }
                                });
                            }
                        </script>