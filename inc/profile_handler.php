<?php
    //Statistics
    $fetch_amount_active = "SELECT COUNT(active) FROM users";
    $amount_active = $conn->query($fetch_amount_active)
?>
