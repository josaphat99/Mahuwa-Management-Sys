<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-5 offset-md-4">
                    <h1>Bons des commande</h1>
                </div>
            </div>
            <br>
             <!-- validated purchase order table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Bons des commandes validés</h4>
                        <div class="card-header-action">
                            <a data-collapse="#v_pch-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="v_pch-collapse">
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
                                            foreach($valid_pch_order as $po)
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
                                            <td>
                                                <span class="alert alert-light">Validé</span>
                                            </td>
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
                add content here..
            </div>
            <?php
                if($this->session->type == 'dg')
                {
            ?>            
                    <div class="modal-footer bg-whitesmoke br" id="po_action_btn">
                       
                    </div>
            <?php
                }else if($this->session->type == 'finance')
                {
            ?>
                    <div class="modal-footer bg-whitesmoke br" id="finance_action_btn">
                       <a href="<?=site_url('finance/new_expense?budget_id=2')?>" class="btn btn-success btn-lg" data-toggle="modal" data-target="#form_newexpense">Effectuer la depense</a>                         
                    </div>
            <?php
                }
            ?>
        </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<script>
    $(function(){
        alert('test');
        
        $('.view_btn').click(function(e){
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];
            
            var designation = e.target.getAttribute('designation');
            var po_id = e.target.getAttribute('po_id');
            var status = e.target.getAttribute('status');

            var detail = $("#detail-"+id);

            var quote1 = detail.attr('quote1');
            var quote2 = detail.attr('quote2');
            var quote3 = detail.attr('quote3');

            var detail_html = '<table class="table table-striped"><tr><td>Quote 1</td><td>'+quote1+'</td></tr><tr><td>Quote 2</td><td>'+quote2+'</td></tr><tr><td>Quote 3</td><td>'+quote3+'</td></tr></table>';
            var po_action_btn = $("#po_action_btn");
            

            $("#exampleModalCenterTitle").html(designation);            

            $.post('<?=site_url("ajax/view_eq")?>',{eq_id:id},function(data)
            {
                $("#eq_img_space").html(data+'<hr><h3>Details</h3><br>'+detail_html);
                //console.log(data);
            })
        })
    })
</script>
