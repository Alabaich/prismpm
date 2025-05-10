<?php
/* Template Name: Single Property */




get_header();

// Get the current URL
$current_url = home_url(add_query_arg([]));

// Parse the URL
$parsed_url = wp_parse_url($current_url);

// Parse query string
parse_str($parsed_url['query'] ?? '', $query_params);

// Get 'arg'
$arg = $query_params['arg'] ?? null;


if ($arg) {
    $conn = new mysqli("5.161.90.110", "root", "exampleqi", "prismpm");
    // Sanitize and use arg in WHERE clause
    $stmt = $conn->prepare("SELECT * FROM units JOIN building ON building.id = units.building_id WHERE units.id = ?");
    $stmt->bind_param("i", $arg);

    $stmt->execute();
    $res = $stmt->get_result();
    $data = [];

    while ($row = $res->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();
    $conn->close();
}

?>


<?php foreach ($data as $item): ?>
    <h1><?= $item['unit'] ?></h1>
    <h2><?= $item['address'] ?></h2>
<?php endforeach ?>



<?php 

get_footer();