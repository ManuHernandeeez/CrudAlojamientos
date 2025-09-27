<div class="container">
    <h1 class="text-center mb-4">Descubre Alojamientos Increíbles</h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($alojamientos as $alojamiento): ?>
            <div class="col">
                <div class="card h-100 alojamiento-card">
                    <img src="<?= htmlspecialchars($alojamiento['imagen_url']) ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars($alojamiento['nombre']) ?>">
                    
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($alojamiento['nombre']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars(substr($alojamiento['descripcion'], 0, 100)) ?>...</p>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-info">
                                <?= htmlspecialchars(ucfirst($alojamiento['tipo_alojamiento'])) ?>
                            </span>
                            <span class="text-success fw-bold">
                                $<?= number_format($alojamiento['precio'], 2) ?>/noche
                            </span>
                        </div>
                        
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt"></i> 
                                <?= htmlspecialchars($alojamiento['ubicacion']) ?>
                            </small>
                        </p>

                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_type'] !== 'admin'): ?>
                            <form action="<?= BASE_URL ?>user/alojamientos/agregar" method="POST" class="d-grid">
                                <input type="hidden" name="alojamiento_id" value="<?= $alojamiento['id'] ?>">
                                <button type="submit" class="btn btn-primary">
                                    Seleccionar Alojamiento
                                </button>
                            </form>
                        <?php elseif (!isset($_SESSION['user_id'])): ?>
                            <div class="d-grid">
                                <a href="<?= BASE_URL ?>login" class="btn btn-outline-primary">
                                    Inicia sesión para seleccionar
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Agregar Font Awesome para los iconos -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">