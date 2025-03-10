<div class="card-body">
<h3 class="card-title">Donations</h3> 
    <div class="table-responsive">
        <table id="donation-table" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">Donator's Name</th>
                    <th style="width: 40%">Type Of Donation</th>
                    <th>Donated On</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">Donator's Name</th>
                    <th style="width: 40%">Type Of Donation</th>
                    <th>Donated On</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($donations as $donation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @foreach ($donation->donors as $donor)
                                {{ $donor->first_name }} {{ $donor->last_name }}<br>
                            @endforeach
                        </td>
                        <td>{{ ucfirst($donation->type) }}</td>
                        <td>{{ $donation->created_at->format('F j, Y, h:i A') }}</td>
                        <td>
                            <div class="form-button-action">
                            <button type="button" data-bs-toggle="tooltip" title="View Donation Record" class="btn btn-link btn-primary" onclick="window.location.href='/donation_info/{{ $donation->id }}'">
                                <i class="fas fa-eye"></i> 
                            </button>
                                
                                <button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Move to Archive" onclick="window.location.href='/donations/archive/{{ $donation->id }}'">
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
<h3 class="card-title">Collections</h3>
    <div class="table-responsive">
        <table id="collection-table" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">Acolyte's Name</th>
                    <th style="width: 40%">Collected On</th>
                    <th>Time</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">Acolyte's Name</th>
                    <th style="width: 40%">Collected On</th>
                    <th>Time</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($collections as $collection)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @foreach ($collection->acolytes as $acolyte)
                                {{ $acolyte->first_name }} {{ $acolyte->last_name }}
                            @endforeach
                        </td>
                        <td>{{ \Carbon\Carbon::parse($collection->collection_date)->format('F j, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($collection->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($collection->end_time)->format('h:i A') }}</td>
                        <td>
                            <div class="form-button-action">
                            <button type="button" data-bs-toggle="tooltip" title="View Collection Record" 
                                          class="btn btn-link btn-primary" onclick="window.location.href='/collection_info/{{ $collection->id }}'">
                                              <i class="fas fa-eye"></i> 
                                          </button>
                                
                                <button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Move to Archive" onclick="window.location.href='/collection_records/archive/{{ $collection->id }}'">
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
<h3 class="card-title">Payments</h3>
    <div class="table-responsive">
        <table id="payment-table" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">Name</th>
                    <th style="width: 40%">Reason of Payment</th>
                    <th>Payed On</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th style="width: 5%">#</th>
                    <th style="width: 15%">Name</th>
                    <th style="width: 40%">Reason of Payment</th>
                    <th>Payed On</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($payments as $index => $payment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $payment->first_name }} {{ $payment->middle_name }} {{ $payment->last_name }}</td>
                        <td>{{ $payment->reason }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('F j, Y') }}, {{ \Carbon\Carbon::parse($payment->payment_time)->format('g:i A') }}</td>
                        <td>
                            <div class="form-button-action">
                            <button type="button" data-bs-toggle="tooltip" title="View Payment Record" 
                                          class="btn btn-link btn-primary" onclick="window.location.href='/payment_info/{{ $payment->id }}'">
                                              <i class="fas fa-eye"></i> 
                                          </button>
                                <button type="button" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Move to Archive" onclick="window.location.href='/payment/archive/{{ $payment->id }}'">
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
