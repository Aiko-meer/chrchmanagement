@extends('layouts.header')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Confirmation</h3>
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
            
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Confirmation</h4>
                               
                            </div>
                        </div>
                       

                        <div class="table-responsive">
                            <table
                            id="add-row"
                            class="display table table-striped table-hover"
                       
                            >
                            <thead>
                                <tr>
                                <th> Month</th>
                                <th>No. Confirmed Record</th>
                                
                                <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th> Month</th>
                                <th>No. Confirmed Record</th>
                                
                                <th style="width: 10%">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @foreach($confirmations as $confirmation)
                                    <tr>
                                    <td><i class="fas fa-book"> - </i> {{ $confirmation['month'] }}</td>
                                        <td>{{ $confirmation['funeral_count'] }} Total Confirmation Record of {{ $confirmation['year'] }} </td>
                                        <td>
                                            <div class="form-button-action">
                                                <button
                                                    type="button"
                                                    data-bs-toggle="tooltip"
                                                    title="Edit Task"
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Task"
                                                    onclick="window.location.href='/confirmation_record/{{ $confirmation['id'] }}'"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button
                                                    type="button"
                                                    data-bs-toggle="tooltip"
                                                    title="Move to Archive"
                                                    class="btn btn-link btn-danger"
                                                    data-original-title="Move to Archive"
                                                    onclick="window.location.href='/confirmationfolder/archive/{{ $confirmation['id'] }}'"
                                                    
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
                    </div>
                </div>
               

                
            </div>
    </div>
</div>

<script>
      document.addEventListener("DOMContentLoaded", async function () {
    let today = new Date();
    let day = today.getDate(); // Get the current day (1-31)
    
    if (day === 10) { // Run only on the 28th day
        let year = today.getFullYear();
        let month = today.toLocaleString('default', { month: 'long' }); // Get full month name

        try {
            // Step 1: Check if the record already exists
            let response = await fetch(`/api/check-year-month-confirmation?year=${year}&month=${month}`);
            let result = await response.json();

            if (result.exists) {
                console.log("Record already exists, skipping...");
            } else {
                // Step 2: Add the new record if it doesn't exist
                let data = { year: year, month: month };

                let saveResponse = await fetch('/api/add-year-confirmation', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") // CSRF Token for security
                    },
                    body: JSON.stringify(data)
                });

                let saveResult = await saveResponse.json();
                console.log("Success:", saveResult);
            }
        } catch (error) {
            console.error("Error:", error);
        }
    }
});
</script>

@include('layouts.footer')




@endsection


