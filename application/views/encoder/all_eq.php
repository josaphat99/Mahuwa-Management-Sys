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

<!--css-->
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
                    <h3>Tous les equipements</h3>
                </div>
                <?php
                    if($this->session->type == 'encoder' || $this->session->type == 'admin')
                    {
                ?>
                    
                    <div class="col-md-2">
                        <button class="btn btn-warning">
                            <i class="fas fa-download"></i>&nbsp;&nbsp;Format PDF
                        </button>
                    </div>

                    <div class="col-md-2"">
                        <button class="btn btn-info">
                            <i class="fas fa-download"></i>&nbsp;&nbsp;Format Excel
                        </button>
                    </div>

                    

                    <div class="col-md-3 offset-md-1" data-toggle="modal" data-target="#newEqForm">
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
                    <div class="card-heade bg-blue">
                        <div class="row mt-2 mb-2">
                            <div class="col-md-3">
                                <h4 class="text-white">Equipements Capex</h4>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control selectric" id="filter_capex">
                                    <option id="filter_by_capex">Filtrer par</option>
                                    <option>Code</option>
                                    <option>Designation</option>
                                    <option>Marque du produit</option>
                                    <option>Type</option>
                                    <option>Unité de mesure</option>
                                    <option>Prix Unitaire</option>
                                    <option>Quantité</option>                                        
                                    <option>Stock Maximum</option>                                
                                    <option>Stock Minimum</option> 
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" style="display:inline-block" class="form form-control" id="search_capex" placeholder="Search for a capex" name="search_capex">
                            </div>
                            <div class="col-md-1">
                                <a data-collapse="#capex-collapse" class="btn btn-icon btn-info" href="#">
                                    <i class="fas fa-minus"></i>
                                </a>                    
                            </div >
                        </div>
                    </div>
                    <div class="collapse show" id="capex-collapse">
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
                                            foreach($eq_capex as $c)
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

            <!-- opex eqp table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-head bg-blue">
                    <div class="row mt-2 mb-2">
                            <div class="col-md-3">
                                <h4 class="text-white">Equipements Opex</h4>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control selectric" id="filter_capex">
                                    <option id="filter_by_capex">Filtrer par</option>
                                    <option>Code</option>
                                    <option>Designation</option>
                                    <option>Marque du produit</option>
                                    <option>Type</option>
                                    <option>Unité de mesure</option>
                                    <option>Prix Unitaire</option>
                                    <option>Quantité</option>                                        
                                    <option>Stock Maximum</option>                                
                                    <option>Stock Minimum</option> 
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" style="display:inline-block" class="form form-control" id="search_capex" placeholder="Search for a opex" name="search_capex">
                            </div>
                            <div class="col-md-1">
                                <a data-collapse="#opex-collapse" class="btn btn-icon btn-info" href="#">
                                    <i class="fas fa-minus"></i>
                                </a>                    
                            </div >
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
                    
                    <!--type-->
                    <div class="form-group">
                        <label class="col-form-label">Type d'equipement</label>
                        <select class="form-control selectric" name="type_id">
                            <?php
                                foreach($type as $p)
                                {
                            ?>
                                    <option value=<?=$p->id?>><?=ucfirst($p->type)?></option>
                            <?php
                                }
                            ?>                        
                        </select>
                    </div>
                    
                    <!--marque du produit-->
                    <div class="form-group">
                        <label></label>
                        <div class="input-group">                           
                            <input type="text" class="form-control" placeholder="Marque du Produit" name="product_brand">
                        </div>
                    </div>
                    
                    <!--Prix unitaire-->
                    <div class="form-group">
                        <label>Prix Unitaire</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                            <input type="number " class="form-control" placeholder="Prix Unitaire" name="cost_per_unit">
                        </div>
                    </div>
                    
                    <!--Quantité-->
                    <!-- <div class="form-group">
                        <label>Quantité</label>
                        <div class="input-group">
                            <input type="number " class="form-control" placeholder="Quantité initiale" name="quantity">
                        </div>
                    </div>                    -->
                    
                     <!--Stock minimum-->
                     <div class="form-group">
                        <label>Stock Maximum</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Stock Maximum" name="maximum_stock">
                        </div>
                    </div>

                     <!--Stock minimum-->
                    <div class="form-group">
                        <label>Stock Minimum</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Stock Minimum" name="minimum_stock">
                        </div>
                    </div>

                    <!--Unite de messure-->
                    <div class="form-group">
                        <label class="col-form-label">Unité de messure</label>
                        <select class="form-control selectric" name="unit_of_measure">
                           <option value="m">Mètres</option>     
                           <option value="Kg">Kg</option>    
                           <option value="Litres">Litres</option>     
                           <option value="Pouces">Pouces</option>                    
                        </select>
                    </div>               
                    
                    <!--Num serie-->
                    <div class="form-group">
                        <label>Numero de serie</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Num. serie" name="num_serie">
                        </div>
                    </div>

                    <!--Image-->
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

        $("#filter_capex").click(function(e){
            e.preventDefault();

            console.log('dcd');
            $("#filter_by_capex").atr('disabled','disabled');
        })
    })
</script>