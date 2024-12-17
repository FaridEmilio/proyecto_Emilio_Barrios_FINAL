<div class="container py-4" style="margin-top: 20px;">
    <?php
    $session = session();
    $nombre = $session->get('nombre');
    $perfil = $session->get('perfil_id');
    $id = $session->get('id');
    ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php elseif (session()->getFlashdata('fail')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif; ?>

    <?php if (!$productos) { ?>
        <div class="container py-4" style="margin-top: 60px; margin-bottom: 280px">
            <div class="text-center">
                <h2>Productos no encontrados. Por favor vuelva más tarde</h2>
            </div>
        </div>
    <?php } else { ?>
        <!-- Input del buscador -->
        <div class="container" style="margin-top: 80px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar productos..." />
        </div>

        <!-- Categorías -->
        <div class="container-categories">
            <p><a class="btn category-btn mt-2" href="<?php echo base_url('Mantequilla'); ?>">Mantequilla</a></p>
            <p><a class="btn category-btn mt-2" href="<?php echo base_url('Snack'); ?>">Snack</a></p>
            <p><a class="btn category-btn mt-2" href="<?php echo base_url('Cafe'); ?>">Café</a></p>
            <p><a class="btn category-btn mt-2" href="<?php echo base_url('Otros'); ?>">Otros</a></p>
            <p><a class="btn category-btn mt-2" href="<?php echo base_url('catalogo'); ?>">Todos</a></p>
        </div>

        <!-- Productos -->
        <section class="container top-products mt-3">
            <div class="container-products" id="productContainer">
                <?php foreach ($productos as $index => $prod) : ?>
                    <?php if ($prod['eliminado'] == 'NO') : ?>
                        <div class="card-product" data-nombre="<?php echo strtolower($prod['nombre']); ?>">
                            <div class="container-img">
                                <img src="<?php echo base_url('assets/uploads/' . $prod['imagen']); ?>">
                            </div>
                            <div class="content-card-product">
                                <h3><?php echo $prod['nombre']; ?></h3>
                                <p class="price">$<?php echo $prod['precio_vta']; ?></p>
                            </div>
                            <div>
                                <?php if ($prod['stock'] == 0) {
                                    echo 'Sin unidades disponibles';
                                } else {
                                    echo $prod['stock'] . ' unidades disponibles';
                                } ?>
                            </div>
                            <div>
                                <span
                                    class="add-cart d-flex align-items-center gap-2"
                                    role="button"
                                    data-product-id="<?php echo $prod['id']; ?>"
                                    data-product-name="<?php echo $prod['nombre']; ?>"
                                    data-product-price="<?php echo $prod['precio_vta']; ?>">
                                    Comprar <i class="fa-solid fa-basket-shopping"></i>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Mensaje si no se encuentran resultados -->
            <div class="text-center mt-4" id="noResultsMessage" style="display: none;">
                <h4>No hay productos que coincidan con tu búsqueda</h4>
                <p>Revisá la ortografía de la palabra.</p>
                <a href="<?php echo base_url('catalogo'); ?>">Navegá por las categorías</a>
            </div>
        </section>

        <!-- Botón flotante Ver Carrito -->
        <a href="<?= base_url('CarritoList') ?>" id="viewCartButton" class="btn btn-primary">
            <i class="fa fa-shopping-cart"></i> Ver Carrito
            <span id="cart-count" class="badge bg-danger rounded-pill">0</span>
        </a>
    <?php } ?>
</div>

<!-- Script para el buscador -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const cartData = JSON.parse(localStorage.getItem("cart")) || [];

        if (cartData.length > 0) {
            fetch("<?php echo base_url('Carrito_sync'); ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        cart: cartData
                    }),
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        console.log("Carrito sincronizado con el servidor.");
                    } else {
                        console.error("Error al sincronizar el carrito:", data.message);
                    }
                })
                .catch((error) => console.error("Error en la sincronización:", error));
        }
    });


    document.addEventListener("DOMContentLoaded", () => {
        const cartCount = document.getElementById("cart-count");
        const addCartButtons = document.querySelectorAll(".add-cart");
        const searchInput = document.getElementById("searchInput");
        const productContainer = document.getElementById("productContainer");
        const noResultsMessage = document.getElementById("noResultsMessage");
        const products = productContainer.querySelectorAll(".card-product");

        // Actualizar contador del carrito
        const updateCartCount = () => {
            const cartItems = JSON.parse(localStorage.getItem("cart")) || [];
            cartCount.textContent = cartItems.length;
        };

        // Añadir al carrito
        addCartButtons.forEach(button => {
            button.addEventListener("click", () => {
                const productId = button.dataset.productId;
                const productName = button.dataset.productName;
                const productPrice = button.dataset.productPrice;

                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                const existingProduct = cart.find(item => item.id === productId);

                if (!existingProduct) {
                    cart.push({
                        id: productId,
                        name: productName,
                        price: productPrice
                    });
                    localStorage.setItem("cart", JSON.stringify(cart));
                    alert(`Producto "${productName}" añadido al carrito.`);
                } else {
                    alert("Este producto ya está en el carrito.");
                }

                updateCartCount();
            });
        });

        // Filtrar productos
        searchInput.addEventListener("input", () => {
            const searchTerm = searchInput.value.toLowerCase();
            let hasResults = false;

            products.forEach(product => {
                const productName = product.getAttribute("data-nombre");
                if (productName.includes(searchTerm)) {
                    product.style.display = "block";
                    hasResults = true;
                } else {
                    product.style.display = "none";
                }
            });

            noResultsMessage.style.display = hasResults ? "none" : "block";
        });

        // Inicializar contador
        updateCartCount();
    });

    document.addEventListener("DOMContentLoaded", () => {
        const searchInput = document.getElementById("searchInput");
        const productContainer = document.getElementById("productContainer");
        const noResultsMessage = document.getElementById("noResultsMessage");
        const products = productContainer.querySelectorAll(".card-product");

        searchInput.addEventListener("input", () => {
            const searchTerm = searchInput.value.toLowerCase();
            let hasResults = false;

            products.forEach(product => {
                const productName = product.getAttribute("data-nombre");
                if (productName.includes(searchTerm)) {
                    product.style.display = "block";
                    hasResults = true;
                } else {
                    product.style.display = "none";
                }
            });

            // Mostrar u ocultar mensaje de "sin resultados"
            if (hasResults) {
                noResultsMessage.style.display = "none";
            } else {
                noResultsMessage.style.display = "block";
            }
        });
    });
