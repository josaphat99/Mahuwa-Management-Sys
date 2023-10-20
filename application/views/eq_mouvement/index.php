<?php
    if(($this->session->mouvement_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Mouvement enregistré avec succès!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->mouvement_added = null;
    }
    if(($this->session->insuffisant_stock))
    {
?>
        <script>
            Swal.fire({            
            icon: 'warning',
            title: 'Stock insuffisant!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->insuffisant_stock= null;
    }

    if(($this->session->beyond_max))
    {
?>
        <script>
            Swal.fire({            
            icon: 'warning',
            title: 'Vous ne pouvez pas depasser la quantité max predefinie!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->beyond_max= null;
    }
?>

<link rel="stylesheet" href=<?=base_url("assets/bundles/bootstrap-daterangepicker/daterangepicker.css")?>>
<link rel="stylesheet" href=<?=base_url("assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css")?>>
<link rel="stylesheet" href=<?=base_url("assets/bundles/select2/dist/css/select2.min.css")?>>
<link rel="stylesheet" href=<?=base_url("assets/bundles/jquery-selectric/selectric.css")?>>
<link rel="stylesheet" href=<?=base_url("assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css")?>>
<link rel="stylesheet" href=<?=base_url("assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css")?>>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <h3>Mouvements de stock des equipements</h3>
                </div>
                <?php
                    if($this->session->type == 'encoder')
                    {
                ?>
                        <div class="col-md-3 offset-md-5" data-toggle="modal" data-target="#newEqForm">
                            <button class="btn btn-success">
                                <i class="fas fa-plus"></i>&nbsp;&nbsp;Nouveau mouvement
                            </button>
                        </div>
                <?php
                    }
                ?>
                
            </div>
            <br>
            <!-- approvisionnement table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Approvisionnements</h4>
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
                                    <th>Date</th>
                                    <th>Designation</th>
                                    <th>Quantité</th>
                                    <!-- <th>Categorie</th> -->
                                    <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($mouvement_entre as $me)
                                            {
                                        ?>  
                                        <tr>
                                            <td><?=$me->date?></td>
                                            <td><?=$me->designation?></td>
                                            <td><?=$me->quantity?></td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-action mr-1 view_btn"  title="View" id=<?="view_btn-".$me->id_equipment?> 
                                                data-toggle="modal" data-target="#exampleModalCenter" designation="<?=$me->designation?>">
                                                    <i class="fas fa-eye view_btn" id=<?="view_icon-".$me->id_equipment?> designation="<?=$me->designation?>"></i>
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

             <!-- sortie table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Sorties</h4>
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
                                    <th>Date</th>
                                    <th>Designation</th>
                                    <th>Quantité</th>
                                    <!-- <th>Categorie</th> -->
                                    <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($mouvement_sortie as $ms)
                                            {
                                        ?>  
                                        <tr>
                                            <td><?=$ms->date?></td>
                                            <td><?=$ms->designation?></td>
                                            <td><?=$ms->quantity?></td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-action mr-1 view_btn"  title="View" id=<?="view_btn-".$ms->id_equipment?> 
                                                data-toggle="modal" data-target="#exampleModalCenter" designation="<?=$ms->designation?>">
                                                    <i class="fas fa-eye view_btn" id=<?="view_icon-".$ms->id_equipment?> designation="<?=$ms->designation?>"></i>
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

    <!-- Modal form for a new mouvement-->
    <div class="modal fade" id="newEqForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Enregistrer un nouveau mouvement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('eq_mouvement/new_eq_mouvement')?>" method="post">
                    
                    
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
                        <label class="col-form-label">Type d'operation</label>
                        <select class="form-control selectric" name="type" required>
                            <option value="entre">Approvisionnement</option>    
                            <option value="sortie">Sortie</option>                
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Quantité</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Quantité" name="quantity" required>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label>Date</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="date" required>
                        </div>
                    </div> -->
                    
                    <!-- <input type="hidden" name="type" value="all_eq"> -->
                    <button type="submit" class="btn btn-success m-t-15 waves-effect">Enregistrer</button>
                </form>
            </div>
            </div>
        </div>
    </div>

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
                add content here..
            </div>
            <div class="modal-footer bg-whitesmoke br" id="voir_mv_area">
                <!-- <a type="button" class="btn btn-primary">Voir mouvements</a> -->
            </div>
        </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script src=<?=base_url("assets/bundles/cleave-js/dist/cleave.min.js")?>></script>
<script src=<?=base_url("assets/bundles/cleave-js/dist/addons/cleave-phone.us.js")?>></script>
<script src=<?=base_url("assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js")?>></script>
<script src=<?=base_url("assets/bundles/bootstrap-daterangepicker/daterangepicker.js")?>></script>
<script src=<?=base_url("assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js")?>></script>
<script src=<?=base_url("assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js")?>></script>

<script src=<?=base_url("assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js")?>></script>
<script src=<?=base_url("assets/bundles/select2/dist/js/select2.full.min.js")?>></script>
<script src=<?=base_url("assets/bundles/jquery-selectric/jquery.selectric.min.js")?>></script>
<script src=<?=base_url("assets/js/page/forms-advanced-forms.js")?>></script>

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