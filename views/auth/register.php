<?php // views/auth/register.php ?>
<section class="auth-hero py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-7 col-xl-6">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h2 class="card-title text-center mb-3">Registro de Usuario</h2>
                        <p class="text-center text-muted mb-4">Crea tu cuenta en unos segundos</p>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?= BASE_URL ?>register" novalidate>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Tu nombre completo" required>
                            </div>

                            <div class="mb-3">
                                <label for="emailRegister" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control form-control-lg" id="emailRegister" name="email" placeholder="tucorreo@ejemplo.com" required>
                            </div>

                            <div class="mb-3 position-relative">
                                <label for="passwordRegister" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-lg" id="passwordRegister" name="password" placeholder="Crea una contraseña segura" required aria-describedby="togglePasswordRegister">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePasswordRegister" title="Mostrar contraseña"><i class="bi bi-eye"></i></button>
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-success btn-lg">Registrarse</button>
                            </div>

                            <div class="text-center">
                                <small class="text-muted">¿Ya tienes cuenta? <a href="<?= BASE_URL ?>login">Inicia sesión</a></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>