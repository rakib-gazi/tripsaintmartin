
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script src="../node_modules/preline/dist/preline.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                flatpickr(".custom-date-input", {
                    dateFormat: "d-m-Y",
                    allowInput: true,
                });

                document.getElementById("calendar-icon-check-in").addEventListener("click", function() {
                    document.getElementById("check_in")._flatpickr.open();
                });

                document.getElementById("calendar-icon-check-out").addEventListener("click", function() {
                    document.getElementById("check_out")._flatpickr.open();
                });

                document.getElementById("calendar-icon-booking-date").addEventListener("click", function() {
                    document.getElementById("booking_date")._flatpickr.open();
                });
                document.getElementById("multi_calendar-icon-check-in").addEventListener("click", function() {
                    document.getElementById("multi_check_in")._flatpickr.open();
                });

                document.getElementById("multi_calendar-icon-check-out").addEventListener("click", function() {
                    document.getElementById("multi_check_out")._flatpickr.open();
                });

                document.getElementById("multi_calendar-icon-booking_date").addEventListener("click", function() {
                    document.getElementById("multi_booking")._flatpickr.open();
                });
            });
        </script>
        <script>
            function userPassword(){
                var input = document.getElementById('user_password');
                var type = input.getAttribute('type');
                if (type== 'password'){
                    input.setAttribute('type','text');
                }else{
                    input.setAttribute('type','password');
                }
            }
        </script>
        <script>
            function userConfirmPassword(){
                var input = document.getElementById('user_confirm_password');
                var type = input.getAttribute('type');
                if (type== 'password'){
                    input.setAttribute('type','text');
                }else{
                    input.setAttribute('type','password');
                }
            }
        </script>

    </body>
</html>