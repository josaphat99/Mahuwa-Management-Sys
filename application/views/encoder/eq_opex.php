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
            <!-- opex eqp table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header bg-blue">
                        <h4 class="text-white">Equipements Opex</h4>
                        <!-- <php
                        if($this->session->type == 'encoder')
                        {
                    ?>                    
                        <div class="card-header-action" data-toggle="modal" data-target="#newEqOpexForm">
                            <button class="btn btn-success" style="padding:5px 10px 5px 10px"><i
                            class="fas fa-plus"></i>&nbsp;&nbsp;Nouvel Equipement</button>
                        </div>&nbsp;&nbsp;&nbsp;&nbsp;
                    <php
                        }
                    ?> -->
                        <div class="card-header-action">
                            <a data-collapse="#opex-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="opex-collapse">
                        <div class="card-body">
                        <div class="table-responsive table-bordered">
                            <table class="table table-striped">
                                <tr class="text-center">
                                    <th>Code</th>
                                    <th>Designation</th>
                                    <th>Marque du produit</th>
                                    <th>Type</th>
                                    <th>Unité de mesure</th>
                                    <th>Prix Unitaire</th>
                                    <th>Quantité</th>
                                    <th>Stock Maximum</th> 
                                    <th>Stock Minimum</th> 
                                    <th>Action</th>
                                </tr>
                                <tbody>                 
                                    
                                    <?php
                                        $qte_style = '';
                                        $qte_class = '';
                                        foreach($eq_opex as $c)
                                        {
                                            if($c->quantity < $c->minimum_stock)
                                            {
                                                $qte_class = "bg-danger text-white";
                                                $qte_style = "border:solid 1px red";                                                
                                            }else{
                                                $qte_class = "bg-success text-white";
                                                $qte_style = "border:solid 1px lightgreen";
                                            }
                                    ?>  
                                    <tr class="text-center">
                                        <td><?=$c->code?></td>
                                        <td><?=$c->designation?></td>
                                        <td><?=$c->product_brand?></td>
                                        <td><?=$c->type?></td>
                                        <td><?=$c->unit_of_measure?></td>
                                        <td>$<?=$c->cost_per_unit?></td>
                                        <td style="<?=$qte_style?>" class="<?=$qte_class?>"><?=$c->quantity?></td>
                                        <td><?=$c->maximum_stock?></td>
                                        <td><?=$c->minimum_stock?></td>
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

    <!-- Modal form for a new opex equipment-->
    <div class="modal fade" id="newEqOpexForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
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

                    <input type="hidden" name="category_id" value="<?=$eq_opex[0]->id_category?>" hidden>

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
                    
                    <input type="hidden" name="type" value="eq_opex">
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
                    <button type="button" class="btn btn-primary">Voir mouvements</button>
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