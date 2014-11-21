<?php 
session_start(); 
include 'func/base.php';
?>
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
                    <li class="">
                        <a href="#postModal" role="button" class="btn" data-toggle="modal">
                            <i class="fa fa-upload"></i> Upload
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
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">Kronocharts Example</a>
                    </div>
                </div>
                <div class="padding">
                    <div class="full col-sm-9">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php 
                                    if(!empty($_SESSION['output-false'])){
                                        echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'.$_SESSION['output-false'].'</div>';
                                        session_unset();
                                    }
                                    if(!empty($_SESSION['output-true'])){
                                        echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'.$_SESSION['output-true'].'</div>';
                                        session_unset();
                                    }
                                ?>
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
                                        <button onclick="submitForm();" value="auswahl" type="submit" name="auswahl" class="btn btn-sub">
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
			Upload
            </div>
            <div class="modal-body">
                <form class="well" action="func/base.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="file">Select a csv file to upload</label>
                    <input type="file" name="file">
                    <p class="help-block">Only csv file.</p>
                  </div>
                    <input type="submit" class="btn btn-lg btn-primary" value="Upload" name="upload">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- script references -->
<script src="static/js/bootstrap.min.js"></script>
<script src="static/js/scripts.js"></script>
</body>
</html>