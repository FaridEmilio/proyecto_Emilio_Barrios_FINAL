<div class="container py-4" style="margin-top: 56px;">
    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>
    <?php if (!empty(session()->getFlashdata('success'))) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif ?>
    <?php if (!empty(session()->getFlashdata('msg'))) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif ?>
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif ?>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="text-center mb-0">Mi carrito</h3>
            </div>
        </div>
        <div class="card-body">
            <div id="cart-empty-message" style="display: none;">
                <p>Tu carrito está vacío, vuelve al catálogo para comprar.</p>
            </div>

            <div class="table-responsive mt-2">
                <table class="table table-sm table-striped text-center" id="users-list">
                    <thead>
                        <tr id="main_heading" style="color: #1D94AC; background-color: #EAF7FD; font-weight: bold;">
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Precio</td>
                            <td>Cantidad</td>
                            <td>Subtotal</td>
                            <td>Eliminar</td>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <?php if (!empty($carrito)) : ?>
                            <?php foreach ($carrito as $item) : ?>
                                <tr>
                                    <td><?= esc($item['id']) ?></td>
                                    <td><?= esc($item['name']) ?></td>
                                    <td>$<?= number_format($item['price'], 2) ?></td>
                                    <td><?= esc($item['qty']) ?></td>
                                    <td>$<?= number_format($item['subtotal'], 2) ?></td>
                                    <td>
                                        <a href="<?= base_url('carrito_elimina/' . $item['rowid']) ?>" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <h4>Total: <span id="total-amount">$ARS 0.00</span></h4>
            </div>
        </div>

        <div class="card-footer">
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-danger" id="btn-empty-cart" disabled>
                    <i class="bi bi-cart-x-fill"></i> Vaciar carrito
                </button>
                <a href="<?php echo base_url('comprar'); ?>" class="btn btn-success" id="btn-confirm-purchase" style="pointer-events: none; opacity: 0.6;">Confirmar compra</a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const cartTableBody = document.getElementById("cart-items");
        const totalAmount = document.getElementById("total-amount");
        const btnEmptyCart = document.getElementById("btn-empty-cart");
        const btnConfirmPurchase = document.getElementById("btn-confirm-purchase");
        const emptyMessage = document.getElementById("cart-empty-message");

        // Función para cargar el carrito desde localStorage
        const loadCart = () => {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];

            // Asegurar que cada producto tenga un qty definido
            cart = cart.map(item => {
                if (!item.qty || isNaN(item.qty)) {
                    item.qty = 1; // Asignar 1 si no existe o es inválido
                }
                return item;
            });

            // Guardar el carrito corregido en localStorage
            localStorage.setItem("cart", JSON.stringify(cart));

            return cart;
        };

        // Función para guardar el carrito en localStorage
        const saveCart = (cart) => localStorage.setItem("cart", JSON.stringify(cart));

        // Función para actualizar el estado de los botones según el carrito
        const toggleButtons = (hasItems, validQuantities = true) => {
            btnEmptyCart.disabled = !hasItems;
            btnConfirmPurchase.style.pointerEvents = hasItems && validQuantities ? "auto" : "none";
            btnConfirmPurchase.style.opacity = hasItems && validQuantities ? "1" : "0.6";
        };

        // Función para renderizar el carrito en la tabla
        const renderCart = () => {
            const cartData = loadCart();
            cartTableBody.innerHTML = ""; // Limpia la tabla
            let total = 0;

            if (cartData.length === 0) {
                emptyMessage.style.display = "block";
                toggleButtons(false);
                totalAmount.textContent = "$ARS 0.00";
                return;
            }

            emptyMessage.style.display = "none";

            cartData.forEach((item, index) => {
                const quantity = item.qty || 1;

                const subtotal = item.price * quantity;
                total += subtotal;

                const row = `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>$${parseFloat(item.price).toFixed(2)}</td>
                        <td>
                            <input type="number" 
                                   min="1" 
                                   value="${quantity}" 
                                   placeholder="1" 
                                   class="form-control qty-input" 
                                   data-index="${index}">
                        </td>
                        <td class="subtotal-cell">$${subtotal.toFixed(2)}</td>
                        <td>
                            <button class="btn btn-sm btn-danger btn-remove-item" data-index="${index}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                cartTableBody.insertAdjacentHTML("beforeend", row);
            });

            totalAmount.textContent = `$ARS ${total.toFixed(2)}`;
            validateQuantities(); // Validar las cantidades después de renderizar
            toggleButtons(true);
        };

        // Función para validar que todas las cantidades sean válidas
        const validateQuantities = () => {
            const qtyInputs = document.querySelectorAll(".qty-input");
            let validQuantities = true;

            qtyInputs.forEach((input) => {
                const value = parseInt(input.value, 10);
                if (value <= 0 || isNaN(value) || input.value === "") {
                    validQuantities = false;
                }
            });

            toggleButtons(true, validQuantities);
        };

        // Evento para el botón Confirmar Compra
        btnConfirmPurchase.addEventListener("click", (e) => {
            e.preventDefault();
            const cartData = loadCart();

            if (cartData.length === 0) {
                alert("No hay productos en el carrito para confirmar la compra.");
                return;
            }

            // Crear un formulario temporal
            const form = document.createElement("form");
            form.method = "POST";
            form.action = "<?php echo base_url('comprar'); ?>"; // Acción correcta al controlador

            // Añadir datos del carrito
            const inputCart = document.createElement("input");
            inputCart.type = "hidden";
            inputCart.name = "cart_data";
            inputCart.value = JSON.stringify(cartData);

            form.appendChild(inputCart);
            document.body.appendChild(form);
            form.submit();
        });

        // Función para actualizar dinámicamente los subtotales y el total
        const updateDynamicCalculations = () => {
            const cartData = loadCart();
            let total = 0;

            document.querySelectorAll(".qty-input").forEach((input) => {
                const index = input.dataset.index;
                const newQty = parseInt(input.value, 10) || 1; // Si es NaN, usar 1
                const row = input.closest("tr");
                const subtotalCell = row.querySelector(".subtotal-cell");

                cartData[index].qty = newQty; // Actualizar cantidad en el carrito
                const newSubtotal = cartData[index].price * newQty; // Calcular nuevo subtotal
                subtotalCell.textContent = `$${newSubtotal.toFixed(2)}`; // Actualizar subtotal en la vista
                total += newSubtotal; // Acumular el total
            });

            totalAmount.textContent = `$ARS ${total.toFixed(2)}`; // Actualizar el total general
            saveCart(cartData); // Guardar el carrito actualizado en localStorage
        };

        // Evento para vaciar el carrito
        btnEmptyCart.addEventListener("click", () => {
            if (confirm("¿Estás seguro de que deseas vaciar el carrito?")) {
                localStorage.removeItem("cart");
                renderCart(); // Vuelve a renderizar el carrito vacío
            }
        });

        // Evento para eliminar un producto del carrito
        cartTableBody.addEventListener("click", (e) => {
            if (e.target.closest(".btn-remove-item")) {
                const index = e.target.closest(".btn-remove-item").dataset.index;
                const cartData = loadCart();

                cartData.splice(index, 1); // Eliminar el producto del carrito
                saveCart(cartData);
                renderCart(); // Vuelve a renderizar el carrito
            }
        });

        // Evento dinámico para detectar cambios en la cantidad
        cartTableBody.addEventListener("input", (e) => {
            if (e.target.classList.contains("qty-input")) {
                validateQuantities(); // Validar cantidades al cambiar
                updateDynamicCalculations(); // Recalcular subtotal y total en tiempo real
            }
        });

        // Cargar y renderizar el carrito al inicio
        renderCart();
    });
</script>


<style>
    .qty-input {
        width: 90px;
        /* Ajusta el ancho según lo que necesites */
        text-align: center;
        /* Centra el texto dentro del input */
    }
</style>