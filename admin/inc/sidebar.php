            <!-- Left Sidebar Start -->
            <div class="vertical-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.php" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-dark.png" alt="" height="20">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <div data-simplebar class="sidebar-menu-scroll">
                    <!--- Sidemenu Start -->
                    <div id="sidebar-menu">

                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="index.php" class="disable">
                                    <i class="fa-solid fa-house" style="margin-left: 16px;"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li class="menu-title">Apps</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fa-solid fa-folder" style="margin-left: 16px;"></i>
                                    <span>Category</span>
                                </a>

                                <ul class="sub-menu" aria-expanded="false" style="margin-left: 5px;">
                                    <li>
                                        <a href="categoryList.php">All Category</a>
                                    </li>
                                    <li>
                                        <a href="addCategory.php">Add Category</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fa-solid fa-folder" style="margin-left: 16px;"></i>
                                    <span>Post</span>
                                </a>

                                <ul class="sub-menu" aria-expanded="false" style="margin-left: 5px;">
                                    <li>
                                        <a href="postList.php">All Post</a>
                                    </li>
                                    <li>
                                        <a href="postCreate.php">Add Post</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="fa-solid fa-folder" style="margin-left: 16px;"></i>
                                    <span>Comment</span>
                                </a>

                                <ul class="sub-menu" aria-expanded="false" style="margin-left: 5px;">
                                    <li>
                                        <a href="commentList.php">All Comment</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                    <!--- Sidemenu End -->
                </div>

                <?php
                include_once '../lib/Session.php';
                $massage = new Session();
                var_dump(Session::get('user'))
                ?>
            </div>
            <!-- Left Sidebar End -->