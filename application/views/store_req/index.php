<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <h3>Requisitions de stock</h3>
                </div>
            </div>
            <br>
            <!-- st requisition pending table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Requisitions en attente</h4>
                        <div class="card-header-action">
                            <a data-collapse="#req-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="req-collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Date</th>
                                        <th>Departement</th>
                                        <th>Equipement</th>
                                        <th>Quantité</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($store_req_attente as $st)
                                            {
                                        ?>  
                                        <tr>
                                            <td><?=$st->date?></td>
                                            <td><?=$st->name?></td>
                                            <td><?=$st->designation?></td>
                                            <td><?=$st->st_quantity?></td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-action mr-1 view_btn"  title="View" id=<?="view_btn-".$st->id_equipment?> 
                                                data-toggle="modal" data-target="#exampleModalCenter" designation="<?=$st->designation?>" reason="<?=$st->reason?>" status=<?=$st->status?> st_id=<?=$st->id?>>
                                                    <i class="fas fa-eye view_btn" id=<?="view_icon-".$st->id_equipment?> designation="<?=$st->designation?>" reason="<?=$st->reason?>" status=<?=$st->status?> st_id=<?=$st->id?>></i>
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

            <!-- st requisition satisfied table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Requisitions Satisfaites</h4>
                        <div class="card-header-action">
                            <a data-collapse="#req-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="req-collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Date</th>
                                        <th>Departement</th>
                                        <th>Equipement</th>
                                        <th>Quantité</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($st_req_satisfied as $st)
                                            {
                                        ?>  
                                        <tr>
                                            <td><?=$st->date?></td>
                                            <td><?=$st->name?></td>
                                            <td><?=$st->designation?></td>
                                            <td><?=$st->st_quantity?></td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-action mr-1 view_btn"  title="View" id=<?="view_btn-".$st->id_equipment?> 
                                                data-toggle="modal" data-target="#exampleModalCenter" designation="<?=$st->designation?>" reason="<?=$st->reason?>" status=<?=$st->status?>>
                                                    <i class="fas fa-eye view_btn" id=<?="view_icon-".$st->id_equipment?> designation="<?=$st->designation?>" reason="<?=$st->reason?>" status=<?=$st->status?>></i>
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
        </div>
    </section>

    <!-- view equipment modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
          aria-labelledby="store_req_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="store_req_modal">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" id="st_modal_close">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="eq_img_space">
            </div>

            <div class="modal-footer bg-whitesmoke br">
                <a href="#" type="button" class="btn btn-success" id="modal_action_btn" data-toggle="modal" data-target="#form_pch">Etablir bon de commande</a>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="form_pch" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="form_title">Bon de commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" id="">
                <div id="">                    
                    <form id="" action="<?=site_url('pch_order/new_order')?>" method="post">
                        <div class="form-group">
                            <label>Prix Estimé</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fa fa-setting"></i>
                                    </div>
                                </div>
                                <input type="number" class="form-control" placeholder="Prix Estimé" name="estimated_price" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Quote 1</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fa fa-setting"></i>
                                    </div>
                                </div>
                                <input type="number" class="form-control" placeholder="Quote 1" name="quote1" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Quote 2</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fa fa-setting"></i>
                                    </div>
                                </div>
                                <input type="number" class="form-control" placeholder="Quote 2" name="quote2" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Quote 3</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fa fa-setting"></i>
                                    </div>
                                </div>
                                <input type="number" class="form-control" placeholder="Quote 3" name="quote3" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Devise</label>
                            <select class="form-control selectric" name="curency_id">
                                <?php
                                    foreach($curency as $c)
                                    {
                                ?>
                                        <option value=<?=$c->id?>><?=ucfirst($c->curency)?></option>
                                <?php
                                    }
                                ?>                        
                            </select>
                        </div>

                        <!-- <div class="form-group">
                            <label>Quantité</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fas fa-quantity"></i>
                                    </div>
                                </div>
                                <input type="number" class="form-control" placeholder="Quantité" name="quantity" required>
                            </div>
                        </div> -->

                        <div class="form-group" id="pch_date_input">
                            <label>Date de livraison</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fas fa-quantity"></i>
                                    </div>
                                </div>
                                <input class="form-control" type="date" placeholder="Delivery date" name="delivery_date" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-lg">Valider</button>
                    </form>
                </div>
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
            var reason = e.target.getAttribute('reason');
            var status = e.target.getAttribute('status');
            var st_id = e.target.getAttribute('st_id');

            console.log(st_id);

            var pch_date_input = $("#pch_date_input").html();
            $("#pch_date_input").html(pch_date_input+'<input type="hidden" name="st_id" value="'+st_id+'"/>');

            var pch_order = $("#pch_order").html();
            var pch_order_form = $("#pch_order_form");
            

            if(status == 1)
            {
                $("#modal_action_btn").html("Voir Bon de commande");
                $("#modal_action_btn").attr('href','<?=site_url('pch_order/view_order')?>');
                $("#modal_action_btn").attr('class','btn btn-primary');
            }else{
                $("#modal_action_btn").attr('href','<?=site_url('pch_order/new_order')?>');
                $("#modal_action_btn").attr('class','btn btn-success');
            }

            $("#store_req_modal").html(designation);

            $.post('<?=site_url("ajax/view_eq")?>',{eq_id:id},function(data)
            { 
                $("#eq_img_space").html(data+'<br/><hr><h3>Motif</h3><p>'+reason+'</p>');                 
            })
        })

        // $("#modal_action_btn").click(function(e){
        //    ("#st_modal_close").click();
        // })
    })
</script>