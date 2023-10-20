<?php
    if(($this->session->store_req_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Requisition enregistré avec succès!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->store_req_added = null;
    }
?>
 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">
            <!--Department name-->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center"><?=$department_name?></h1>
                </div>                    
            </div>
            <div class="row">
                <div class="col-md-3 offset-md-9">
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#form_newreq">Nouvelle requisition</button>
                </div>
            </div>
            <br><br>
            <!-- insights -->            
            <div class="row">
                <div class="col-lg-4 offset-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-purple">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-succes"></i> <?=count($pending_store_req)?>
                            </h3>
                            <span class="text-muted">Requisitions de stock en attente</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon l-bg-red">
                        <i class="fas fa-book-open"></i>
                        </div>
                        <div class="card-wrap">
                        <div class="padding-20">
                            <div class="text-right">
                            <h3 class="font-light mb-0">
                                <i class="ti-arrow-up text-success"></i> <?=count($store_req)?>
                            </h3>
                            <span class="text-muted">Requisitions de stock soumis</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- pending store requisition table -->
            <div class="row">
              <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Requisitions de stock en attente</h4>
                        <div class="card-header-action">
                            <a data-collapse="#req-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="req-collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-center">
                                        <th>Equipement</th>
                                        <th>Quantité</th>
                                        <th>Date</th>
                                        <th>Image & Motif</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($pending_store_req as $s)
                                            {
                                        ?>  
                                        <tr class="text-center">
                                            <td><?=$s->designation?></td>
                                            <td><?=$s->st_quantity?></td>
                                            <td><?=$s->date?></td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-action mr-1 view_btn"  title="View" id=<?="view_btn-".$s->id_equipment?> 
                                                data-toggle="modal" data-target="#exampleModalCenter" designation="<?=$s->designation?>" reason="<?=$s->reason?>" status=<?=$s->status?> st_id=<?=$s->id?>>
                                                    <i class="fas fa-eye view_btn" id=<?="view_icon-".$s->id_equipment?> designation="<?=$s->designation?>" reason="<?=$s->reason?>" status=<?=$s->status?> st_id=<?=$s->id?>></i>
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

              <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Requisitions de stock soumis</h4>
                        <div class="card-header-action">
                            <a data-collapse="#pst-req-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="pst-req-collapse">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr class="text-center">
                                        <th>Equipement</th>
                                        <th>Quantité</th>
                                        <th>Date</th>
                                        <th>Image & Motif</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($store_req as $s)
                                            {
                                        ?>  
                                        <tr class="text-center">
                                            <td><?=$s->designation?></td>
                                            <td><?=$s->st_quantity?></td>
                                            <td><?=$s->date?></td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-action mr-1 view_btn"  title="View" id=<?="view_btn-".$s->id_equipment?> 
                                                data-toggle="modal" data-target="#exampleModalCenter" designation="<?=$s->designation?>" reason="<?=$s->reason?>" status=<?=$s->status?> st_id=<?=$s->id?>>
                                                    <i class="fas fa-eye view_btn" id=<?="view_icon-".$s->id_equipment?> designation="<?=$s->designation?>" reason="<?=$s->reason?>" status=<?=$s->status?> st_id=<?=$s->id?>></i>
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
        </div>
        </div>
    </div>

    <!-- new requisition form -->
    <div class="modal fade" id="form_newreq" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form_title">Nouvelle requisition</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="">
                    <div id="">                    
                        <form id="" action="<?=site_url('store_req/new_req')?>" method="post">

                            <div class="form-group">
                                <label>Equipement</label>
                                <select  class="form-control selectric" name="equipment_id" required>
                                    <?php
                                        foreach($equipment as $eq)
                                        {
                                    ?>
                                            <option value=<?=$eq->id?>><?=$eq->designation?></option>
                                    <?php
                                        }
                                    ?>                        
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Quantité</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <i class="fas fa-quantity"></i>
                                        </div>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Quantité" name="quantity" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Motif</label>
                                <textarea class="summernote-simple" name="reason"></textarea>
                            </div>

                            <input type="hidden" name="department_id" value=<?=$department_id?>>
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