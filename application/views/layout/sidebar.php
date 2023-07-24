<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="" src=<?=base_url("assets/img/logo/logo.jpeg")?> class="header-logo" /> <span class="logo-name">Mahuwa</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header"><b><?=$this->session->type?></b></li>
            <?php

                if($this->session->type == 'admin')
                {
            ?>
                    <li class="dropdown active">
                        <a href="<?=site_url('admin/index')?>" class="nav-link">
                        &nbsp;&nbsp;<i data-feather="monitor"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="<?=site_url('admin/view_grade')?>" class="nav-link">
                            <i class="fas fa-graduation-cap"></i><span>Grades</span>
                        </a>
                    </li>
            <?php
                }else if($this->session->type == 'encoder'){
            ?>
                    <li class="dropdown active">
                        <a href="<?=site_url('encoder/index')?>" class="nav-link">
                        &nbsp;&nbsp;<i data-feather="monitor"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Equipements</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="<?=site_url('encoder/all_eq')?>">Tous les equipements</a></li>
                            <li><a class="nav-link" href="<?=site_url('encoder/eq_capex')?>">Equipements Capex</a></li>
                            <li><a class="nav-link" href="<?=site_url('encoder/eq_opex')?>">Equipements Opex</a></li>
                            <li><a class="nav-link" href="<?=site_url('eq_mouvement/index')?>">Mouvements de stock</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="<?=site_url('store_req/index')?>" class="nav-link">
                            <i data-feather="command"></i><span>Requisition de stock</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="<?=site_url('pch_order/index')?>" class="nav-link">
                        <i data-feather="command"></i><span>Bons de commandes</span>
                        </a>
                    </li>
            <?php
                }elseif($this->session->type == 'dg')
                {
            ?>
                    <li class="dropdown">
                        <a href="#" class="nav-link">
                        &nbsp;&nbsp;<i data-feather="monitor"></i><span>Dashboard</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Equipements</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="<?=site_url('encoder/all_eq')?>">Tous les equipements</a></li>
                            <li><a class="nav-link" href="<?=site_url('encoder/eq_capex')?>">Equipements Capex</a></li>
                            <li><a class="nav-link" href="<?=site_url('encoder/eq_opex')?>">Equipements Opex</a></li>
                            <li><a class="nav-link" href="<?=site_url('eq_mouvement/index')?>">Mouvements de stock</a></li>
                        </ul>
                    </li>

                    <li class="dropdown active">
                        <a href="<?=site_url('pch_order/index')?>" class="nav-link">
                        <i data-feather="command"></i><span>Bons de commandes</span>
                        </a>
                    </li>
            <?php
                }
            ?>  
            <!-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Apps</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="chat.html">Chat</a></li>
                    <li><a class="nav-link" href="portfolio.html">Portfolio</a></li>
                    <li><a class="nav-link" href="blog.html">Blog</a></li>
                    <li><a class="nav-link" href="calendar.html">Calendar</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="mail"></i><span>Email</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="email-inbox.html">Inbox</a></li>
                    <li><a class="nav-link" href="email-compose.html">Compose</a></li>
                    <li><a class="nav-link" href="email-read.html">read</a></li>
                </ul>
            </li>                         -->
        </ul>
    </aside>
</div>