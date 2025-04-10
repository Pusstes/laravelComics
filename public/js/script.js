// Función para buscar productos
function buscarProducto() {
    const searchQuery = document.querySelector('.search-bar input').value;
    alert(`Buscando productos relacionados con: ${searchQuery}`);
}

// Animación de Fade-In al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    const productos = document.querySelectorAll('.producto');
    productos.forEach((producto, index) => {
        producto.style.animation = `fadeInProduct 1s ease-out ${index * 0.2}s forwards`;
    });

    const categorias = document.querySelectorAll('.categoria');
    categorias.forEach((categoria, index) => {
        categoria.style.animation = `fadeInCategory 1s ease-out ${index * 0.2}s forwards`;
    });
});


// tienda.js
document.addEventListener("DOMContentLoaded", () => {
    const botones = document.querySelectorAll(".btn-comprar");

    botones.forEach(boton => {
        boton.addEventListener("click", () => {
            alert("Producto agregado al carrito 🛒");
        });
    });
});
