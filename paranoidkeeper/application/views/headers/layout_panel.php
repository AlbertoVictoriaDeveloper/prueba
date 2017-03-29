
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
                 <link rel="icon" type="image/ico" href="<?= base_url() ?>img/iconParanoid.ico">
        <title>ParanoidKeeper</title>

        <!-- Bootstrap -->
        <link href="<?= base_url() ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?= base_url() ?>css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?= base_url() ?>css/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="<?= base_url() ?>css/green.css" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="<?= base_url() ?>css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="<?= base_url() ?>css/jqvmap.min.css" rel="stylesheet"/>
        <!-- Datatables -->
        <link href="<?= base_url() ?>css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>css/scroller.bootstrap.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?= base_url() ?>css/custom.min.css" rel="stylesheet">
        <script src="<?= base_url() ?>js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
        <link href="<?= base_url() ?>css/colorbox.css" rel="stylesheet">
        
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
	
					<a href="<?=base_url()?>insertpass/seepass" class="site_title">	<span > <img SRC="<?= base_url() ?>img/horizontal.png"  ALT="ParanoidKeeper" WIDTH=200 HEIGHT=55></span></a>
                            
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->

                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <?php
                                $this->load->view("headers/menu");
                            ?>


                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->

                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <?php
                                         
                                        echo $mail; 
                                        
                                        ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">

                                        <li><a href="<?=  base_url()?>login/closesession">Log out</a></li>
                                    </ul>
                                </li>


                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

                <!-- page content -->

                
                <?php
                   $this->load->view($template);
                ?>



                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                      <p><p>Copyrigt© <?php echo date('Y'); ?>Oblak Science LLC.</p></p>

                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->

        

        
        <!-- FastClick -->
        <script src="<?= base_url() ?>js/fastclick.js"></script>
        <!-- NProgress -->
        <script src="<?= base_url() ?>js/nprogress.js"></script>
        <!-- Datatables -->
        <script src="<?= base_url() ?>js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>js/dataTables.bootstrap.min.js"></script>
        <script src="<?= base_url() ?>js/dataTables.buttons.min.js"></script>
        <script src="<?= base_url() ?>js/buttons.bootstrap.min.js"></script>
        <script src="<?= base_url() ?>js/buttons.flash.min.js"></script>
        <script src="<?= base_url() ?>js/buttons.html5.min.js"></script>
        <script src="<?= base_url() ?>js/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>js/dataTables.fixedHeader.min.js"></script>
        <script src="<?= base_url() ?>js/dataTables.keyTable.min.js"></script>
        <script src="<?= base_url() ?>js/dataTables.responsive.min.js"></script>
        <script src="<?= base_url() ?>js/responsive.bootstrap.js"></script>
        <script src="<?= base_url() ?>js/datatables.scroller.min.js"></script>
        <script src="<?= base_url() ?>js/jszip.min.js"></script>
        <script src="<?= base_url() ?>js/pdfmake.min.js"></script>
        <script src="<?= base_url() ?>js/vfs_fonts.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="<?= base_url() ?>js/custom.min.js"></script>
        <script src="<?= base_url() ?>js/jquery.colorbox.js"></script>
        <!-- Datatables -->

        <script>
            $(document).ready(function () {
                var handleDataTableButtons = function () {
                    if ($("#datatable-buttons").length) {
                        $("#datatable-buttons").DataTable({
                            dom: "Bfrtip",
                            buttons: [
                                {
                                    extend: "copy",
                                    className: "btn-sm"
                                },
                                {
                                    extend: "csv",
                                    className: "btn-sm"
                                },
                                {
                                    extend: "excel",
                                    className: "btn-sm"
                                },
                                {
                                    extend: "pdfHtml5",
                                    className: "btn-sm"
                                },
                                {
                                    extend: "print",
                                    className: "btn-sm"
                                },
                            ],
                            responsive: true
                        });
                    }
                };

                TableManageButtons = function () {
                    "use strict";
                    return {
                        init: function () {
                            handleDataTableButtons();
                        }
                    };
                }();

                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({
                    keys: true
                });

                $('#datatable-responsive').DataTable();

                $('#datatable-scroller').DataTable({
                    ajax: "js/datatables/json/scroller-demo.json",
                    deferRender: true,
                    scrollY: 380,
                    scrollCollapse: true,
                    scroller: true
                });

                var table = $('#datatable-fixed-header').DataTable({
                    fixedHeader: true
                });

                TableManageButtons.init();
                $(".inline").colorbox({inline:true, width:"50%"});
                $("#cboxClose").attr("style","display:none;");
            });
        </script>
        <?php
        if(isset($js)){
            ?>
                <script src="<?= base_url() ?>js/jsintern/<?=$js?>"></script>
            <?php
        }
        ?>
        <!-- /Datatables -->
    </body>
</html>
