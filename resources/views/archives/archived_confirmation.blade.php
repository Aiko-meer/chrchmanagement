
<div class="card-body">
<div class="table-responsive">
        <table
        id="confirmation-table"
        class="display table table-striped table-hover"
    
        >
            <thead>
                <tr>
                <th> Year</th>
                <th>No. Confirmed Record</th>
                
                <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                <th> Year</th>
                <th>No. Confirmed Record</th>
                
                <th style="width: 10%">Action</th>
                </tr>
            </tfoot>
            <tbody>
            @foreach($ConfirmationrecordCounts as $confirmation)
                    <tr>
                    <td><i class="fas fa-book"> - </i> {{ $confirmation['year'] }}</td>
                        <td>{{ $confirmation['funeral_count'] }} Total Confirmation Record of {{ $confirmation['year'] }} </td>
                        <td>
                            <div class="form-button-action">
                                <button
                                    type="button"
                                    data-bs-toggle="tooltip"
                                    title="Edit Task"
                                    class="btn btn-link btn-primary btn-lg"
                                    data-original-title="Edit Task"
                                    onclick="window.location.href='/confirmationfolder/archive/month/{{$confirmation['year']}}'"
                                >
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button
                                    type="button"
                                    data-bs-toggle="tooltip"
                                    title="Move to Archive"
                                    class="btn btn-link btn-danger"
                                    data-original-title="Move to Archive"
                                    onclick="window.location.href='/confirmationfolder/archive/'"
                                    
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

<div class="separator" style="border-top: 2px solid #ddd; margin: 20px 0;"></div>


<div class="card-body">
                        <!-- Modal -->
                     

                        <div class="table-responsive">
                          <table id="confirmation-record-table" class="display table table-striped table-hover">
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
                                              <button type="button" data-bs-toggle="tooltip" title="Move to Archive"
                                                  class="btn btn-link btn-danger" onclick="window.location.href='/confirmationrecord/archive/{{ $record->id }}'">
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