<?php
include '../Config/Configure.php';

$page = $_POST['page'];
$limit = 5; // Number of records per page

$start = ($page - 1) * $limit;

$query = "SELECT * FROM hmo LIMIT $start, $limit";
$result = mysqli_query($connMysqli, $query);

$output = '';

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $output .= '<div>' . $row['hmo_name'] . '</div>';
    }

    // Pagination links
    $query_total = "SELECT * FROM hmo";
    $result_total = mysqli_query($connMysqli, $query_total);
    $total_records = mysqli_num_rows($result_total);
    $total_pages = ceil($total_records / $limit);

    $output .= '<ul class="pagination">';
    for($i = 1; $i <= $total_pages; $i++){
        $active = ($i == $page) ? 'active' : '';
        $output .= '<li class="page-item '.$active.'"> <a class="page-link" href="#sdf'.$i.'" data-page="'.$i.'"><button>'.$i.'</button></a></li>';
    }
    $output .= '</ul>';
} else {
    $output .= '<p>No data found</p>';
}

echo $output;

?>



<!-- $output .= '<li class="page-item '.$active.'"> <a class="page-link" href="'.$i.'" data-page="'.$i.'"><button>'.$i.'</button></a></li>'; -->