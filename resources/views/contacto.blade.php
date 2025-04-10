@extends('layouts.plantillaUsu')
@section('Titulo', 'Contacto')

@section('css-index')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<style>
    body {
        color: black;
        background-color: #222;
    }

    h1, h2, h3, p {
        color: white;
    }

    a {
        color: white;
        text-decoration: none;
    }

    .faq {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background: rgb(49, 42, 42);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .faq-item {
        margin-bottom: 10px;
    }

    .faq-question {
        width: 100%;
        text-align: left;
        background: #ff5733;
        color: white;
        border: none;
        padding: 15px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 5px;
        transition: background 0.3s ease;
    }

    .faq-question:hover {
        background: #c70039;
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        padding: 0 10px;
        background: black;
        border-left: 4px solid #ff5733;
        border-radius: 5px;
        margin-top: 5px;
        opacity: 0;
        transform: translateY(-10px);
        transition: max-height 0.5s ease, opacity 0.5s ease, transform 0.5s ease;
    }

    .faq-answer.active {
        max-height: 200px;
        opacity: 1;
        transform: translateY(0);
        padding: 10px;
    }

    .faq-question.open i {
        transform: rotate(180deg);
        transition: transform 0.3s ease;
    }

    .success-message {
        display: none;
        padding: 15px;
        background: #28a745;
        color: white;
        text-align: center;
        margin-top: 10px;
        border-radius: 5px;
    }

    nav ul li a {
        color: white;
    }

</style>
@endsection

@section('contenidoContacto')
<section class="contacto">
    <h2>📩 <span>Contacto</span></h2>
    <form action="php/enviar_mensaje.php" method="POST" id="contactForm">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" required></textarea>

        <button type="submit" class="btn-enviar"><i class="fas fa-paper-plane"></i> Enviar Mensaje</button>
    </form>
    <div class="success-message" id="successMessage">✅ ¡Mensaje enviado con éxito!</div>
</section>

<section class="faq">
    <h2>❓ Preguntas Frecuentes</h2>
    <div class="faq-item">
        <button class="faq-question">¿Cuánto tarda el envío de los cómics? <i class="fas fa-chevron-down"></i></button>
        <div class="faq-answer">El tiempo estimado de envío es de 3 a 7 días hábiles.</div>
    </div>
    <div class="faq-item">
        <button class="faq-question">¿Qué métodos de pago aceptan? <i class="fas fa-chevron-down"></i></button>
        <div class="faq-answer">Aceptamos tarjetas de crédito, débito y PayPal.</div>
    </div>
    <div class="faq-item">
        <button class="faq-question">¿Puedo devolver un cómic si no me gustó? <i class="fas fa-chevron-down"></i></button>
        <div class="faq-answer">Sí, aceptamos devoluciones dentro de los primeros 14 días después de la compra.</div>
    </div>
    <div class="faq-item">
        <button class="faq-question">¿Ofrecen suscripciones mensuales? <i class="fas fa-chevron-down"></i></button>
        <div class="faq-answer">Sí, ofrecemos suscripciones con descuentos y acceso a ediciones especiales.</div>
    </div>
    <div class="faq-item">
        <button class="faq-question">¿Tienen tienda física? <i class="fas fa-chevron-down"></i></button>
        <div class="faq-answer">Sí, nuestra tienda se encuentra en el centro de la ciudad.</div>
    </div>
</section>

<script>
    document.querySelectorAll('.faq-question').forEach(button => {
        button.addEventListener('click', () => {
            const answer = button.nextElementSibling;
            answer.classList.toggle('active');
            button.classList.toggle('open');
        });
    });

    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault();
        let nombre = document.getElementById('nombre').value.trim();
        let email = document.getElementById('email').value.trim();
        let mensaje = document.getElementById('mensaje').value.trim();
        if (nombre === '' || email === '' || mensaje === '') {
            alert('Por favor, completa todos los campos antes de enviar.');
        } else {
            document.getElementById('successMessage').style.display = 'block';
            setTimeout(() => {
                document.getElementById('successMessage').style.display = 'none';
            }, 3000);
            document.getElementById('contactForm').reset();
        }
    });
</script>
@endsection
