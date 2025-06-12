<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nacional Tapizados - Expertos en Tapicería Automotriz</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Nacional de Tapizados</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="trabajos.php">Trabajos Realizados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="materiales.php">Materiales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tecnicas.php">Técnicas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Inicio de Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clientes.php">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cotizaciones.php">Cotizaciones</a>
                </li>
            </ul>
        </div>
    </nav>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="login-container animate__animated animate__fadeIn">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Registro de Clientes</h2>
                        <p class="text-muted">Ingresa los datos del cliente</p>
                    </div>
                    <form id="loginForm" action="php/conexion.php" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-4">
                            <label for="tel" class="form-label">Teléfono</label>
                            <input type="number" class="form-control" id="tel" name="tel" required>
                        </div>
                        <div class="mb-4">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="mb-4">
                            <label for="notas" class="form-label">Notas</label>
                            <input type="text" class="form-control" id="notas" name="notas" required>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg" name="ingresar">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>