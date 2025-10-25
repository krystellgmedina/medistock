$(function() {
  const apiBase = '/inventario';

  function showAlert(type, msg) {
    $('#alert-placeholder').html(`<div class="alert alert-${type} alert-dismissible">${msg}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>`);
  }

  function fetchAndRender() {
    const q = $('#search').val();
    const categoria = $('#filter-categoria').val();
    const expiration = $('#filter-expiration').val();
    $.get(`${apiBase}/list`, { q, categoria, expiration }, function(data) {
      renderTable(data);
    });
  }

  function renderTable(meds) {
    if (!meds || meds.length === 0) {
      $('#tabla-container').html('<div class="card"><div class="card-body text-center">No se encontraron medicamentos</div></div>');
      return;
    }
    let html = `<div class="card"><div class="card-body table-responsive"><table class="table table-hover"><thead><tr>
      <th>Nombre</th><th>Categoría</th><th>Cantidad</th><th>Fecha Expiración</th><th>Estado</th><th class="text-end">Acciones</th>
    </tr></thead><tbody>`;
    meds.forEach(m => {
      const expDate = new Date(m.fecha_expiracion);
      const today = new Date();
      const diffDays = Math.ceil((expDate - today)/(1000*60*60*24));
      let estado = 'Vigente';
      if (diffDays < 0) estado = 'Vencido';
      else if (diffDays <= 30) estado = 'Por vencer';
      html += `<tr data-id="${m.id}">
        <td>${m.nombre}</td>
        <td>${m.categoria}</td>
        <td>${m.cantidad}${m.cantidad < 10 ? ' <span class="text-danger">(!)</span>':''}</td>
        <td>${expDate.toLocaleDateString()}</td>
        <td>${estado}</td>
        <td class="text-end">
          <button class="btn btn-sm btn-outline-primary btn-edit">Editar</button>
          <button class="btn btn-sm btn-outline-danger btn-delete">Eliminar</button>
        </td>
      </tr>`;
    });
    html += '</tbody></table></div></div>';
    $('#tabla-container').html(html);
  }

  // Events
  $('#search, #filter-categoria, #filter-expiration').on('input change', fetchAndRender);

  $('#form-medicamento').on('submit', function(e) {
    e.preventDefault();
    const id = $('#med-id').val();
    const payload = {
      nombre: $('#nombre').val().trim(),
      categoria: $('#categoria').val(),
      cantidad: $('#cantidad').val(),
      fecha_expiracion: $('#fecha_expiracion').val()
    };
    // Basic client-side validation
    if (!payload.nombre || !payload.categoria || payload.cantidad === '' || !payload.fecha_expiracion) {
      showAlert('danger', 'Por favor completa todos los campos requeridos.');
      return;
    }
    const url = id ? `${apiBase}/update/${id}` : `${apiBase}/create`;
    $.post(url, payload)
      .done(function() {
        showAlert('success', id ? 'Medicamento actualizado.' : 'Medicamento agregado.');
        $('#form-medicamento')[0].reset();
        $('#med-id').val('');
        $('#btn-cancel').addClass('d-none');
        fetchAndRender();
      })
      .fail(function(xhr) {
        showAlert('danger', 'Error en la operación: ' + (xhr.responseJSON?.message || xhr.statusText));
      });
  });

  $('#btn-cancel').on('click', function() {
    $('#form-medicamento')[0].reset();
    $('#med-id').val('');
    $(this).addClass('d-none');
  });

  // Delegated events for edit/delete
  $('#tabla-container').on('click', '.btn-edit', function() {
    const row = $(this).closest('tr');
    const id = row.data('id');
    // Load data from row into form
    $('#med-id').val(id);
    $('#nombre').val(row.children().eq(0).text());
    $('#categoria').val(row.children().eq(1).text());
    $('#cantidad').val(row.children().eq(2).text().replace(/\D/g,''));
    // Fecha: we cannot reconstruct from display safely; fetch single record if needed. For simplicity call list and search id
    $.get(`${apiBase}/list`, {}, function(data) {
      const m = data.find(x => x.id === id);
      if (m) $('#fecha_expiracion').val(m.fecha_expiracion);
      $('#btn-cancel').removeClass('d-none');
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  });

  $('#tabla-container').on('click', '.btn-delete', function() {
    const row = $(this).closest('tr');
    const id = row.data('id');
    if (!confirm('¿Estás seguro de eliminar este medicamento? Esta acción no se puede deshacer.')) return;
    $.post(`${apiBase}/delete/${id}`)
      .done(function() {
        showAlert('success', 'Medicamento eliminado.');
        fetchAndRender();
      })
      .fail(function() {
        showAlert('danger', 'Error al eliminar medicamento.');
      });
  });

  // Initial load
  fetchAndRender();
});
