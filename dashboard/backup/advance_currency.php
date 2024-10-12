<?php 
include ('dashboard-header.php');
 include ('../function/settings_authentication.php');

if (isset($_POST['advance_currency_submit'])) {
    $old = $_POST;
    $result = advance_currency();
    if ($result['status'] == 'error') {
        $error = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=advance_currency.php');
    }
}

if (isset($_POST['advance_currency_delete'])) {
    $result = advance_currency_delete();
    if ($result['status'] == 'error') {
        $errors = $result['message'];
    } else {
        $success = $result['message'];
        header('Refresh: 1; URL=advance_currency.php');
    }
}

// Pagination logic
$results_per_page = 10; // Number of entries per page
$total_results_query = mysqli_query(db_connect(), "SELECT COUNT(*) as total FROM advance_currency");
$total_results_row = mysqli_fetch_assoc($total_results_query);
$total_results = $total_results_row['total'];
$total_pages = ceil($total_results / $results_per_page); // Calculate total pages

// Determine which page number visitor is currently on
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;

// Determine the starting limit number
$starting_limit = ($page - 1) * $results_per_page;

// Fetch data for the current page
$advance_currency_view = advance_currency_view($starting_limit, $results_per_page);
?>
<div class="flex">  
    <?php include('dashboard-sidebar.php'); ?>
    <!-- Main Content -->
    <div class="w-4/5 overflow-auto p-4">
        <div class="container mx-auto pt-24">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-3xl font-bold font-serif capitalize ps-12 ">Advance Currecny</h1>
                <a href="settings.php" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">
                    <i class="fa-solid fa-long-arrow-alt-left me-4"></i>Go Back
                </a>
            </div>
            <hr class="border border-black">    
            <form method="post" class="ps-12 w-full" enctype="multipart/form-data">
                <h5 class="text-xl font-semibold font-mono text-black py-2">
                    <?php echo $success ?? ''; ?>
                </h5>
                <div class="mt-6 gap-x-4 flex justify-start items-center">
                        <div class="flex justify-start items-center outline outline-1 outline-black rounded w-full">
                            <label for="advance_currency" class="text-black text-xl w-80 ps-4 font-serif"> Advance Currency: </label>
                            <input type="text" name="advance_currency" value="<?php echo $old['advance_currency'] ?? ''; ?>" placeholder="Enter Advance Currency" 
                            class="py-2 bg-transparent w-full px-4 focus:outline-none">
                        </div>
                    <button type="submit" name="advance_currency_submit" class="bg-cyan-950 hover:bg-slate-800 text-white transition duration-700 ease-in-out font-serif text-lg font-semibold px-8 py-1.5 rounded outline outline-1 outline-black">Submit</button>
                </div>
                <h5 class="text-black font-mono font-xl my-2 text-center"><?php echo $error['advance_currency'] ?? ''; ?></h5>
            </form>
            <div class="overflow-x-auto ps-12">
                <table class="table-fixed w-full mt-8 rounded-lg border-collapse overflow-hidden ">
                    <thead class="bg-cyan-950 text-white">
                        <tr class="text-center">
                            <th class="py-2 px-4 w-32 border border-black">SL No</th>
                            <th class="py-2 px-4 w-full border border-black">Advance Currecny</th>
                            <th class="py-2 px-4 w-60 border border-black">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($advance_currency_view) > 0) {
                            $i = $starting_limit + 1;
                            while ($row = mysqli_fetch_assoc($advance_currency_view)) {
                                echo '<tr class="text-center bg-white rounded">';
                                    echo '<td class="py-2 px-4 w-32 font-serif font-semibold text-gray-800 border border-black rounded">' . $i++ . '</td>';
                                    echo '<td class="py-2 px-4 w-full font-serif font-semibold text-gray-800 border border-black rounded">' . $row["advance_currency"] . '</td>';
                                    echo '<td class="py-2 px-4 w-60 font-serif font-semibold text-gray-800 border border-black rounded">';
                                        echo '<div class="flex justify-center items-center">';
                                            echo '<form method="post" onsubmit="return confirm(\'Do you want to delete?\')">
                                                    <input type="hidden" name="delete_id" value="'.$row['id'].'">
                                                    <button class="fs-4 mx-4 bg-red-700 py-1 px-2 rounded" name="advance_currency_delete" type="submit">
                                                        <i class="fa-solid fa-trash text-white"></i>
                                                    </button>
                                                  </form>';
                                        echo '</div>';
                                    echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr>';
                            echo '<td colspan="5" class="text-center py-4"><h5 class="font-serif text-black">No Data Available</h5></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination Controls -->
            <div class="mt-8 flex justify-center">
                <?php if ($page > 1): ?>
                    <a href="advance_currency.php?page=<?php echo $page - 1; ?>" class="px-8  py-2 mx-1 text-white rounded bg-cyan-950 transition duration-700 ease-in-out  hover:bg-transparent hover:outline-1 hover:outline hover:outline-black hover:text-black">Previous</a>
                <?php endif; ?>

                <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                    <a href="advance_currency.php?page=<?php echo $p; ?>" class="px-8  py-2 mx-1 border border-<?php if ($p == $page){echo 'white';}else{echo 'black';}  ?> rounded <?php if ($p == $page) echo 'bg-cyan-950  text-white'; ?>">
                        <?php echo $p; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="advance_currency.php?page=<?php echo $page + 1; ?>" class="px-8  py-2 mx-1 text-white rounded bg-cyan-950 transition duration-700 ease-in-out  hover:bg-transparent hover:outline-1 hover:outline hover:outline-black hover:text-black">Next</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
