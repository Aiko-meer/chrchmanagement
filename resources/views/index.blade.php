@extends('layouts.header')
@section('content')
<div class="container">
    <div class="page-inner">
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
        <h3 class="fw-bold mb-3">Dashboard</h3>
        
        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="card card-stats card-round" data-bs-toggle="modal" data-bs-target="#recordModal">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-file-archive"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Church Records</p>
                                <h4 class="card-title">{{ $totalRecords }} </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="recordModalLabel">Church Records</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="/baptism" class="text-primary">Baptism Records: {{ $bookRecordsCount }} total</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/confirmation" class="text-primary">Confirmation Records: {{ $confirmationRecordsCount }} total</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/wedding" class="text-primary">Wedding Records: {{ $weddingRecordsCount }} total</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/funeral" class="text-primary">Funeral Records: {{ $funeralRecordsCount }} total</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
  
        <div class="col-sm-6 col-md-4">
        <a href="/member" class="text-decoration-none">
            <div class="card card-stats card-round">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                    <div
                        class="icon-big text-center icon-primary bubble-shadow-small"
                    >
                        <i class="fas fa-users"></i>
                    </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Ministry</p>
                        <h4 class="card-title">{{ $memberRecordsCount }}</h4>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </a>
        </div>
        
        
        <div class="col-sm-6 col-md-4">
        <a href="/donation" class="text-decoration-none">
            <div class="card card-stats card-round">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                    <div
                        class="icon-big text-center icon-success bubble-shadow-small"
                    >
                        <i class="fas fa-donate"></i>
                    </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Donations</p>
                        <h4 class="card-title">₱{{number_format( $DonationCashSum , 2)}}</h4>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-sm-6 col-md-4">
        <a href="/payment" class="text-decoration-none">
            <div class="card card-stats card-round">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                    <div
                        class="icon-big text-center icon-secondary bubble-shadow-small"
                    >
                        <i class="fas fa-money-bill"></i>
                    </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Payments</p>
                        <h4 class="card-title">₱{{number_format( $PaymentCashSum, 2) }}</h4>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </a>
        </div>
       
        <div class="col-sm-6 col-md-4">
        <a href="/schedules" class="text-decoration-none">
            <div class="card card-stats card-round">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                    <div
                        class="icon-big text-center icon-secondary bubble-shadow-small"
                    >
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Schedule</p>
                        <h4 class="card-title">{{ $scheduleRecordsCount }}</h4>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </a>
        </div>
        
       
    </div>
    
   
    <div class="row">
       
        <div class="col-md-8">
            <div class="card card-round">
                <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                    <div class="card-title">Transaction History</div>
                    
                </div>
            </div>
            <div class="card-body p-0">

                <div class="table-responsive">
                    <!-- Projects table -->
                    <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Payer's Name</th>
                        <th scope="col" class="text-end">Date & Time</th>
                        <th scope="col" class="text-end">Amount</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $index => $payment)
                        <tr>
                        <th scope="row">
                            <button
                            class="btn btn-icon btn-round btn-success btn-sm me-2"
                            >
                            
                            </button>
                            {{ $payment->first_name }} {{ $payment->middle_name }} {{ $payment->last_name }}
                        </th>
                        <td class="text-end">{{ \Carbon\Carbon::parse($payment->payment_date)->format('F j, Y') }}, {{ \Carbon\Carbon::parse($payment->payment_time)->format('g:i A') }}</td>
                        <td class="text-end">₱ {{ number_format((float) $payment->amount, 2) }}</td>

                        
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                    <div class="card-title">Monthly Monetary</div>
                    </div>
                    <div class="card-body">
                    <div class="chart-container">
                        <canvas
                        id="pieChart"
                        style="width: 50%; height: 50%"
                        ></canvas>
                    </div>
                    </div>
                </div>
                <div class="card card-round">
            <div class="card-body">
            <div class="card-head-row card-tools-still-right">
                <div class="card-title">Today</div>
                <div class="card-tools">
                <div class="dropdown">
                    <button
                    class="btn btn-icon btn-clean me-0"
                    type="button"
                    id="dropdownMenuButton"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    >
                    <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuButton"
                    >
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#"
                        >Something else here</a
                    >
                    </div>
                </div>
                </div>
            </div>
            
            <div class="container">
                <h3>Events for Today ({{ now()->format('F j, Y') }})</h3>
                @if ($todayEvents->isEmpty())
                    <p>No events scheduled for today.</p>
                @else
                    <ul>
                        @foreach ($todayEvents as $event)
                            <li>
                                <strong>{{ $event->title }}</strong><br>
                                Description: {{ $event->description }}<br>
                                Start: {{ \Carbon\Carbon::parse($event->start_date)->format('F j, Y h:i A') }}<br>
                                End: {{ \Carbon\Carbon::parse($event->end_date)->format('F j, Y h:i A') }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
            
            </div>
            </div>
          
        
    </div>
    <div class="row">
       
        </div>
        </div>
            
           
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var pieChart = document.getElementById("pieChart").getContext("2d");

        var myPieChart = new Chart(pieChart, {
            type: "pie",
            data: {
                datasets: [
                    {
                        data: [
                            {{ $DonationMonth }}, 
                            {{ $CollectionMonth }}, 
                            {{ $PaymentMonth }}
                        ],
                        backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b"],
                        borderWidth: 0,
                    },
                ],
                labels: ["Donation", "Collection", "Payments"],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "bottom",
                    labels: {
                        fontColor: "rgb(154, 154, 154)",
                        fontSize: 11,
                        usePointStyle: true,
                        padding: 20,
                    },
                },
                plugins: {
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function (tooltipItem) {
                                // Access the current value
                                const value = tooltipItem.raw;
                                // Manually format the value with the PHP currency symbol
                                return `₱ ${new Intl.NumberFormat('en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2,
                                }).format(value)}`;
                            },
                        },
                    },
                },
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20,
                    },
                },
            },
        });
    });
</script>




@include('layouts.footer')




@endsection


