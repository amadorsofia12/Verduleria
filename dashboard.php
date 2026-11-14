<?php
include("conexion.php");
$resultado = $conexion->query("SELECT * FROM producto");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Verdulería - Inventario</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; }
        .card-header-custom { background-color: #198754; color: white; }
        .alerta-roja { background-color: #f8d7da !important; color: #842029 !important; font-weight: bold; }
        .estado-ok { background-color: #d1e7dd !important; color: #0f5132 !important; font-weight: 600; }
    </style>
</head>
<body>
    <!-- Barra de navegación superior -->
    <nav class="navbar navbar-dark bg-success shadow-sm mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">🥬 Sistema de Control de Inventario - Verdulería</span>
            <span class="text-white small">Panel Principal (Avance Funcional)</span>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header card-header-custom d-flex justify-content-between align-items-center py-3">
                <h5 class="mb-0">Control de Inventario y Alertas de Stock</h5>
                <span class="badge bg-light text-dark">En tiempo real</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Unidad</th>
                                <th>Precio</th>
                                <th>Stock Actual</th>
                                <th>Stock Mínimo</th>
                                <th class="text-center">Estado / Alerta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $resultado->fetch_assoc()) { 
                                $esBajo = ($row['stock_actual'] <= $row['stock_minimo']);
                                $claseEstado = $esBajo ? 'alerta-roja' : 'estado-ok';
                            ?>
                            <tr>
                                <td class="fw-semibold"><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row['unidad_medida']); ?></td>
                                <td>₡<?php echo number_format($row['precio'], 2); ?></td>
                                <td><?php echo $row['stock_actual']; ?></td>
                                <td><?php echo $row['stock_minimo']; ?></td>
                                <td class="text-center <?php echo $claseEstado; ?>">
                                    <?php echo $esBajo ? ' ¡Stock Bajo / Alerta!' : ' Optimo'; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>