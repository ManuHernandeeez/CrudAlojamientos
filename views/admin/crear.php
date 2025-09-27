<div class="container">
    <h1 class="mb-4">Agregar Nuevo Alojamiento</h1>

    <div class="card">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= BASE_URL ?>admin/alojamientos/crear">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Alojamiento</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="precio" class="form-label">Precio por Noche</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="capacidad" class="form-label">Capacidad (personas)</label>
                        <input type="number" class="form-control" id="capacidad" name="capacidad" min="1" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="ubicacion" class="form-label">Ubicación</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
                </div>

                <div class="mb-3">
                    <label for="tipo_alojamiento" class="form-label">Tipo de Alojamiento</label>
                    <select class="form-select" id="tipo_alojamiento" name="tipo_alojamiento" required>
                        <option value="hotel">Hotel</option>
                        <option value="apartamento">Apartamento</option>
                        <option value="casa">Casa</option>
                        <option value="hostal">Hostal</option>
                        <option value="resort">Resort</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="imagen_url" class="form-label">URL de la Imagen</label>
                    <input type="url" class="form-control" id="imagen_url" name="imagen_url" required>
                    <small class="form-text text-muted">Introduce la URL de una imagen que represente el alojamiento</small>
                </div>

                <div class="mb-3">
                    <label for="servicios" class="form-label">Servicios (separados por comas)</label>
                    <textarea class="form-control" id="servicios" name="servicios" rows="2" required></textarea>
                    <small class="form-text text-muted">Ejemplo: WiFi, Piscina, Gimnasio, Parking</small>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Crear Alojamiento</button>
                    <a href="<?= BASE_URL ?>admin/alojamientos" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>