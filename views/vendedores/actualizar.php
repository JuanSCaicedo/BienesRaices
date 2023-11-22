<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>

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

    <form class="formulario" method="POST">
        <?php include 'formulario.php'; ?>
        <div class="contenedor-nuevo">
            <input type="submit" value="Guardar Cambios" class="boton boton-verde">
        </div>
    </form>

</main>