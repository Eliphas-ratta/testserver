<?php

require_once("../inc/init.php");

if($_POST) {

    $id = $_POST["id_order"];
    $state = $_POST["state"];

    $count = $pdo->exec("UPDATE orders SET state = '$state' WHERE id = '$id' ");

    if($count > 0) {
        $msg = "<div class='alert alert-success'>
            Votre commande n° $id a été mise à jour !
        </div>";
    }

}


$stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");

require_once("inc/header.php");

?>

<h1 class="mb-5 text-center">Welcome to the management of your orders in the backOffice</h1>

<?= $msg ?>

<form class="row col-md-12 align-items-center justify-content-center m-5" method="get" action="">
    <select class="form-control col-md-4" name="state">

        <option value="none">Filtrer par état</option>
        <option value="in progress">En cours de traitement</option>
        <option value="sent">Envoyé</option>
        <option value="delivered">Livré</option>
    
    </select>

    <p class="text-center mb-0 mr-3 ml-3">Ou</p>

    <input type="text" name="id_order" class="form-control col-md-4" placeholder="Chercher une commande par son numéro" id="">

</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">id_order</th>
      <th scope="col">id_member</th>
      <th scope="col">amount</th>
      <th scope="col">date</th>
      <th scope="col">state</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $key => $order) {?>
        <tr>
          <td><?= $order["id"]; ?></td>
          <td><?= $order["member_id"]; ?></td>
          <td><?= $order["amount"]; ?></td>
          <td><?= $order["created_at"]; ?></td>
          <td>
            
            <form method="POST" action="">
                <input type="hidden" name="id_order" value="<?= $order["id"]; ?>">
                <select name="state" id="">
                    <option 
                    value="in progress" 
                    <?= $order["state"] == "in progress" ? "selected" : "" ?>
                    >En cours de traitement</option>

                    <option 
                    value="sent" 
                    <?= $order["state"] == "sent" ? "selected" : "" ?>
                    >Envoyé</option>

                    <option 
                    value="delivered" 
                    <?= $order["state"] == "delivered" ? "selected" : "" ?>
                    >Livré</option>
                </select>
            </form>

          </td>
        </tr>
    <?php } ?>


  </tbody>
</table>




<?php

require_once("inc/footer.php");

?>