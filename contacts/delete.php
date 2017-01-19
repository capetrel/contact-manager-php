<?php
include '../includes/inc.contacts.top.php';
include 'contact.db.php';
include '../helpers.php';


// On récupère l'id du contact à supprimer
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $contact = getOneContact($id);
}

// si il y a un post on supprime le contact
if(!empty($_POST) && isset($_POST['delete-contact'])){

    deleteContact($contact['id']);
    
    header("location: list.php?p=".$_GET['p']);

}
?>

<div class="container">
    <h1>Voulez vous vraiment supprimer ce contact ?</h1>

    <form class="form-horizontal" method="post" name=view-contact>

        <div class="form-group">
            <label type="text" for="firstname" class="col-sm-2 control-label">Prénom :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= Rec($contact['firstname']); ?>" disabled>
            </div>
        </div>

        <div class="form-group">
            <label type="text" for="lastname" class="col-sm-2 control-label">Nom :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= Rec($contact['lastname']); ?>" disabled>
            </div>
        </div>

        <div class="form-group">
            <label type="text" for="email" class="col-sm-2 control-label">Email :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" value="<?= Rec($contact['email']); ?>" disabled>
            </div>
        </div>

        <div class="form-group">
            <label type="text" for="tel" class="col-sm-2 control-label">Téléphone :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tel" name="tel" value="<?= Rec($contact['tel']); ?>" disabled>
            </div>
        </div>

        <div class="form-group">
            <label type="text" for="web" class="col-sm-2 control-label">Url web :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="web" name="web" value="<?= Rec($contact['web']); ?>" disabled>
            </div>
        </div>

        <a class="btn btn-success" href="list.php">Non</a>
        <button type="submit" class="btn btn-danger" name="delete-contact">Oui</button>
    </form>
    <br>
    <br>
</div>

<?php include '../includes/inc.contacts.bottom.php'; ?>