
<script>$(document).ready(function() {
    // When category button is clicked, store selected category in data-category attribute
    $('#addReportModal .btn-primary').click(function() {
        var category = $(this).data('category');
        $('#selectEmployeeModal').attr('data-category', category);
    });

    // When selectEmployeeModal is shown, populate employee dropdown based on selected category
    $('#selectEmployeeModal').on('show.bs.modal', function() {
        var category = $(this).data('category');
        // Call an AJAX function to fetch employees based on selected category and populate the dropdown
    });

    // When selectEmployeeForm is submitted, handle the form submission
    $('#selectEmployeeForm').submit(function(event) {
        event.preventDefault();
        // Extract category and selected employee from data attributes and form data
        var category = $('#selectEmployeeModal').data('category');
        var employee = $(this).find('#employeeSelect').val();
        // Call a function to generate the report based on selected category and employee
        generateReport(category, employee);
        $('#selectEmployeeModal').modal('hide');
    });
});

// Function to generate report
function generateReport(category, employee) {
    // Implement the logic to generate the report
    // You may use AJAX to send data to the backend and handle the report generation process
}
</script>
