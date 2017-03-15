<body class="no-trans">
<?php if ($isLog) : ?>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/admin/home">SpaceGoofs! Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">


                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?= $_SESSION['Auth']['pseudo']; ?></strong>
                                        </h5>

                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>

                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong><?= $_SESSION['Auth']['pseudo']; ?></strong>
                                        </h5>

                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>

                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $_SESSION['Auth']['pseudo']; ?><b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/admin/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="<?php if($view == 'home') echo 'active';?>">
                        <a href="/admin/home"><i class="fa fa-fw fa-thumb-tack"></i> Phrase d'accroche</a>
                    </li>

                    <li class="<?php if($view == 'ajout-match') echo 'active';?>">
                        <a href="/admin/ajout-match"><i class="fa fa-fw fa-legal"></i> Matchs</a>
                    </li>


                    <!--
                   <li>
                       <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
                   </li>
                   <li>
                       <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
                   </li>
                   <li>
                       <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                   </li>
                   <li>
                       <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                   </li>
                   <li>
                       <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i
                               class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                       <ul id="demo" class="collapse">
                           <li>
                               <a href="#">Dropdown Item</a>
                           </li>
                           <li>
                               <a href="#">Dropdown Item</a>
                           </li>
                       </ul>
                   </li>
                   <li>
                       <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                   </li>
                   <li>
                       <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                   </li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </div>
<?php elseif($view != 'admin' && $action !='admin') : ?>
    <script>window.location.href = '/home';</script>
<?php endif; ?>