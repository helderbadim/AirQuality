<?php

require_once __DIR__ . '/inc/functions.php';
$data = json_decode(file_get_contents(__DIR__ . '/data/index.json'), true);

include __DIR__ . '/views/header.inc.php';

?>


    <ul>
        <?php foreach ($data as $item): ?>
            <li>
                <a href="city.php?<?php echo http_build_query(['city' => $item['city']]); ?>">
                    <?php echo e($item['city']); ?>,<?php echo ' ' . e($item['country']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>


<?php
include __DIR__ . '/views/footer.inc.php';