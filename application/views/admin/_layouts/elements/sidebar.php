<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <?php
        if (isset($this->session->userdata['sess_user']['id'])) {
            ?>
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?php echo base_url('assets/dist/img/user-160x160.jpg'); ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo isset($this->session->userdata['sess_user']['id']) ? $this->session->userdata['sess_user']['user_firstname'] . ' ' . $this->session->userdata['sess_user']['user_lastname'] : 'Guest'; ?></p>
                    <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
                    <a href="<?php echo base_url($this->router->directory.'user/logout'); ?>"><i class="fa fa-lock"></i> Logout</a>                    
                </div>
            </div>
            <?php
        }
        ?>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>CMS</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url($this->router->directory.'cms');?>"><i class="fa fa-circle-o"></i> View All /Edit</a></li>
                    <li><a href="<?php echo base_url($this->router->directory.'cms/add');?>"><i class="fa fa-circle-o"></i> Add</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Product Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url($this->router->directory.'category');?>"><i class="fa fa-circle-o"></i> View All /Edit</a></li>
                    <li><a href="<?php echo base_url($this->router->directory.'category/add');?>"><i class="fa fa-circle-o"></i> Add</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url($this->router->directory.'product');?>"><i class="fa fa-circle-o"></i> View All /Edit</a></li>
                    <li><a href="<?php echo base_url($this->router->directory.'product/add');?>"><i class="fa fa-circle-o"></i> Add</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Users Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url($this->router->directory.'user/manage');?>"><i class="fa fa-circle-o"></i> View All/Manage</a></li>                    
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url($this->router->directory.'order');?>"><i class="fa fa-circle-o"></i> View All/Manage</a></li>                    
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>