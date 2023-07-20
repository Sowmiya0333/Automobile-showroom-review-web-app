<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ca";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $totalRows = $result->num_rows;

    $sumdealership = 0;
    $sumrecommend = 0;
    $sumknowledge = 0;
    $sumrate = 0;
    $sumwarranty = 0;
    $sumability = 0;

    while ($row = $result->fetch_assoc()) {
        $sumdealership += intval($row['dealership']);
        $sumrecommend += intval($row['recommend']);
        $sumknowledge += intval($row['knowledge']);
        $sumrate += intval($row['rate']);
        $sumwarranty += intval($row['warranty']);
        $sumability += intval($row['ability']);
    }

    $avgdealership = $sumdealership/ $totalRows;
    $avgrecommend = $sumrecommend / $totalRows;
    $avgknowledge = $sumknowledge / $totalRows;
    $avgrate = $sumrate / $totalRows;
    $avgwarranty = $sumwarranty / $totalRows;
    $avgability = $sumability / $totalRows;

    $lowestRating = min($avgdealership, $avgrecommend, $avgknowledge, $avgrate, $avgwarranty, $avgability);
    $lowestRatingCategory = "";
    $lowestRatingIndex = 0;

    // Find the index and category of the lowest rating
    $ratings = [$avgdealership, $avgrecommend, $avgknowledge, $avgrate, $avgwarranty, $avgability];
    foreach ($ratings as $index => $rating) {
        if ($rating === $lowestRating) {
            $lowestRatingIndex = $index;
            break;
        }
    }

    switch ($lowestRatingIndex) {
        case 0:
            $lowestRatingCategory = "delearship";
            break;
        case 1:
            $lowestRatingCategory = "recommend";
            break;
        case 2:
            $lowestRatingCategory = "knowledge";
            break;
        case 3:
            $lowestRatingCategory = "rate";
            break;
        case 4:
            $lowestRatingCategory = "warranty";
            break;
        case 5:
            $lowestRatingCategory = "ability";
            break;
        default:
            $lowestRatingCategory = "";
            break;
    }
} else {
    echo "No feedback data found.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Average Feedback Ratings</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="container">
        <h2>Average Feedback Ratings</h2>

        <div class="chart-container">
            <canvas id="chart"></canvas>
        </div>

        <?php if (!empty($lowestRatingCategory)) : ?>
            <div class="suggestion">
                <h3>Suggestion:</h3>
                <p>The lowest rating is in <?php echo $lowestRatingCategory; ?> category.</p>
                <ul>
                    <li>Make your customers comfortable through your maintenance and services, particularly by improving the lowest rating in Service.</li>
                </ul>
            </div>
        <?php endif; ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var chartData = {
                labels: ["delearship", "recommend", "knowledge", "rate", "warranty", "ability"],
                datasets: [{
                    data: [
                        <?php echo round(($avgdealership/ 5) * 100); ?>,
                        <?php echo round(($avgrecommend / 5) * 100); ?>,
                        <?php echo round(($avgknowledge / 5) * 100); ?>,
                        <?php echo round(($avgrate / 5) * 100); ?>,
                        <?php echo round(($avgwarranty / 5) * 100); ?>,
                        <?php echo round(($avgability / 5) * 100); ?>
                    ],
                    backgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56",
                        "#4BC0C0",
                        "#9966FF",
                        "#FF9F40"
                    ]
                }]
            };

            var chartOptions = {
                responsive: true,
                maintainAspectRatio: false
            };

            var chart = new Chart(document.getElementById("chart"), {
                type: 'pie',
                data: chartData,
                options: chartOptions
            });
        });
    </script>
</body>
</html>
