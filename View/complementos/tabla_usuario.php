<?php 

echo ' <tr>
    <td>
    '.$row['id'].'
    </td>
    <td>'.$row['nombre'].'</td>
    <td>'.$row['correo'].'</td>
    <td>'.$row['rol'].'</td>
    <td class="uk-flex">
        <a href="#Update_user" uk-toggle uk-tooltip="title:Editar; delay: 500"
            class="uk-icon-button uk-margin-small-right" type="button"
            style=" border: none; cursor: pointer;">
            <span uk-icon="icon: file-edit"></span>
        </a>
        <a href="#eliminar_user" uk-toggle class="uk-icon-button uk-margin-small-right"
            uk-tooltip="title:Eliminar; delay: 500" type="button"
            style=" border: none; cursor: pointer;" type="button">
            <span uk-icon="icon: trash"></span>
        </a>
    </td>
</tr>';
?>