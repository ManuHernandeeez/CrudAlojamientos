<div class="container">
    <h1 class="mb-4">Mis Alojamientos Seleccionados</h1>

    <?php if (empty($alojamientos)): ?>
        <div class="alert alert-info">
            <p class="mb-0">Aún no has seleccionado ningún alojamiento. 
                <a href="<?= BASE_URL ?>" class="alert-link">Explora nuestros alojamientos</a>
            </p>
        </div>
    <?php else: ?>
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

                            <form action="<?= BASE_URL ?>user/alojamientos/eliminar" method="POST" class="d-grid">
                                <input type="hidden" name="alojamiento_id" value="<?= $alojamiento['id'] ?>">
                                <button type="submit" class="btn btn-danger delete-btn">
                                    Eliminar de mi lista
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>