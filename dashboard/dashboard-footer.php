
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
    <script>
    function updateCategoryId(selectElement) {
        const selectedCategory = selectElement.value; // Get the selected category name
        const categoryIdInput = document.getElementById('categoryId');

        // Find the category ID based on the selected category name
        const categoryNames = <?php echo json_encode($category_names); ?>;
        const selectedCategoryId = categoryNames.find(category => category.category === selectedCategory)?.id || '';

        categoryIdInput.value = selectedCategoryId; // Set the value of the hidden input to the selected category ID
    }
</script>

    </body>
</html>