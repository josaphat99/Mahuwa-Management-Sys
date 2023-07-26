<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">             
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg"><i data-feather="bell" class="bell"></i>
            </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">
                                <?php
                                    $notif = '';

                                    if($this->session->type == 'encoder')
                                    {
                                        $notif = $store_req_attente;
                                        $href = 'store_req/index';
                                ?>
                                        Requisitions de stock en attente
                                <?php
                                    }else if($this->session->type == 'dg'){

                                        $notif = $pending_pch_order;
                                        $href = 'pch_order/index';
                                ?>
                                        Bons des commandes
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                            <?php
                                foreach($notif as $n)
                                {
                            ?>                         
                                    <a href="<?=site_url('store_req/index')?>" class="dropdown-item dropdown-item-unread"> 
                                        <span class="dropdown-item-icon bg-primary text-white"> 
                                            <i class="fas fa-bookmark"></i>
                                        </span> 
                                        <span class="dropdown-item-desc"> 
                                            <?=$n->name?>| <?=$n->designation?><span class="time"><?=$n->date?></span>
                                        </span>
                                    </a>                               
                               
                            <?php
                                }
                            ?>
                             </div>
                            <div class="dropdown-footer text-center">
                                <a href="<?=site_url($href)?>">Voir tout<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="<?=base_url('assets/img/user.png')?>" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title"><?=$this->session->fullname?></div>
                            <a href="#" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                            </a>         
                            <a href="<?=site_url('auth/logout')?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>