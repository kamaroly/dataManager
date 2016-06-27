<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?=base_url()?>assets/bootstrap/js/vendor/jquery.min.js"><\/script>')</script>
<script src="<?= base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?= base_url() ?>assets/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
<script src="<?= base_url() ?>assets/public/js/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
</body>
</html>

<script type="text/javascript">

    <?php if (isset($categories)){ ?>
    $(function () {

        Highcharts.setOptions({
            lang: {
                thousandsSep: ','
            }
        });

        $('#graph-content').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: '<?php echo $series['name']; ?>'
                    },
                    xAxis: {
                        categories: <?php echo $categories; ?>
                    },
                    yAxis: {
                        title: {
                            text: '<?php echo !empty($chart_title) ? $chart_title : "Count"?>'
                        }
                    },
                    series: [{
                        name: '<?php echo $series['name']; ?>',
                        data: <?php echo str_replace('"', "", json_encode($series['data']));?>
                    }],
                    credits: {
                        enabled: false
                    }
                }
        );
    });
    <?php } ?>

    //trend chart
    <?php if(isset($chart_type)){?>
    $(function () {
        $('#trend-chart').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: '<?php echo $series['name']?>'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: <?php echo $categories; ?>
            },
            yAxis: {
                title: {
                    text: '<?php echo $y_axis; ?>'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: '<?php echo $series['name']; ?>',
                data: <?php echo str_replace('"', "", json_encode($series['data']));?>
            }]
        });
    });
    <?php }?>

    $(document).ready(function () {
//working fine
// Ajax calls here.
    });
</script>
