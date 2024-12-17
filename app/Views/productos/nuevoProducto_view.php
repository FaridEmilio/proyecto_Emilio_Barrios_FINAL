<div class="container py-4" style="margin-top: 56px;">
  <div class="container mt-2">
    <div class="row justify-content-center">
      <div class="formulario col-md-5 shadow p-3 mb-5 bg-light">
        <h2 class="titulo text-center">Nuevo Producto</h2>

        <?php $validation = \Config\Services::validation(); ?>
        <form class="mx-auto p-2" method="post" enctype="multipart/form-data" action="<?php echo base_url('ProductoValidation') ?>" id="productForm">
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
            <div class="col-auto">
              <input
                class="form-control form-control-sm"
                name="nombre"
                id="nombre"
                type="text"
                required
                pattern="[a-zA-Z0-9\s.]+"
                title="Solo se permiten letras, espacios y el punto (.)">
            </div>
          </div>


          <!-- Descripción -->
          <div class="mb-2">
            <label class="col-form-label" for="descripcion">Descripción</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="descripcion" id="descripcion" type="text" required>
            </div>
          </div>

          <!-- Imagen -->
          <div class="mb-2">
            <label class="col-form-label" for="imagen">Cargar imagen</label>
            <div class="col-auto">
              <input name="imagen" id="imagen" type="file" required>
            </div>
          </div>

          <!-- Categoría -->
          <div class="mb-2">
            <label class="col-sm-2 col-form-label" for="categoria_id">Categoría</label>
            <div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="categoria_id" id="categoria1" value="1" required>
                <label class="form-check-label" for="categoria1">Mantequilla de maní</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="categoria_id" id="categoria2" value="2">
                <label class="form-check-label" for="categoria2">Snack</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="categoria_id" id="categoria3" value="3">
                <label class="form-check-label" for="categoria3">Café</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="categoria_id" id="categoria4" value="4">
                <label class="form-check-label" for="categoria4">Otros</label>
              </div>
            </div>
          </div>

          <div class="mb-2">
            <label class="col-form-label col-form-label" for="precio">Precio</label>
            <div class="input-group mb-3">
              <span class="input-group-text">$</span>
              <input
                class="form-control form-control-sm"
                name="precio"
                id="precio"
                type="text"
                required="required"
                value="0,00"
                placeholder="0,00">
            </div>
          </div>

          <div class="mb-2">
            <label class="col-form-label col-form-label" for="precio_vta">Precio Venta</label>
            <div class="input-group mb-3">
              <span class="input-group-text">$</span>
              <input
                class="form-control form-control-sm"
                name="precio_vta"
                id="precio_vta"
                type="text"
                required="required"
                value="0,00"
                placeholder="0,00">
            </div>
            <div id="precio-alert" class="text-danger mt-2" style="display: none;">El precio de venta debe ser mayor o igual al precio.</div>
          </div>


          <div class="mb-2">
            <label class="col-form-label col-form-label" for="stock">Stock</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="stock" type="number" id="stock" required="required" value="1"
                placeholder="1">
            </div>
            <div id="stock-alert" style="display: none; color: #dc3545; font-size: 0.875rem;">
              El stock debe ser mayor o igual al stock mínimo.
            </div>
            <!-- Error -->
            <?php if ($validation->getError('stock')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('stock'); ?>
              </div>
            <?php } ?>
          </div>

          <div class="mb-2">
            <label class="col-form-label col-form-label" for="stock_min">Stock Mínimo</label>
            <div class="col-auto">
              <input class="form-control form-control-sm" name="stock_min" type="number" id="stock_min" required="required" value="1"
                placeholder="1">
            </div>
            <div id="stock-min-alert" style="display: none; color: #dc3545; font-size: 0.875rem;">
              El stock mínimo no puede ser menor que 1.
            </div>
            <!-- Error -->
            <?php if ($validation->getError('stock_min')) { ?>
              <div class='alert alert-danger mt-2'>
                <?= $validation->getError('stock_min'); ?>
              </div>
            <?php } ?>
          </div>

          <!-- Botones -->
          <!-- Botones -->
          <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <input type="submit" class="btn btn-dark" value="Añadir" id="addButton" disabled>
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
    const addButton = document.querySelector('input[type="submit"]');

    // Función para formatear números como moneda
    const formatCurrency = (value) => {
      const numericValue = parseFloat(value.replace(/[^0-9]/g, '') || 0) / 100;
      return numericValue.toLocaleString('es-ES', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    };

    // Deshabilitar o habilitar el botón "Añadir"
    const toggleAddButton = () => {
      const alerts = document.querySelectorAll('.text-danger[style="display: block;"]');
      const requiredInputs = document.querySelectorAll('#productForm input[required]');
      let allValid = true;

      requiredInputs.forEach((input) => {
        if (input.value.trim() === '' || input.classList.contains('is-invalid')) {
          allValid = false;
        }
      });

      addButton.disabled = alerts.length > 0 || !allValid;
    };

    // Validar y formatear campos numéricos
    const validateNumericFields = () => {
      document.querySelectorAll('#precio, #precio_vta, #stock, #stock_min').forEach(input => {
        input.addEventListener('input', () => {
          input.value = input.value.replace(/\D/g, ''); // Solo números
          if (['precio', 'precio_vta'].includes(input.id)) {
            input.value = formatCurrency(input.value); // Formato moneda
          }
          toggleAddButton(); // Actualizar estado del botón
        });
      });
    };

    // Validar relación entre precio y precio venta
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
        toggleAddButton(); // Actualizar estado del botón
      };

      precio.addEventListener('input', checkPrices);
      precioVta.addEventListener('input', checkPrices);
    };

    // Validar relación entre stock y stock mínimo
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
        toggleAddButton(); // Actualizar estado del botón
      };

      stock.addEventListener('input', checkStock);
      stockMin.addEventListener('input', checkStock);
    };

    // Validar caracteres permitidos en el nombre
    const validateName = () => {
      const nombreInput = document.getElementById('nombre');
      if (nombreInput) {
        nombreInput.addEventListener('input', () => {
          nombreInput.value = nombreInput.value.replace(/[^a-zA-Z0-9\s.]/g, ''); // Solo letras, números, espacios y punto
          toggleAddButton(); // Actualizar estado del botón
        });
      }
    };

    // Inicializar validaciones
    validateNumericFields();
    validatePrices();
    validateStockRelation();
    validateName();

    // Verificar al cargar la página
    toggleAddButton();
  });
</script>