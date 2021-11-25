

<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input 
        type="text" 
        id="nombre" 
        name="vendedor[nombre]" 
        placeholder="Nombre del vendedor(a)" 
        value="<?php echo s($vendedor->nombre); ?>">
    
    <label for="nombre">Apellido:</label>
    <input 
        type="text" 
        id="apellido" 
        name="vendedor[apellido]" 
        placeholder="Apellido del vendedor(a)" 
        value="<?php echo s($vendedor->apellido); ?>">
    
</fieldset>

<fieldset>
    <legend>Información Extra</legend>

    <label for="telefono">telefono:</label>
    <input 
        type="text" 
        id="telefono" 
        name="vendedor[telefono]" 
        placeholder="Telefono del vendedor/a" 
        value="<?php echo s($vendedor->telefono); ?>">
    
    <label for="telefono">Email:</label>
    <input 
        type="text" 
        id="email" 
        name="vendedor[email]" 
        placeholder="Email del vendedor/a" 
        value="<?php echo s($vendedor->email); ?>">

    <label for="imagen">Imagenes:</label>
        <input 
            type="file" 
            id="imagen" 
            name="vendedor[imagen]" 
            accept="image/jpeg, image/png">
        <?php  if($vendedor->imagen): ?> 
                <img src="../../imagenes/<?php  echo $vendedor->imagen; ?>" class="imagen-small">
        <?php  endif ?> 
    
</fieldset>



