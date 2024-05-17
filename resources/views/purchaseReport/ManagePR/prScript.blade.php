<script>
    document.addEventListener('DOMContentLoaded', function () {
        const itemsContainer = document.querySelectorAll('.item-container');

        itemsContainer.forEach(container => {
            const checkbox = container.querySelector('input[type="checkbox"]');
            const quantityInput = container.querySelector('.quantity-input');
            const totalPriceInput = container.querySelector('.total-cost');
            const price = parseFloat(container.querySelector('.item-price').dataset.price);

            checkbox.addEventListener('change', function () {
                quantityInput.disabled = !this.checked;
                quantityInput.value = this.checked ? 1 : ''; // Default quantity to 1 if checked
                calculateTotalPrice(); // Initial calculation
            });

            quantityInput.addEventListener('input', function () {
                calculateTotalPrice();
            });

            function calculateTotalPrice() {
                if (checkbox.checked) {
                    const total = (quantityInput.value * price).toFixed(2);
                    totalPriceInput.value = `P${total}`;
                } else {
                    totalPriceInput.value = '';
                }
                calculateGrandTotal();
            }
        });

        function calculateGrandTotal() {
            let grandTotal = 0;
            document.querySelectorAll('.total-cost').forEach(input => {
                const value = parseFloat(input.value.replace('P', '')) || 0;
                grandTotal += value;
            });
            document.getElementById('grand-total').textContent = `P${grandTotal.toFixed(2)}`;
        }
    });
    </script>
    <script>
        // Initialize All Tables
        $(document).ready(function() {
            // Initialize DataTable for #mytable
            $('#PRtable').DataTable({
              "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                order: [[0, 'desc']],
            });

        });
    </script>
