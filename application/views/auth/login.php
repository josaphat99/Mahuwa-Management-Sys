<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h2 class="text-center" style="color:rgba(0,0,0,0.7)"><span><img style="width:50px" src="<?=base_url('assets/img/logo/logo_pn.png')?>" alt=""></span>MAHUWA</h2>
          </div>
        </div>
        <br><br>
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-info">
              <div class="card-header">
                <h4>Authentification</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="<?=site_url('auth/login')?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Nom d'utilisateur</label>
                    <input id="email" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Veuillez fournir votre nom d'utilisateur!
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Mot de passe</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Veuillez fournir votre mot de passe!
                    </div>
                    <p class="text-center text-danger"><?php echo $this->session->error_login; $this->session->error_login=null;?></p>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-info btn-lg btn-block" tabindex="4">
                      Connexion
                    </button> 
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>