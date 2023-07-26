

 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">
            <!-- insights -->            
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-purple">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-succes"></i> <?=count($all_eq)?>
                            </h3>
                            <span class="text-muted">Tous les equipements</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-green">
                        <i class="fa fa-book-reader"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> <?=count($all_capex_eq)?>
                            </h3>
                            <span class="text-muted">Equipements Capex</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-red">
                        <i class="fas fa-book-open"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> <?=count($all_opex_eq)?>
                            </h3>
                            <span class="text-muted">Equipements Opex</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-red">
                        <i class="fas fa-book-open"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> <?=count($pending_pch_order)?>
                            </h3>
                            <span class="text-muted">Bons des cmd en attente</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- capex eqp table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Equipements Capex</h4>
                        <div class="card-header-action">
                            <a data-collapse="#capex-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="capex-collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                    <th>Code</th>
                                    <th>Designation</th>
                                    <th>Quantité</th>
                                    <th>Categorie</th>
                                    <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($capex_eq as $c)
                                            {
                                        ?>  
                                        <tr>
                                            <td><?=$c->code?></td>
                                            <td><?=$c->designation?></td>
                                            <td><?=$c->quantity?></td>
                                            <td><?=ucfirst($c->category)?></td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-action mr-1 view_btn"  title="View" id=<?="view_btn-".$c->id?> 
                                                data-toggle="modal" data-target="#exampleModalCenter" designation="<?=$c->designation?>">
                                                    <i class="fas fa-eye view_btn" id=<?="view_icon-".$c->id?> designation="<?=$c->designation?>"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            
            <!-- opex eqp table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Equipements Opex</h4>
                        <div class="card-header-action">
                            <a data-collapse="#opex-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="opex-collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                    <th>Code</th>
                                    <th>Designation</th>
                                    <th>Quantité</th>
                                    <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($opex_eq as $o)
                                            {
                                        ?>  
                                        <tr>
                                            <td><?=$o->code?></td>
                                            <td><?=$o->designation?></td>
                                            <td><?=$o->quantity?></td>
                                            <td><?=ucfirst($o->category)?></td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-action mr-1 view_btn"  title="View" id=<?="view_btn-".$o->id?> 
                                                data-toggle="modal" data-target="#exampleModalCenter" designation="<?=$o->designation?>">
                                                    <i class="fas fa-eye view_btn" id=<?="view_icon-".$o->id?> designation="<?=$c->designation?>"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

             <!-- pch order table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Bons des commandes en attente</h4>
                        <div class="card-header-action">
                            <a data-collapse="#pch-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="pch-collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-center">
                                        <th>Date</th>
                                        <th>Departement</th>
                                        <th>Equipement</th>
                                        <th>Quantité</th>
                                        <th>Prix Estimé</th>
                                        <th>Date de requisition</th>
                                        <th>Date de livraison</th>
                                        <th>Etat</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($pending_pch_order as $po)
                                            {
                                        ?>  
                                        <tr class="text-center">
                                            <td><?=$po->date?></td>
                                            <td><?=$po->name?></td>
                                            <td><?=$po->designation?></td>
                                            <td><?=$po->quantity?></td>
                                            <td><?=$po->estimated_price.' '.$po->curency?></td>
                                            <td><?=$po->st_date?></td>
                                            <td><?=$po->delivery_date?></td>
                                            <td><span class="alert alert-light"><?=$po->status == 0?'En attente':'Traité'?></span></td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-action mr-1 view_btn"  title="View" id=<?="view_btn-".$po->id_equipment?> 
                                                data-toggle="modal" data-target="#exampleModalCenter" designation="<?=$po->designation?>" reason="<?=$po->reason?>" status=<?=$po->status?> po_id=<?=$po->id?>>
                                                    <i class="fas fa-eye view_btn" id=<?="view_icon-".$po->id_equipment?> designation="<?=$po->designation?>" reason="<?=$po->reason?>" status=<?=$po->status?> po_id=<?=$po->id?>></i>
                                                </a>
                                            </td>
                                            <td quote1="<?=$po->quote1.' '.$po->curency?>" quote2="<?=$po->quote2.' '.$po->curency?>" quote3="<?=$po->quote3.' '.$po->curency?>" id=<?="detail-".$po->id_equipment?> hidden>details</td>
                                        </tr>
                                        <?php
                                        }
                                        ?>                                                                           
                                    </tbody>                                   
                                </table>
                                <p class="text-center"><a href="<?=site_url('pch_order/index')?>">Voir plus</a></p>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>           
        </div>
    </section>

     <!-- view equipment modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="eq_img_space">               
            </div>
            
            <div class="modal-footer bg-whitesmoke br" id="voir_mv_area">
                <!-- <a type="button" class="btn btn-primary">Voir mouvements</a> -->
            </div>
        </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
    $(function(){
        $('.view_btn').click(function(e){
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];
            var designation = e.target.getAttribute('designation');
            var voir_mv = '<?=site_url("eq_mouvement/view_eq_mouvement")?>';
            voir_mv = voir_mv+'?eq_id='+id;

            $("#exampleModalCenterTitle").html(designation)

            $.post('<?=site_url("ajax/view_eq")?>',{eq_id:id},function(data)
            {
                $("#eq_img_space").html(data);
                $("#voir_mv_area").html('<a href="'+voir_mv+'" type="button" class="btn btn-primary">Voir mouvements</a>');
                console.log(data);
            })
        })
    })
</script>