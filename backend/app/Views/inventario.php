<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inventario de Medicamentos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
  <div class="container py-4">
    <h1 class="mb-3">Sistema de Gestión de Inventario</h1>

    <div id="alert-placeholder"></div>

    <div class="card mb-4">
      <div class="card-body">
        <form id="form-medicamento" class="row g-3">
          <input type="hidden" id="med-id" />
          <div class="col-md-6">
            <label class="form-label">Nombre *</label>
            <input id="nombre" name="nombre" class="form-control" required />
          </div>
          <div class="col-md-6">
            <label class="form-label">Categoría *</label>
            <select id="categoria" name="categoria" class="form-select" required>
              <option value="">Seleccionar</option>
              <option>Analgésicos</option><option>Antibióticos</option><option>Antiinflamatorios</option>
              <option>Antihipertensivos</option><option>Antihistamínicos</option><option>Vitaminas</option>
              <option>Suplementos</option><option>Otros</option>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">Cantidad *</label>
            <input id="cantidad" name="cantidad" type="number" min="0" class="form-control" required />
          </div>
          <div class="col-md-3">
            <label class="form-label">Fecha Expiración *</label>
            <input id="fecha_expiracion" name="fecha_expiracion" type="date" class="form-control" required />
          </div>
          <div class="col-12 text-end">
            <button type="button" id="btn-cancel" class="btn btn-secondary d-none">Cancelar</button>
            <button type="submit" id="btn-save" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-body">
        <div class="row g-2">
          <div class="col-md-4">
            <input id="search" placeholder="Buscar por nombre..." class="form-control" />
          </div>
          <div class="col-md-4">
            <select id="filter-categoria" class="form-select">
              <option value="all">Todas las categorías</option>
              <option>Analgésicos</option><option>Antibióticos</option><option>Antiinflamatorios</option>
              <option>Antihipertensivos</option><option>Antihistamínicos</option><option>Vitaminas</option>
              <option>Suplementos</option><option>Otros</option>
            </select>
          </div>
          <div class="col-md-4">
            <select id="filter-expiration" class="form-select">
              <option value="all">Todas las fechas</option>
              <option value="expired">Vencidos</option>
              <option value="expiring_soon">Por vencer (30 días)</option>
              <option value="valid">Vigentes</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div id="tabla-container"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/inventario.js"></script>
</body>
</html>
