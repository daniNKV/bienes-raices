

<fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input 
                    type="text" 
                    id="titulo" 
                    name="propiedad[titulo]" 
                    placeholder="Titulo de la Propiedad" 
                    value="<?php echo s($propiedad->titulo); ?>">
                
                <label for="precio">Precio</label>
                <input 
                    type="number" 
                    id="precio" 
                    name="propiedad[precio]"
                    placeholder="Precio de la Propiedad" 
                    value="<?php echo s($propiedad->precio); ?>">
                
                <label for="imagen">Imagenes:</label>
                <input 
                    type="file" 
                    id="imagen" 
                    name="propiedad[imagen]" 
                    accept="image/jpeg, image/png">

                    <?php if($propiedad->imagen): ?> 
                            <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small">
                    <?php endif ?>

                <label for="descripcion" >Descripción:</label>
                <textarea 
                    id="descripcion" 
                    name="propiedad[descripcion]" 
                    value="<?php echo s($propiedad->descripcion); ?>">
                </textarea>

            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input 
                    type="number" 
                    id="habitaciones" 
                    name="propiedad[habitaciones]" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo s($propiedad->habitaciones); ?>">
               
                <label for="wc">Baños:</label>
                <input 
                    type="number" 
                    id="wc" 
                    name="propiedad[wc]" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo s($propiedad->wc); ?>">
                
                <label for="estacionamiento">Estacionamiento:</label>
                <input 
                    type="number" 
                    id="estacionamiento" 
                    name="propiedad[estacionamiento]" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="99" 
                    value="<?php echo s($propiedad->estacionamiento); ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor/es</legend>
                        <select name="propiedad[vendedor_ID]" id="vendedor_ID" >
                            <option value="1">roxanne</option>
                        </select>

                </select>
            </fieldset>