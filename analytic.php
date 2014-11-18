<?php 
include 'func/base.php';
include 'class/DataSource.php';


 function getData()
 {
    $files = $_POST["check"];
    foreach ($files as $file) {
        $csv = new File_CSV_DataSource();
 
        // tell the object to parse a specific file
        if ($csv->load($file)) {
             $csv->getHeaders();
            return implode(';', $csv->getColumn('Max '));
        }
    }
 }
$data = getData();

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?=getHeader();?>
        <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'scatter',
            zoomType: 'xy'
        },
        title: {
            text: 'Kronocharts for Fluke Analytics'
        },
        subtitle: {
            text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' :
                    'Pinch the chart to zoom in'
        },
        xAxis: {
                type: "datetime",
                minTickInterval: 3600 * 1000
            },
        yAxis: {
            title: {
                text: 'Min Max Value'
            }
        },
        legend: {
            enabled: true
        },
        tooltip: {
                shared: true,
                crosshairs: true
        },
        plotOptions: {
            area: {
                fillColor: false
                ,
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                }
            }
        },

        series: [{
            type: 'area',
            name: 'U-NETZ',
            data: [<?php echo replace($data) ?>]
        },
            {
            type: 'area',
            name: 'U-MOTOR',
            data: [<?php ?>]
        },
            {
            type: 'area',
            name: 'L1',
            data: [<?php ?>]
        }]
    });
    
});
		</script>
    </head>
<body>
<div class="wrapper">
    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left">
                      
          
            <!-- sidebar -->
            <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li>
                        <a href="#" data-toggle="offcanvas" class="visible-xs text-center">
                            <i class="glyphicon glyphicon-chevron-right"></i>
                        </a>
                    </li>
            	</ul>
                <ul class="nav hidden-xs" id="lg-menu">
                    <li class="active">
                        <a href="/">
                            <i class="fa fa-th-list"></i> Übersicht
                        </a>
                    </li>
                </ul>
                <ul class="nav visible-xs" id="xs-menu">
                    <li>
                        <a href="#featured" class="text-center">
                            <i class="glyphicon glyphicon-list-alt"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#stories" class="text-center">
                            <i class="glyphicon glyphicon-list"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-center">
                            <i class="glyphicon glyphicon-paperclip"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-center">
                            <i class="glyphicon glyphicon-refresh"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /sidebar -->
          
            <!-- main right col -->
            <div class="column col-sm-10 col-xs-11" id="main">
                
                <!-- top nav -->
              	<div class="navbar navbar-blue navbar-static-top">  
                </div>
                <!-- /top nav -->
              
                <div class="padding">
                    <div class="full col-sm-9">
                      
                        <!-- content -->                      
                      	<div class="row">
                          
                         <!-- main col right -->
                          <div class="col-sm-12">
                              

<div id="container" style="min-width: 310px; height: 600px; margin: 0 auto"></div>
                          </div>
                       </div>
                        
                      
                    </div><!-- /col-9 -->
                </div><!-- /padding -->
            </div>
            <!-- /main -->
          
        </div>
    </div>
</div>


<!--post modal-->
<div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			Update Status
      </div>
      <div class="modal-body">
          <form class="form center-block">
            <div class="form-group">
              <textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?"></textarea>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div>
          <button class="btn btn-primary btn-sm" data-dismiss="modal" aria-hidden="true">Post</button>
            <ul class="pull-left list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
		  </div>	
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>