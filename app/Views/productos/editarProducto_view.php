<div class="container py-4" style="margin-top: 56px;">
  <div class="container mt-2">
    <div class="row justify-content-center">
      <div class="formulario col-md-5 shadow p-3 mb-5 bg-light">
        <h2 class="titulo text-center">Editar Producto</h2>

        <?php $validation = \Config\Services::validation(); ?>
        <form class="mx-auto p-2" method="post" enctype="multipart/form-data" action="<?php echo base_url('/enviarEdicionProd') ?>" id="editProductForm">
          <?= csrf_field(); ?>
          <?php if (!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
          <?php endif ?>
          <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
          <?php endif ?>

          <!-- Nombre -->
          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="nombre">Nombre</label>
            <input
              name="nombre"
              type="text"
              class="form-control"
              id="nombre"
              placeholder="Nombre"
              value="<?php echo esc($data['nombre']); ?>"
              required
              pattern="[a-zA-Z0-9\s.]+"
              title="Solo se permiten letras, números, espacios y el punto (.)">
          </div>

          <!-- Descripción -->
          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo esc($data['descripcion']); ?>" required>
          </div>

          <!-- Imagen -->
          <label for="imagen" class="form-label">Imagen Actual:</label>
          <div class="mb-3">
            <img class="frmImg3 rounded" src="<?php echo base_url('assets/uploads/' . $data['imagen']); ?>">
            <br><br>
            <input name="imagen" id="imagen" type="file" class="form-control">
          </div>

          <!-- Precio -->
          <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <div class="input-group">
              <span class="input-group-text">$</span>
              <input
                type="text"
                name="precio"
                id="precio"
                class="form-control"
                value="<?php echo number_format($data['precio'], 2, ',', '.'); ?>"
                required>
            </div>
          </div>

          <!-- Precio Venta -->
          <div class="mb-3">
            <label for="precio_vta" class="form-label">Precio Venta</label>
            <div class="input-group">
              <span class="input-group-text">$</span>
              <input
                name="precio_vta"
                id="precio_vta"
                type="text"
                class="form-control"
                value="<?php echo number_format($data['precio_vta'], 2, ',', '.'); ?>"
                required>
            </div>
            <div id="precio-alert" class="text-danger mt-2" style="display: none;">El precio de venta debe ser mayor o igual al precio.</div>
          </div>

          <!-- Stock -->
          <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input
              name="stock"
              id="stock"
              type="number"
              class="form-control"
              value="<?php echo esc($data['stock']); ?>"
              required>
            <div id="stock-alert" class="text-danger mt-2" style="display: none;">El stock debe ser mayor o igual al stock mínimo.</div>
          </div>

          <!-- Stock Mínimo -->
          <div class="mb-3">
            <label for="stock_min" class="form-label">Stock Mínimo</label>
            <input
              name="stock_min"
              id="stock_min"
              type="number"
              class="form-control"
              value="<?php echo esc($data['stock_min']); ?>"
              required>
            <div id="stock-min-alert" class="text-danger mt-2" style="display: none;">El stock mínimo no puede ser menor que 1.</div>
          </div>

          <!-- Categoría -->
          <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <?php
            // Definir la categoría dinámica
            $categoria = '';
            switch ($data['categoria_id']) {
              case 1:
                $categoria = 'Mantequilla de maní';
                break;
              case 2:
                $categoria = 'Snack';
                break;
              case 3:
                $categoria = 'Café';
                break;
              case 4:
                $categoria = 'Otros';
                break;
              default:
                $categoria = 'Sin Categoría'; // En caso de un valor inesperado
            }
            ?>
            <select name="categoria_id" id="categoria_id" class="form-control">
              <option value="<?php echo esc($data['categoria_id']); ?>"><?php echo esc($categoria); ?></option>
              <option value="1">Mantequilla de maní</option>
              <option value="2">Snack</option>
              <option value="3">Café</option>
              <option value="4">Otros</option>
            </select>
          </div>


          <!-- Campo oculto para eliminado -->
          <input name="eliminado" type="hidden" value="<?= $data['eliminado'] ?>">

          <!-- ID oculto -->
          <input name="id" type="hidden" value="<?= $data['id'] ?>">


          <!-- Botones -->
          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <input type="submit" id="editButton" class="btn btn-dark" value="Actualizar" disabled>
          </div>
          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <a href="<?php echo base_url('Lista_Productos'); ?>" class="btn btn-secondary">Cancelar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const editButton = document.getElementById('editButton');

    const formatCurrency = (value) => {
      const numericValue = parseFloat(value.replace(/[^0-9]/g, '') || 0) / 100;
      return numericValue.toLocaleString('es-ES', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    };

    const toggleEditButton = () => {
      const alerts = document.querySelectorAll('.text-danger[style="display: block;"]');
      const requiredInputs = document.querySelectorAll('#editProductForm input[required]');
      let allValid = true;

      requiredInputs.forEach((input) => {
        if (input.value.trim() === '' || input.classList.contains('is-invalid')) {
          allValid = false;
        }
      });

      editButton.disabled = alerts.length > 0 || !allValid;
    };

    const validateNumericFields = () => {
      document.querySelectorAll('#precio, #precio_vta, #stock, #stock_min').forEach(input => {
        input.addEventListener('input', () => {
          input.value = input.value.replace(/\D/g, '');
          if (['precio', 'precio_vta'].includes(input.id)) {
            input.value = formatCurrency(input.value);
          }
          toggleEditButton();
        });
      });
    };

    const validatePrices = () => {
      const precio = document.getElementById('precio');
      const precioVta = document.getElementById('precio_vta');
      const alertDiv = document.getElementById('precio-alert');

      const checkPrices = () => {
        const precioValue = parseFloat(precio.value.replace(/[^\d]/g, '').replace(',', '.') || 0);
        const precioVtaValue = parseFloat(precioVta.value.replace(/[^\d]/g, '').replace(',', '.') || 0);

        if (precioVtaValue >= precioValue) {
          alertDiv.style.display = 'none';
          precioVta.classList.remove('is-invalid');
        } else {
          alertDiv.style.display = 'block';
          precioVta.classList.add('is-invalid');
        }
        toggleEditButton();
      };

      precio.addEventListener('input', checkPrices);
      precioVta.addEventListener('input', checkPrices);
    };

    const validateStockRelation = () => {
      const stock = document.getElementById('stock');
      const stockMin = document.getElementById('stock_min');
      const alertStockDiv = document.getElementById('stock-alert');
      const alertStockMinDiv = document.getElementById('stock-min-alert');

      const checkStock = () => {
        const stockValue = parseInt(stock.value || 0, 10);
        const stockMinValue = parseInt(stockMin.value || 0, 10);

        if (stockValue >= stockMinValue) {
          alertStockDiv.style.display = 'none';
          stock.classList.remove('is-invalid');
        } else {
          alertStockDiv.style.display = 'block';
          stock.classList.add('is-invalid');
        }

        if (stockMinValue >= 1) {
          alertStockMinDiv.style.display = 'none';
          stockMin.classList.remove('is-invalid');
        } else {
          alertStockMinDiv.style.display = 'block';
          stockMin.classList.add('is-invalid');
        }
        toggleEditButton();
      };

      stock.addEventListener('input', checkStock);
      stockMin.addEventListener('input', checkStock);
    };

    const validateName = () => {
      const nombreInput = document.getElementById('nombre');
      if (nombreInput) {
        nombreInput.addEventListener('input', () => {
          nombreInput.value = nombreInput.value.replace(/[^a-zA-Z0-9\s.]/g, '');
          toggleEditButton();
        });
      }
    };

    validateNumericFields();
    validatePrices();
    validateStockRelation();
    validateName();

    toggleEditButton();
  });
</script>