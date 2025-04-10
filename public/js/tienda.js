document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".producto a").forEach((producto) => {
        producto.addEventListener("click", (e) => {
            e.preventDefault();
            window.location.href = producto.getAttribute("href");
        });
    });
});

