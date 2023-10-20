<section class="quienes-somos">
    <div id="div1">
        <div id="div3" class="">
            ¿Quienes somos?<span class="flecha"><i class="bi bi-caret-down-fill"></i></span>
        </div>
        <div id="div2" class="">
            Somos una aerolinea, dedicada a brindar asesoramiento integral en el rubro.
            Nacimos con el sueño de ofrecer a los viajeros toda nuestra experiencia y capacidad en el área, brindando un servicio de alta calidad y adaptándonos a las exigencias de hoy.
            Contamos con una amplia variedad de ofertas y paquetes turísticos personalizados que el cliente podrá evaluar y cotizar a través de nuestro sitio web o realizar consultas y dejar opiniones por nuestras redes sociales, respondiendo de manera inmediata a los requerimientos de los clientes.
            Nuestra empresa está totalmente orientada hacia las necesidades del cliente, teniendo en cuenta sus preferencias y cultura.
            Priorizamos siempre su seguridad y que sea una estadía memorable, por eso le ofrecemos comodidad y conveniencia económica en todo momento.
            Valores: La capacitación, dedicación y óptima predisposición son las razones principales por las que esta agencia de viajes se ha desarrollado como una empresa singular y diferente al resto. 
            La innovación permanente, la creatividad y la orientación al cliente son valores fundamentales que plasmamos en nuestra forma de trabajar, persiguiendo el objetivo de marcar la diferencia en todo momento.
            Misión: nuestro objetivo es obtener la satisfacción y superar las expectativas de los clientes para seguir creciendo. Estamos convencidos de que cada tarea debe estar dirigida a dar respuesta a la confianza que ellos depositan en nosotros.
            Visión: queremos ser la agencia de viajes líder en Argentina distinguida por la atención personalizada al cliente y la garantía de un viaje memorable en familia, en pareja o con amigos.
            Ponemos a su disposición la solución integral para hacer de sus viajes por Argentina y el resto del mundo una experiencia única. Por ello, contamos con la infraestructura y la tecnología adecuada para responder de manera ágil a la demanda de los viajeros
            Si su anhelo es vivir momentos maravillosos, confié en nosotros y prepárese para disfrutar de viajes inolvidables.
        </div>
    </div>

    <script>
        $("#div3").click(function(e) {
            const div2 = document.getElementById('div2');
            const div3 = document.getElementById('div3');
            if (div2.classList.contains("active")) {

                div2.classList.remove("active")
                div3.classList.remove("actionated")
                $("#div2").slideUp(200)
                document.querySelector('.flecha').innerHTML = '<i class="bi bi-caret-down-fill"></i>';
            } else {
                $("#div2").slideDown(250)
                div2.classList.add("active")
                div3.classList.add("actionated")
                document.querySelector('.flecha').innerHTML = '<i class="bi bi-caret-up-fill"></i>';
            }
        })
    </script>

</section>