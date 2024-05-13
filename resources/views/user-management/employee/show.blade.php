<div class="modal fade bd-example-lg" id="show{{ $employee->id }}" tabindex="-1" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Equipments of {{ $employee->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label>Name:</label>
                        <p>{{ $employee->name }}</p>
                    </div>
                    <div class="col-md-12">
                        <label>Position</label>
                        <p>{{ $employee->position }}</p>
                    </div>

                    <div class="container" id="printContentEmployee">
                        <table id="showEmployee"
                            class="table table-bordered table-responsive table-striped custom-datatable">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Serial Number</th>
                                <th>Date Aquired</th>
                                <th>Condition</th>
                            </thead>
                            <tbody>
                                @foreach ($employee->equipments as $equipment)
                                    <tr>
                                        <td>{{ $equipment->id }}</td>
                                        <td>{{ $equipment->name }}</td>
                                        <td>{{ $equipment->description }}</td>
                                        <td>{{ $equipment->serial_number }}</td>
                                        <td>{{ $equipment->date_acquired }}</td>
                                        <td>{{ $equipment->condition }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="printBtn"
                    onclick="printPDF('{{ ROUTE('print.employee.equipment', $employee->id) }}')">Print</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    Close</button>
            </div>
        </div>
    </div>
    <script>
        /*    $(document).on('click', '#printBtn', function() {
            /*    // Open a new window
               var printWindow = window.open('', '_blank');
               var div = document.getElementById('printContentEmployee');
               // Write content to the new window
               printWindow.document.write('<html><head><title>Print</title></head><body>');
               printWindow.document.write('<h1>Print Preview</h1>');
               printWindow.document.write('<table border="1" style="border-collapse: collapse">');
               printWindow.document.write('<thead><tr align="left">');
               $('#showEmployee thead th').each(function() {
                   printWindow.document.write('<th>' + $(this).text() + '</th>');
               });
               printWindow.document.write('</tr></thead><tbody>');
               $('#showEmployee tbody tr').each(function() {
                   printWindow.document.write('<tr>');
                   $(this).find('td').each(function() {
                       printWindow.document.write('<td>' + $(this).text() + '</td>');
                   });
                   printWindow.document.write('</tr>');
               });
               printWindow.document.write('</tbody></table>');
               printWindow.document.write('</body></html>');

               // Close the document
               printWindow.document.close();

               // Trigger print in the new window
               printWindow.print();
        }); */

        function printPDF(url) {

            $.ajax({
                url: url, // URL to fetch the content of the div
                method: 'GET',
                success: function(response) {
                    // Once the content is fetched successfully
                    // Create a new window and write the content to it
                    var printWindow = window.open('', '_blank');
                    printWindow.document.write(response);

                    // Call window.print() to print the content
                    printWindow.document.close(); // Close the document for writing
                    printWindow.print(); // Print the content
                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.error(error);
                }
            });
        }
    </script>
</div>

