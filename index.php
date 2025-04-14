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
  <div class="col-4 mt-4 ms-4 mb-2">
    <form action="calc.php" id="send" method="POST" onsubmit="handleSubmit()">
      <div class="first-div">
        <small class="text-white pb-2">Digite um valor inteiro de MGLT</small>
        <input type="number" id="" placeholder="Digite um valor" name="mglt_value">
        <button class="btn btn-sm btn-secondary send-mglt" id="send-mglt" type="submit">Enviar</button>
      </div>
    </form>

    <?php
    if (!empty($results) && is_array($results)) {
    ?>
      <table class="table table-hover mt-3">
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
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>

</html>