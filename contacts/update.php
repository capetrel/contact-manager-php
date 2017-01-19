<?php
include '../includes/inc.contacts.top.php';
include 'contact.db.php';
include '../helpers.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $contact = getOneContact($id);
}

$errors = [];
$contact_update = [
  'id' => '',
  'firstname' => '',
  'lastname' => '',
  'email' => '',
  'tel' => '',
  'web' => '',
];

// On récupère les champs de formulaires et leur valeurs
if(!empty($_POST) && isset($_POST['update-contact'])){

  // on initialise un tableau pour mettre les éléments qu'on à récupérés
  $contact_update = [
    // on crée une clé => on lit la valeur associée
    'id' => $contact['id'],
    'firstname' => Rec($_POST['firstname']),
    'lastname' => Rec($_POST['lastname']),
    'email' => Rec($_POST['email']),
    'tel' => Rec($_POST['tel']),
    'web' => Rec($_POST['web']),
  ];

  $errors = validateUpdateContact($contact);

  if(count($errors) == 0){

      updateContact($contact_update);
      header("location: list.php?p=".$_GET['p']);
  }

}

?>

  <div class="container">
    <h1>Fiche du contact</h1>
     <a class="btn btn-success" href="list.php">Retour à la liste</a>
     <br>
     <br>
  </div>

  <div class="container">
    <form class="form-horizontal" method="post" name=view-contact>

        <div class="form-group <?= errorClass($errors, 'firstname'); ?>">
        <label type="text" for="firstname" class="col-sm-2 control-label">Prénom :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="firstname" name="firstname" value="<?= Rec($contact['firstname']); ?>">

        </div>
      </div>

        <div class="form-group <?= errorClass($errors, 'lastname'); ?>">
        <label type="text" for="lastname" class="col-sm-2 control-label">Nom :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="lastname" name="lastname" value="<?= Rec($contact['lastname']); ?>">
        </div>
      </div>

        <div class="form-group <?= errorClass($errors, 'email'); ?>">
        <label type="text" for="email" class="col-sm-2 control-label">Email :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="email" name="email" value="<?= Rec($contact['email']); ?>">
        </div>
      </div>

        <div class="form-group <?= errorClass($errors, 'tel'); ?>">
        <label type="text" for="tel" class="col-sm-2 control-label">Téléphone :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="tel" name="tel" value="<?= Rec($contact['tel']); ?>">
        </div>
      </div>

        <div class="form-group <?= errorClass($errors, 'web'); ?>">
        <label type="text" for="web" class="col-sm-2 control-label">Url web :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="web" name="web" value="<?= Rec($contact['web']); ?>" placeholder="http://">
        </div>
      </div>
    <button type="submit" class="btn btn-info" name="update-contact">Enregistrer</button>
</form>

</div>
<?php include '../includes/inc.contacts.bottom.php'; ?>