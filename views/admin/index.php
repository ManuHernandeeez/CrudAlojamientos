<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Panel de Administración</h1>
        <a href="<?= BASE_URL ?>admin/alojamientos/crear" class="btn btn-primary">
            Agregar Nuevo Alojamiento
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Alojamientos</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Ubicación</th>
                            <th>Precio</th>
                            <th>Capacidad</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alojamientos as $alojamiento): ?>
                            <tr>
                                <td><?= $alojamiento['id'] ?></td>
                                <td><?= htmlspecialchars($alojamiento['nombre']) ?></td>
                                <td><?= htmlspecialchars(ucfirst($alojamiento['tipo_alojamiento'])) ?></td>
                                <td><?= htmlspecialchars($alojamiento['ubicacion']) ?></td>
                                <td>$<?= number_format($alojamiento['precio'], 2) ?></td>
                                <td><?= $alojamiento['capacidad'] ?> personas</td>
                                <td>
                                    <span class="badge bg-<?= $alojamiento['activo'] ? 'success' : 'danger' ?>">
                                        <?= $alojamiento['activo'] ? 'Activo' : 'Inactivo' ?>
                                    </span>
                                </td>
                                    <td>
                                        <a href="<?= BASE_URL ?>admin/alojamientos/editar?id=<?= $alojamiento['id'] ?>" class="btn btn-sm btn-warning">Editar</a>

                                        <form action="<?= BASE_URL ?>admin/alojamientos/eliminar" method="POST" class="d-inline-block ms-1" onsubmit="return confirm('¿Eliminar alojamiento? Esto lo desactivará.');">
                                            <input type="hidden" name="id" value="<?= $alojamiento['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>