</script>

<style>
    #viewCartButton {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        background-color: black;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 50px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
    }

    #viewCartButton:hover {
        background-color: #555;
        transform: scale(1.1);
    }

    #cart-count {
        font-size: 14px;
        color: white;
    }

    /* Estilo base para la barra de botones */
    .container-categories {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 3rem;
        padding: 3rem 0;
        flex-wrap: wrap;
        /* Permite que los elementos bajen a una nueva fila si no hay espacio */
    }

    /* Botones */
    .category-btn {
        background-color: black;
        color: white;
        border: 2px solid black;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        text-transform: uppercase;
        text-align: center;
        transition: all 0.3s ease-in-out;
    }

    .category-btn:hover {
        background-color: white;
        color: black;
        border-color: black;
        transform: scale(1.05);
        /* Aumenta ligeramente el tamaño al pasar el cursor */
    }

    .category-btn:focus {
        outline: none;
        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.7);
        /* Sombra al seleccionar */
    }

    /* Responsive para pantallas más pequeñas */
    @media (max-width: 768px) {
        .container-categories {
            flex-direction: column;
            /* Cambia la orientación a vertical */
            gap: 1.5rem;
            /* Reduce el espacio entre botones */
            padding: 2rem 1rem;
            /* Ajusta el padding */
        }

        .category-btn {
            width: 100%;
            /* Los botones ocupan todo el ancho */
            max-width: 300px;
            /* Máximo ancho para evitar que sean demasiado grandes */
            text-align: center;
        }
    }
</style>