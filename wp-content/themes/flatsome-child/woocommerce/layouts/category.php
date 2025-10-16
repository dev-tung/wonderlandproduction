<?php 
    // Kiểm tra xem có query string hay không
    $callback = !empty($_GET) ? 'buildingsResult' : 'buildingsQuan';
    echo do_shortcode('[buildingRender callback="'.$callback.'"]'); 
?>
