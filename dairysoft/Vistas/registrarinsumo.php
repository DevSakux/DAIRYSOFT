<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Inventario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #282828;
            color: #fff;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            background-color: #3c3c3c;
            color: #fff;
        }
        .table {
            color: #fff;
        }
        .table thead {
            background-color: #555;
        }
        .form-control {
            background-color: #555;
            color: #fff;
            border: 1px solid #777;
        }
        .form-control::placeholder {
            color: #bbb;
        }
        .btn-primary {
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        #insumoForm {
            border: 2px solid #8bc34a;
            border-radius: 10px;
            padding: 20px;
            background-color: #3c3c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="insumos.php" class="btn btn-success" style="position: absolute; top: 10px; left: 10px;"><i class="fas fa-arrow-left"></i> REGRESAR</a>
        <h1 class="text-center mb-4">REGISTRAR INSUMO</h1>
        <form id="insumoForm" action="../Controladores/AgregarinsumoController.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="insumoNombre">Nombre del Insumo</label>
                    <input type="text" class="form-control" name="nombreInsumo" id="insumoNombre" placeholder="Ej. Huevos" required>
                </div>              
                <div class="form-group col-md-6">
                    <label for="insumoDescripcion">Descripción del Insumo</label>
                    <input type="text" class="form-control" name="descripcionInsumo" id="insumoDescripcion" placeholder="Descripción del Insumo">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="insumoCantidad">Cantidad</label>
                    <input type="number" class="form-control" name="cantidadInsumo" id="insumoCantidad" placeholder="Cantidad" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="insumoUnidad">Unidad</label>
                    <select class="form-control" name="unidadInsumo" id="insumoUnidad" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="unidades">Unidades</option>
                        <option value="litros">Litros</option>
                        <option value="kilogramos">Kilogramos</option>
                        <option value="gramos">Gramos</option>
                        <option value="mililitros">Mililitros</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="insumoPrecio">Precio</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" name="precioInsumo" id="insumoPrecio" placeholder="Ej. 10.50" required>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="insumoCodigo">Código de Insumo</label>
                    <input type="text" class="form-control" name="codigoInsumo" id="insumoCodigo" placeholder="Código de Insumo" required>
                </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-4">
    <label for="insumoFechaCompra">Fecha de Compra</label>
    <input type="date" class="form-control" name="fechaCompra" id="insumoFechaCompra" min="2024-01-01" max="2025-12-31" required>
</div>
                <div class="form-group col-md-4">
                    <label for="insumoFechaLote">Fecha de Lote</label>
                    <input type="date" class="form-control" name="fechaLote" id="insumoFechaLote" min="2020-01-01" max="2024-12-31" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="insumoFechaVencimiento">Fecha de Vencimiento</label>
                    <input type="date" class="form-control" name="fechaVencimiento" id="insumoFechaVencimiento" min="2024-06-01" max="2030-12-31" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="insumoUbicacion">Ubicación de Almacenamiento</label>
                    <input type="text" class="form-control" name="ubicacionAlmacenamiento" id="insumoUbicacion" placeholder="Ubicación de Almacenamiento" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="insumoCategoria">Categoría del Insumo</label>
                    <select class="form-control" name="categoriaInsumo" id="insumoCategoria" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="Perecedero">Perecedero</option>
                        <option value="No Perecedero">No Perecedero</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
    <div class="form-group col-md-6">
        <label for="proveedorNombre">Nombre del Proveedor</label>
        <input type="text" class="form-control" name="nombreProveedor" id="proveedorNombre" placeholder="Nombre del Proveedor" required>
    </div>
    <div class="form-group col-md-6">
        <label for="proveedorContacto">Contacto del Proveedor</label>
        <input type="tel" class="form-control" name="contactoProveedor" id="proveedorContacto" placeholder="Contacto del Proveedor" required>
    </div>
</div>

            <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center"> REGISTRAR INSUMO</button>
        </form>
    </div>
</body>
</html>

