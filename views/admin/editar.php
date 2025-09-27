<div class="container">
    <h1 class="mb-4">Editar Alojamiento</h1>

    <div class="card">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <?php $a = $alojamiento; ?>
            <form method="POST" action="<?= BASE_URL ?>admin/alojamientos/editar">
                <input type="hidden" name="id" value="<?= $a['id'] ?>">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Alojamiento</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($a['nombre']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?= htmlspecialchars($a['descripcion']) ?></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="precio" class="form-label">Precio por Noche</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" value="<?= htmlspecialchars($a['precio']) ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="capacidad" class="form-label">Capacidad (personas)</label>
                        <input type="number" class="form-control" id="capacidad" name="capacidad" min="1" value="<?= htmlspecialchars($a['capacidad']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="ubicacion" class="form-label">Ubicación</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?= htmlspecialchars($a['ubicacion']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="tipo_alojamiento" class="form-label">Tipo de Alojamiento</label>
                    <select class="form-select" id="tipo_alojamiento" name="tipo_alojamiento" required>
                        <?php $types = ['hotel','apartamento','casa','hostal','resort']; foreach ($types as $t): ?>
                            <option value="<?= $t ?>" <?= $a['tipo_alojamiento'] === $t ? 'selected' : '' ?>><?= ucfirst($t) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="imagen_url" class="form-label">URL de la Imagen</label>
                    <input type="url" class="form-control" id="imagen_url" name="imagen_url" value="<?= htmlspecialchars($a['imagen_url']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="servicios" class="form-label">Servicios (separados por comas)</label>
                    <textarea class="form-control" id="servicios" name="servicios" rows="2" required><?= htmlspecialchars($a['servicios']) ?></textarea>
                    <small class="form-text text-muted">Ejemplo: WiFi, Piscina, Gimnasio, Parking</small>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="activo" name="activo" <?= $a['activo'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="activo">Activo</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="<?= BASE_URL ?>admin/alojamientos" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>