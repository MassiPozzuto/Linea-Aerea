<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f8f8;
        color: #333;
        line-height: 1.6;
    }

    section {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #ecf0f1;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 20px;
        transition: transform 0.3s;
    }

    section:hover {
        transform: scale(1.05);
    }

    img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-top: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #2c3e50;
        border-bottom: 2px solid #2c3e50;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    p {
        color: #555;
        margin-bottom: 15px;
    }

    footer {
        text-align: center;
        padding: 10px;
        background-color: #2c3e50;
        color: white;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>
<section>
    <h2>Menú Principal</h2>
    <p>Descubre nuestras deliciosas opciones de comida a bordo.</p>
    <?php foreach ($menuPrincipal as $plato) : ?>
        <p><?= $plato ?></p>
    <?php endforeach; ?>
</section>

<section>
    <h2>Fotos de los platos</h2>
    <?php foreach ($galeriaFotos as $foto) : ?>
        <img src="<?= $foto ?>" alt="Foto">
    <?php endforeach; ?>
</section>