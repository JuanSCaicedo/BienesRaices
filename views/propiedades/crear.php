<main class="contenedor seccion">
    <h1>Crear</h1>

    <div class="contenedor-nuevo">
        <a href="/admin" class="boton boton-verde">Volver</a>
    </div>

    <div class="contenedor-centrado alerta-mensaje">
        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>

        <div class="contenedor-nuevo">
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </div>
    </form>

</main>