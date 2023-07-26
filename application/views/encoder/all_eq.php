<?php
    if(($this->session->equipment_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Equipment ajouté avec succès!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->equipment_added = null;
    }
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-4">
                    <h3>Tous les equipements</h3>
                </div>
                <?php
                    if($this->session->type == 'encoder')
                    {
                ?>
                    <div class="col-md-3 offset-md-5" data-toggle="modal" data-target="#newEqForm">
                        <button class="btn btn-success">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp;Nouvel Equipement
                        </button>
                    </div>
                <?php
                    }
                ?>
            </div>
            <br>
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
                                            foreach($eq_capex as $c)
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
                       &nbsp;&nbsp;&nbsp;&nbsp;
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
                                    <th>Categorie</th>
                                    <th>Action</th>
                                    </tr>
                                    <tbody>                 
                                        
                                        <?php
                                            foreach($eq_opex as $c)
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
        </div>
    </section>

    <!-- Modal form for a new equipment-->
    <div class="modal fade" id="newEqForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Ajouter un nouvel equipment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('encoder/new_eq')?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Designation</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fa fa-setting"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Designation" name="designation">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Categorie</label>
                        <select class="form-control selectric" name="category_id">
                            <?php
                                foreach($category as $c)
                                {
                            ?>
                                    <option value=<?=$c->id?>><?=ucfirst($c->category)?></option>
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
                            <input type="number " class="form-control" placeholder="Quantité initiale" name="quantity">
                        </div>
                    </div>                   
                    
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                        <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">Choose File</label>
                            <input type="file" name="image" id="image-upload" />
                        </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="type" value="all_eq">
                    <button type="submit" class="btn btn-success m-t-15 waves-effect">Ajouter</button>
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