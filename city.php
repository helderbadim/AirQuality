<?php

require_once __DIR__ . '/inc/functions.php';

$city = null;
if (!empty($_GET['city'])) {
    $city = $_GET['city'];
    //var_dump($city);
}


$filename = null;
$cityInformation = [];
if (!empty($city)) {
    //load
    $data = json_decode(file_get_contents(__DIR__ . '/data/index.json'), true);
    //prepare data
    foreach ($data as $item) {
        if ($item['city'] === $city) {
            $filename = $item['filename'];
            $cityInformation = $item['city'];
            break;
        }
    }
    //var_dump($filename);

}

if (!empty($filename)) {
    $results = json_decode(file_get_contents("compress.bzip2://" . __DIR__ . '/data/' . $filename), true)['results'];

    $units = [
        'pm25' => null,
        'pm10' => null,
    ];

    foreach ($results as $result) {
        if (!empty($units['pm25']) && !empty($units['pm10'])) break;
        if ($result['parameter'] === 'pm25') $units['pm25'] = $result['unit'];
        if ($result['parameter'] === 'pm10') $units['pm10'] = $result['unit'];
    }

    //var_dump($units);

    $stats = [];
    foreach ($results as $result) {
        if ($result['parameter'] !== 'pm25' && $result['parameter'] !== 'pm10') continue;
        if ($result['value'] < 0) continue;
        //var_dump($result);

        $month = substr($result['date']['local'], 0, 7);

        //var_dump($month);

        if (!isset($stats[$month])) {
            $stats[$month] = [
                'pm25' => [],
                'pm10' => [],
            ];
        }

        $stats[$month][$result['parameter']][] = $result['value'];

        //var_dump($stats);
        //break;
    }

    //var_dump($stats);
}

//var_dump($results);

?>


<?php include __DIR__ . '/views/header.inc.php'; ?>

<?php if (empty($city)): ?>
    <p>The city could not be found.</p>
<?php else: ?>
    <h2><?php echo e($cityInformation) ?></h2>
    <?php if (!empty($stats)): ?>
        <?php
        $lables = array_keys($stats);
        sort($lables);


        //var_dump($stats);
        $pm25 = [];
        $pm10 = [];
        foreach ($lables as $lable) {
            $measurements = $stats[$lable];
            if (count($measurements['pm25']) !== 0) {
                $pm25[] = round(array_sum($measurements['pm25']) / count($measurements['pm25']), 3);
            } else {
                $pm25[] = 0;
            }

            if (count($measurements['pm10']) !== 0) {
                $pm10[] = round(array_sum($measurements['pm10']) / count($measurements['pm10']), 3);
            } else {
                $pm10[] = 0;
            }
        }

        $datasets = [];
        if (array_sum($pm25) > 0) {
            $datasets[] = [
                'label' => "AQI, PM2.5 in {$units['pm25']}",
                'data' => $pm25,
                'fill' => false,
                'borderColor' => 'rgb(75, 192, 192)',
                'tension' => 0.2,
                'backgroundColor' => 'rgb(75, 192, 192)',
            ];
        }
        if (array_sum($pm10) > 0) {
            $datasets[] = [
                'label' => "AQI, PM10 in {$units['pm10']}",
                'data' => $pm10,
                'fill' => false,
                'borderColor' => 'rgb(89, 52, 121)',
                'tension' => 0.2,
                'backgroundColor' => 'rgb(89, 52, 121)',
            ];
        }
        //var_dump();

        //var_dump($pm25);
        ?>
        <canvas id="aqi-chart" style="width: 500px; height: 300px"></canvas>
        <script src="scripts/chart.umd.min.js"></script>
        <script>
            const ctx = document.getElementById('aqi-chart');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($lables); ?>,
                    datasets: <?php echo json_encode($datasets); ?>
                },
            });
        </script>
        <table>
            <thead>
            <th>Month</th>
            <th>PM 2.5 Concentration</th>
            <?php if (empty($pm10)): ?>
                <th>PM 10 Concentration</th>
            <?php endif; ?>
            </thead>
            <tbody>
            <?php foreach ($stats as $month => $measurements): ?>
                <tr>
                    <th><strong><?php echo e($month) ?></strong></th>
                    <td><?php echo e(round(array_sum($measurements['pm25']) / count($measurements['pm25']), 2) . ' ' . $units['pm25']); ?></td>
                    <?php if (empty($pm10)): ?>
                        <td><?php echo e(round(array_sum($measurements['pm10']) / count($measurements['pm10']), 2) . ' ' . $units['pm10']); ?></td>
                    <?php endif; ?>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>
<?php endif; ?>


<?php include __DIR__ . '/views/footer.inc.php'; ?>