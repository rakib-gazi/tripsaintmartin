<?php 
    include('dashboard-header.php');
    include('../function/dashboard_authentication.php');
    // $lifetime_reservaton_data = lifetime_reservaton();
    // $currentMonth = date('F'); 
    // $reservationmonth = $currentMonth . " Reservations";
?>
    <!-- Sidebar and Content -->
    <div class="flex">
        <?php include('dashboard-sidebar.php');?>

        <!-- Main Content -->
        <div class="w-4/5 p-4">
            <div class="container mx-auto pt-24">
                <h1 class="text-3xl font-bold mb-4 font-serif capitalize">Welcome <?php echo $_SESSION['auth']['name']?></h1>
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white p-6 rounded shadow-md">
                        <h2 class="text-xl font-semibold mb-2">Lifetime Reservations</h2>
                        <p class="text-gray-700">
                            
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded shadow-md">
                        <h2 class="text-xl font-semibold mb-2">></h2>
                        <p class="text-gray-700">567</p>
                    </div>
                    <div class="bg-white p-6 rounded shadow-md">
                        <h2 class="text-xl font-semibold mb-2">Total Products</h2>
                        <p class="text-gray-700">789</p>
                    </div>
                </div>

                <div class="mt-8 bg-white p-6 rounded shadow-md">
                    <h2 class="text-2xl font-semibold mb-4">Recent Activity</h2>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">User</th>
                                <th class="py-2 px-4 border-b">Activity</th>
                                <th class="py-2 px-4 border-b">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b">John Doe</td>
                                <td class="py-2 px-4 border-b">Logged in</td>
                                <td class="py-2 px-4 border-b">2024-05-17</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b">Jane Smith</td>
                                <td class="py-2 px-4 border-b">Created a new order</td>
                                <td class="py-2 px-4 border-b">2024-05-16</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b">Michael Johnson</td>
                                <td class="py-2 px-4 border-b">Updated product details</td>
                                <td class="py-2 px-4 border-b">2024-05-15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>
    
    <script>
        // Initialize flatpickr
        const checkInDatePicker = flatpickr("#check_in", {
            dateFormat: "Y-m-d",
            allowInput: true
        });

        // Add event listener to the calendar icon to open the date picker
        document.getElementById('calendar-icon').addEventListener('click', function() {
            checkInDatePicker.open();
        });
    </script>
</body>

</html>
