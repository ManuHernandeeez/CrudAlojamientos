<?php // views/auth/login.php ?>
<section class="auth-hero py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-7 col-xl-6">
        <div class="card shadow-sm rounded-4">
          <div class="card-body p-4">
            <h2 class="card-title text-center mb-3">Iniciar Sesión</h2>
            <p class="text-center text-muted mb-4">Accede a tu cuenta para gestionar tus alojamientos</p>

            <?php if (isset($error)): ?>
              <div class="alert alert-danger">
                <?= $error ?>
              </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>login" novalidate>
              <div class="mb-3">
                <label for="emailLogin" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control form-control-lg" id="emailLogin" name="email" placeholder="tucorreo@ejemplo.com" required>
              </div>

              <div class="mb-3 position-relative">
                <label for="passwordLogin" class="form-label">Contraseña</label>
                <div class="input-group">
                  <input type="password" class="form-control form-control-lg" id="passwordLogin" name="password" placeholder="Contraseña" required aria-describedby="togglePasswordLogin">
                  <button class="btn btn-outline-secondary" type="button" id="togglePasswordLogin" title="Mostrar contraseña"><i class="bi bi-eye"></i></button>
                </div>
              </div>

              <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg">Iniciar Sesión</button>
              </div>

              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">¿No tienes cuenta?</small>
                <a class="btn btn-outline-primary" href="<?= BASE_URL ?>register">Regístrate</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>