    @extends('layouts.header')

    @section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Collection</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="/"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item">
                        <a href="/collection">Collection</a>
                    </li>
                </ul>
            </div>

            <div>
                <h4>Collection</h4>
                <button onclick="printTable()" style="padding: 8px 16px; background: #007bff; color: #fff; border: none; cursor: pointer;">
                    Print
                </button>
            </div>

            <div style="margin-top: 10px;">
                <table id="collection-table" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <thead>
                        <tr style="background-color: #f2f2f2;">
                            <th style="border: 1px solid black; padding: 8px;">#</th>
                            <th style="border: 1px solid black; padding: 8px;">Amount</th>
                            <th style="border: 1px solid black; padding: 8px;">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalAmount = 0; @endphp <!-- Initialize total amount -->
                        
                        @foreach ($collections as $collection)
                        @php $totalAmount += $collection->money_amount; @endphp <!-- Add each amount to total -->
                        <tr>
                            <td style="border: 1px solid black; padding: 8px;">{{ $loop->iteration }}</td>
                            <td style="border: 1px solid black; padding: 8px;">{{ $collection->money_amount }}</td>
                            <td style="border: 1px solid black; padding: 8px;">
                                {{ \Carbon\Carbon::parse($collection->start_time)->format('h:i A') }} - 
                                {{ \Carbon\Carbon::parse($collection->end_time)->format('h:i A') }}
                            </td>
                        </tr>
                        @endforeach
                    
                        <!-- TOTAL ROW -->
                        <tr style="font-weight: bold; background-color: #f2f2f2;">
                            <td style="border: 1px solid black; padding: 8px; text-align: right;" colspan="1">Total:</td>
                            <td style="border: 1px solid black; padding: 8px;">{{ $totalAmount }}</td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

    <script>
        function printTable() {
            var tableContent = document.getElementById('collection-table').outerHTML;
            var printWindow = window.open('', '', 'width=900,height=700');
            
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Print Collection</title>
                        <style>
                            body { font-family: Arial, sans-serif; }
                            table { width: 100%; border-collapse: collapse; }
                            th, td { border: 1px solid black; padding: 8px; text-align: left; }
                            th { background-color: #f2f2f2; }
                        </style>
                    </head>
                    <body>
                        <h2>Collection Report</h2>
                        ${tableContent}
                    </body>
                </html>
            `);

            printWindow.document.close();
            printWindow.print();
        }
    </script>

    @include('layouts.footer')

    @endsection
