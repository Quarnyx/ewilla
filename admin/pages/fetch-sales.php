<?php
require_once ('../config.php');
$year = date('Y');
// $year = '2023';
$start_date = "$year-01-01";
$end_date = "$year-12-31";
$sql_sales_data = "
SELECT 
    DATE_FORMAT(it.created_at, '%M %Y') AS sale_month,
    SUM(it.quantity) AS total_sold
FROM lp_inventory_transaction it
WHERE it.transaction_type = 'Out' AND it.created_at BETWEEN '$start_date' AND '$end_date'
GROUP BY sale_month
ORDER BY it.created_at;
";

$result_sales_data = $conn->query($sql_sales_data);

// Initialize an array with all months
$months = [
    'January ' . $year,
    'February ' . $year,
    'March ' . $year,
    'April ' . $year,
    'May ' . $year,
    'June ' . $year,
    'July ' . $year,
    'August ' . $year,
    'September ' . $year,
    'October ' . $year,
    'November ' . $year,
    'December ' . $year
];

// Initialize sales data with zero values for each month
$sales_data = array_fill(0, 12, 0);

// Populate sales data with actual values from the database
while ($row = $result_sales_data->fetch_assoc()) {
    $sale_month = $row['sale_month'];
    $total_sold = $row['total_sold'];

    $index = array_search($sale_month, $months);
    if ($index !== false) {
        $sales_data[$index] = $total_sold;
    }
}

$conn->close();
?>
<script>
    $(document).ready(function () {
        new ApexCharts(document.querySelector("#sales-chart"),
            {
                chart: {
                    height: 380,
                    width: "100%",
                    stacked: !1,
                    toolbar: { show: !1 }
                },
                stroke: {
                    width: [1, 2, 3],
                    curve: "smooth",
                    lineCap: "round"
                },
                plotOptions:
                {
                    bar:
                    {
                        endingShape: "rounded",
                        columnWidth: "20%"
                    }
                },
                colors: ["#3454d1", "#a2acc7", "#E1E3EA"],
                series: [{
                    name: "Terjual",
                    type: "bar",
                    data: <?php echo json_encode($sales_data); ?>
                }],
                fill: {
                    opacity: [.85, .25, 1, 1],
                    gradient: {
                        inverseColors: !1,
                        shade: "light",
                        type: "vertical",
                        opacityFrom: .5,
                        opacityTo: .1,
                        stops: [0, 100, 100, 100]
                    }
                },
                markers: {
                    size: 0
                },
                xaxis: {
                    categories: <?php echo json_encode($months); ?>, 
                    axisBorder: {
                        show: !1
                    },
                    axisTicks: {
                        show: !1
                    },
                    labels: {
                        style: {
                            fontSize: "10px",
                            colors: "#A0ACBB"
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function (e) { return +e + "PCS" },
                        offsetX: 0,
                        offsetY: 0,
                        style: {
                            color: "#A0ACBB"
                        }
                    }
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: !1
                        }
                    },
                    yaxis: {
                        lines: {
                            show: !1
                        }
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                tooltip: {
                    y: {
                        formatter: function (e) { return +e + " PCS" }
                    },
                    style: {
                        fontSize: "12px",
                        fontFamily: "Inter"
                    }
                },
                legend: {
                    show: !1,
                    labels: {
                        fontSize: "12px",
                        colors: "#A0ACBB"
                    },
                    fontSize: "12px",
                    fontFamily: "Inter"
                }
            }).render()
    })
</script>