<?php
if (isset($_GET['term'])) {
    $con = @mysqli_connect("localhost", "root", "", "dbsectorauxiliar");
    $return_arr = array();
    if ($con) {
       //echo "SELECT * FROM sb_persona where  rfc like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' LIMIT 0 ,50";
        $fetch = mysqli_query($con, "SELECT * FROM sb_persona where  rfc like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' LIMIT 0 ,50");
        /* Recuperar y almacenar en conjunto los resultados de la consulta.*/
        while ($row = mysqli_fetch_array($fetch)) {
            $cve_persona = $row['cve_persona'];
            $row_array['value'] = $row['rfc'] . " | " . $row['nombre'] . " | " . $row['apellido_paterno'] . " | " . $row['apellido_materno']. " | " . $row['curp'];
            $row_array['cve_persona'] = $row['cve_persona'];
            $row_array['rfc'] = $row['rfc'];
            $row_array['nombre'] = $row['nombre'];
            $row_array['apellido_paterno'] = $row['apellido_paterno'];
            $row_array['apellido_materno'] = $row['apellido_materno'];
            $row_array['curp'] = $row['curp'];
            $row_array['cve_sexo'] = $row['cve_sexo'];
            $row_array['cve_profesion'] = $row['cve_profesion'];
            $row_array['cve_estado_origen'] = $row['cve_estado_origen'];
            $row_array['cve_municipio_origen'] = $row['cve_municipio_origen'];
            $row_array['cve_estado_actual'] = $row['cve_estado_actual'];
            $row_array['cve_municipio_actual'] = $row['cve_municipio_actual'];
            $row_array['domicilio_actulizado'] = $row['domicilio_actulizado'];
            $row_array['cve_hijos'] = $row['cve_hijos'];
            $row_array['issemym'] = $row['issemym'];
            $row_array['ine'] = $row['ine'];
            $row_array['telefono'] = $row['telefono'];
            $row_array['extension'] = $row['extension'];
            array_push($return_arr, $row_array);
        }
    }
    mysqli_close($con);
    echo json_encode($return_arr);
}
