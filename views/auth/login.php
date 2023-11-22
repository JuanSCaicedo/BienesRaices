<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <div class="contenedor-centrado alerta-mensaje">
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    </div>

    <form method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>
            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu correo" id="email">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu contraseña" id="password">
        </fieldset>
        <div class="contenedor-nuevo">
            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </div>

    </form>
</main>