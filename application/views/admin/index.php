<?php
    if(($this->session->user_added))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'User added successfully!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    $this->session->user_added = null;
    }
?>

 <!-- Main Content -->
 <div class="main-content">
    <section class="section">
        <div class="section-body">
            <!-- insights -->            
           
            <!-- users table -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header bg-blue">
                        <h4 class="text-white">Utilisateurs</h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newUserForm">
                            <i class="fas fa-plus"></i>&nbsp; Nouvel utilisateur
                            </button>&nbsp;&nbsp;
                        </div>
                        <div class="card-header-action">
                            <a data-collapse="#user-collapse" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="user-collapse">
                        <div class="card-body">
                            <div class="table-responsive table-bordered">
                            <table class="table table-striped">
                                <tr class="text-center">
                                <th>Matricule</th>
                                <th>Nom complet</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Sex</th>
                                <th>Adresse</th>
                                <th>Departement</th>
                                <th>Role</th>
                                <th>Action</th>
                                </tr>
                                <tbody>                 
                                    
                                    <?php
                                        foreach($user as $u)
                                        {
                                    ?>  
                                    <tr class="text-center">               
                                        <td><?=$u->matricule?></td>                   
                                        <td><?=$u->fullname?></td>
                                        <td><?=$u->email?></td>
                                        <td><?=$u->phone?></td>
                                        <td><?=ucfirst($u->gender[0])?></td>
                                        <td><?=$u->address?></td>
                                        <td><?=$u->department?></td>
                                        <td><?=$u->role?></td>
                                        <td>
                                            <!-- <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="View"><i
                                                class="fas fa-eye"></i></a> -->
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete"
                                            data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                            data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
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

     <!--================forms area =======================-->

    <!-- Modal form for a new user-->
    <div class="modal fade" id="newUserForm" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Ajouter un nouvel utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('admin/new_user')?>" method="post" class="">
                    <div class="form-group">
                        <label>Nom complet</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-user-tie"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Nom complet" name="fullname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Email" name="email">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Numero de telephone</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-phone"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Numero de telephone" name="phone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Sex</label>
                        <select class="form-control" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Adresse</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Adresse" name="address">
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label>Departement</label>
                        <select class="form-control" name="department_id">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="type">
                            <option value="encoder">Encodeur des données</option>
                            <option value="finance">Financier</option>
                            <option value="do">Responsable de departement</option>
                        </select>
                    </div> -->


                    <div class="form-group">
                        <label>Mot de passe</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="Mot de passe" name="password">
                        </div>
                    </div>
                    <input type="hidden" name="role" value="teacher">
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">ADD</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
