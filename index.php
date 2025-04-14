<?php
session_start();

$results = "";

if (isset($_SESSION['results'])) {
  $results = $_SESSION['results'];
  unset($_SESSION['results']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Naves</title>
  <link rel="stylesheet" href="extras/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">

</head>

<body>
  <div class="row justify-content-center h-100 align-content-center mb-2">
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <form action="calc.php" id="send" method="POST" onsubmit="handleSubmit()">
            <div class="first-div d-flex flex-column justify-content-center align-items-center">
              <h4 class="pb-2 text-center ">Digite um valor inteiro de MGLT</h4>
              <input type="number" id="" placeholder="Digite um valor" name="mglt_value" class="form-control">
              <button class="btn btn-primary send-mglt" id="send-mglt" type="submit">Enviar</button>
            </div>
          </form>


          <?php
          if (!empty($results) && is_array($results)) {
          ?>
            <table class="table table-hover mt-3 table-striped table-borderless">
              <thead>
                <tr>
                  <th scope="col"><b>Nave</b></th>
                  <th scope="col"><b>MGLT</b></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($results as $starship) {
                  $star = explode('%', $starship)[0];
                  $mglt = explode('%', $starship)[1];
                ?>
                  <tr>
                    <th scope="row"><?= $star ?></th>
                    <td><?= $mglt ?></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>

</html>
