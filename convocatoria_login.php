<?php
include_once('./configuracion_sistema/configuracion.php');
include_once('./librerias/PDOConsultas.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Convocatorias</title>
  <link href="../css_sistema/estiloslogin.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
  a {
    text-decoration: none;
    color: black;
  }

  a:hover {
    color: #07d544;
    cursor: pointer;
  }

  .ventana {
    background: rgba(254, 254, 254, 1);
    width: 30%;
    color: rgba(255, 255, 255, 1);
    font-family: Arial, Helvetica, sans-serif;
    font-size: 18px;
    text-align: center;
    padding: 33px;
    min-height: 250px;
    border-radius: 22px;
    position: absolute;
    left: 34%;
    top: 10%;
    display: none;
    box-shadow:
      inset 0 -3em 3em rgba(0, 0, 0, 0.0),
      0 0 0 2px rgb(254, 254, 254),
      0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
  }

  #cerrar {
    position: absolute;
    right: 3px;
    top: 1px;
  }
</style>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static mx-5" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
  <div class="app-content content ">
    <div class="content-wrapper">
      <div class="content-body ">
        <div class="auth-wrapper auth-cover">

          <div class="align-self-center my-4" style="width:100%; justify-content: space-around; display: flex; box-shadow:
            inset 0 -3em 3em rgba(0,0,0,0.0),
             0 0  0 2px rgb(255,255,255),
             0.3em 0.3em 1em rgba(0,0,0,0.3);">

            <a class="brand-logo" href="#">
              <img src="imagenes_sistema/desiciones.jpg" width="28%">
              <h2 class="brand-text text-primary ms-1" style="color: black;"></h2>
              <div style="width:40%;"></div>
            </a>
            <div class="align-self-center">
              <a href="./convocatoria_login.php" class="p-5">Convocatorias</a>
              <a href="./gacetas_login.php" class="p-5">Gacetas</a>
              <a href="./login.php" class="p-5">Inicio</a>
            </div>
          </div>

        </div>
        <br>
        <?php

        $consulta = new PDOConsultas();
        $consulta->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0], $CFG_TIPO[0]);

        $consulta2 = new PDOConsultas();
        $consulta2->connect($CFG_HOST[0], $CFG_USER[0], $CFG_DBPWD[0], $CFG_DBASE[0]);
        $select = $consulta2->executeQuery("SELECT CCveCon,CNombre,file_oficio FROM convocatoria");



        ?>
        <section id="card-demo-example">
          <div class="row match-height">
            <?php

            for ($i = 0; $i < count($select); $i++) {
              $CCveCon = $select[$i]['CCveCon'];
              $CNombre = $select[$i]['CNombre'];
              $file_oficio = $select[$i]['file_oficio'];
            ?>

              <div class="col-md-6 col-lg-4">
                <div class="card">

                  <div class="card-body">
                    <h4 class="card-title"> <?php echo ($CNombre); ?></h4>

                    <iframe src="<?php echo ($file_oficio); ?>" style="width:100%; height:100%;" frameborder="0"></iframe>


                    <a href="javascript:abrir('<?php echo ($file_oficio); ?>')" class="btn btn-outline-primary">Mostrar convocatoria</a>
                  </div>
                </div>
                <br>
              </div>



            <?php  }
            ?>
            <div class="ventana" id="venta">
              <div id="cerrar"><a href="javascript:cerrar()"><img src="./imagenes_sistema/eliminar.png" alt="" height="30px"></a></div>
              <embed id="documento" src="" type="application/pdf" width="100%" height="600px" />


            </div>
          </div>
        </section>


   


      </div>
    </div>

  </div>
  </div>

  <script language=javascript>
    function abrir(URL) {
      document.getElementById("venta").style.display = "block"
      document.getElementById("documento").src = URL;
      document.getElementById('mostrardoc').onclick = function ventanaSecundaria() {
        window.open(URL, "ventana1", "width=800%,height=800%,scrollbars=NO")
      }
    }

    function cerrar() {
      document.getElementById("venta").style.display = "none"

    }
  </script>
  

</body>

</html>