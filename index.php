<?php include 'func/base.php';?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <?=getHeader();?>
    </head>
<body>
<div class="wrapper">
    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left">
            <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li>
                        <a href="#" data-toggle="offcanvas" class="visible-xs text-center">
                            <i class="fa fa-bars"></i>
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
                        <a href="/">
                            <i class="fa fa-th-list"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="column col-sm-10 col-xs-11" id="main">
                <div class="navbar navbar-blue navbar-static-top">  
                </div>
                <div class="padding">
                    <div class="full col-sm-9">
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="post" name="myform" action="analytic.php" >
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px;"></th>
                                                <th style="width: 100%">Datei</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $files = scan();
                                                foreach ($files as $file) {
                                                    echo '<tr><td><input name="check[]" type="checkbox" value="'.$file.'"/></td>
                                                        <td>'.str_replace('csv/', '', $file).'</td></tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="content_savebox">
                                        <button onclick="submitForm();" value="auswahl" type="submit" name="auswahl" class="btn">
                                            Auswählen
                                        </button>
                                    </div>
                                </form>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
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
                    <ul class="pull-left list-inline">
                        <li>
                            <a href="">
                                <i class="glyphicon glyphicon-upload"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="glyphicon glyphicon-camera"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="glyphicon glyphicon-map-marker"></i>
                            </a>
                        </li>
                    </ul>
                </div>	
            </div>
        </div>
    </div>
</div>
<!-- script references -->
<script src="static/js/bootstrap.min.js"></script>
<script src="static/js/scripts.js"></script>
</body>
</html>