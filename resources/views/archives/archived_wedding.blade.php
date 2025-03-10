<div class="card-body">
<h3 class="card-title">Wedding Folder</h3>
<div class="table-responsive">
                            <table
                            id="wedding-row"
                            class="display table table-striped table-hover"
                       
                            >
                            <thead>
                                <tr>
                                    <th> Year</th>
                                    <th>No. Weddings</th>
                                    
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th> Year</th>
                                    <th>No. Weddings</th>
                                    
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($WeddingrecordCounts as $wedding)
                                    <tr>
                                    <td><i class="fas fa-book"> - </i> {{ $wedding['year'] }}</td>
                                        <td>{{ $wedding['wedding_count'] }} Total numbers of Wedding</td>
                                        <td>
                                            <div class="form-button-action">
                                                <button
                                                    type="button"
                                                    data-bs-toggle="tooltip"
                                                    title="Edit Task"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Task"
                                                    onclick="window.location.href='/weddingfolder/archive/month/{{ $wedding['year'] }}'"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button
                                                    type="button"
                                                    data-bs-toggle="tooltip"
                                                    title="Move to Archive"
                                                    class="btn btn-link btn-danger"
                                                    data-original-title="Remove"
                                                    onclick="window.location.href='/weddingfolder/archive/'"
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
                        <h3 class="card-title">Wedding Records</h3>
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
                                      <td>{{ \Carbon\Carbon::parse($record->wedding_date)->format('m/d/Y') }}</td>
                                      <td>
                                          <div class="form-button-action">
                                          <a href="" type="button" data-bs-toggle="tooltip" title="View Baptism Record" class="btn btn-link btn-primary btn-lg">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                              <button type="button" data-bs-toggle="tooltip" title="Edit Baptism Record"
                                                  class="btn btn-link btn-primary btn-lg"
                                                  onclick="">
                                                  <i class="fa fa-edit"></i>
                                              </button>
                                              <button type="button" data-bs-toggle="tooltip" title="Remove"
                                                  class="btn btn-link btn-danger" onclick="window.location.href='/weddingrecord/archive/{{ $record->id }}'">
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
                        