
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
        <script>
        function updateCategoryImage() {
            var selectElement = document.getElementById("blogCategory");
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var selectedImage = selectedOption.getAttribute("data-image");

            // Set the hidden input value with the selected image URL
            document.getElementById("categoryImage").value = selectedImage;
        }
    </script>

    </body>
</html>