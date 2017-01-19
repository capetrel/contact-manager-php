<?php
include '../includes/inc.contacts.top.php';
include 'contact.db.php';
include '../helpers.php';

$errors = [];
$contact = [
  'id' => '',
  'firstname' => '',
  'lastname' => '',
  'email' => '',
  'tel' => '',
  'web' => '',
];

//si POST n'est pas vide et est initialisé On récupère les données
if(!empty($_POST) && isset($_POST['add-contact'])){

  // on initialise un tableau pour mettre les éléments qu'on à récupérés
  $contact = [
    // on crée une clé => on lit la valeur associée
    'id' => '',
    'firstname' => Rec($_POST['firstname']),
    'lastname' => Rec($_POST['lastname']),
    'email' => Rec($_POST['email']),
    'tel' => Rec($_POST['tel']),
    'web' => Rec($_POST['web']),
  ];

  // on traite les données
  $errors = validateContact($contact);

  // si il n'y a pas d'erreur on ajoute le contact et on retourne à la page list
  if(count($errors) == 0){
      addContact($contact);
      header("location: list.php?p=".$_GET['p']);

  }

}

?>

  <div class="container">
    <h1>Ajouter un contact</h1>
     <a class="btn btn-success" href="list.php">Retour à la liste</a>
     <br>
     <br>
  </div>

  <div class="container">

    <form class="form-horizontal" method="post">

      <span class="help-block" style="color: red"><strong><?= errorMessage($errors, 'exist_mail'); ?></strong></span>

      <div class="form-group <?= errorClass($errors, 'lastname'); ?>">
        <label type="text" for="firstname" class="col-sm-2 control-label">Prénom :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="firstname" name="firstname" value="<?= Rec($contact['firstname']); ?>" >
          <span class="help-block"><?= errorMessage($errors, 'firstname'); ?></span>
        </div>
      </div>

      <div class="form-group <?= errorClass($errors, 'lastname'); ?>">
        <label type="text" for="lastname" class="col-sm-2 control-label">Nom :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="lastname" name="lastname" value="<?= Rec($contact['lastname']); ?>" >
          <span class="help-block"><?= errorMessage($errors, 'lastname'); ?></span>
        </div>
      </div>

      <div class="form-group <?= errorClass($errors, 'email'); ?>">
        <label type="email" for="email" class="col-sm-2 control-label">Email :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="email" name="email" value="<?= Rec($contact['email']); ?>"  placeholder="mail@domaine.fr">
          <span class="help-block"><?= errorMessage($errors, 'email'); ?></span>
        </div>
      </div>

      <div class="form-group <?= errorClass($errors, 'tel'); ?>">
        <label type="text" for="tel" class="col-sm-2 control-label">Téléphone :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tel" name="tel" value="<?= Rec($contact['tel']); ?>" >
          <span class="help-block"><?= errorMessage($errors, 'tel'); ?></span>
        </div>
      </div>

      <div class="form-group">
        <label type="text" for="web" class="col-sm-2 control-label">Url web :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="web" name="web" value="<?= Rec($contact['web']); ?>" placeholder="http://"> <!-- pattern="^http:\/\/(.*)$" -->
        </div>
      </div>

      <button type="submit" class="btn btn-info" name="add-contact">Ajouter un contact</button>

</form>

</div>
  <?php include '../includes/inc.contacts.bottom.php'; ?>
