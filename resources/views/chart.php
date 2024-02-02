<?php

// Generate random data for the chart
$data = array(
    'labels' => ['Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5'],
    'data' => array(12, 19, 3, 5, 2),
);

echo json_encode($data);
