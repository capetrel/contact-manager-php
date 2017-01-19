<?php
include '../includes/inc.contacts.top.php';
include 'contact.db.php';
include '../helpers.php';

$count = countAllContacts();
$nbContacts = $count['nbContacts'];
$perPage = 10;
$nbPages = ceil($nbContacts/$perPage);

if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPages){
    $cPage = $_GET['p'];

}else{
    $cPage = 1;
}

$currentPage = ($cPage-1)*$perPage;

$displayContacts = getAllContactsPagination($currentPage, $perPage);

?>
<div class="container">
    <div class="row">
        <div>
           <h1>Liste de contact</h1>
           <!-- bouton -->
           <a class="btn btn-info" href="add.php?p=<?= $nbPages; ?>">Ajouter un contact</a>
           <br>
           <br>
        </div>
        <!-- tableau -->
        <table class="table table-striped">
            <thead>
              <tr>
                <th>Prénom&nbsp:</th>
                <th>Nom&nbsp:</th>
                <th>E-mail&nbsp:</th>
                <th>Téléphone&nbsp:</th>
                <th>Web&nbsp:</th>
                <th colspan="3">Action&nbsp:</th>
              </tr>
            </thead>
            <tbody>
              <!-- On parcour le tableau -->
              <?php displayContacts($displayContacts, $cPage); ?>
            </tbody>
        </table>

        <div class="text-center">
            <ul class="pagination">
                <?php pagination($nbPages, "list.php"); ?>
            </ul>
        </div>

    </div>
</div>
<?php include '../includes/inc.contacts.bottom.php'; ?>
