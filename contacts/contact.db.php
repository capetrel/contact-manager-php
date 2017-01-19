<?php

include '../db.php';

function countAllContacts(){

    global $pdo;
    $stmt = $pdo->query("SELECT COUNT(id) AS nbContacts FROM contacts");

    return $stmt->fetch();
}

function getAllContacts(){

    global $pdo;
    $stmt = $pdo->query("SELECT * FROM contacts");

    return $stmt;
}

function getAllContactsPagination($cPage, $perPage){

    global $pdo;

    $stmt = $pdo->query("SELECT * FROM contacts ORDER BY id LIMIT $cPage, $perPage");

    return $stmt;
}

function getOneContact($one_contact){

    global $pdo;

    $stmt_one_contact = $pdo->query("SELECT * FROM contacts WHERE id = '$one_contact'");

    return $stmt_one_contact->fetch();

}

function verifLastname($lastname){

    global $pdo;

    $stmt = $pdo->query("SELECT COUNT(id) AS quantity FROM contacts WHERE lastname = '$lastname'");
    $result = $stmt->fetch();
    return $result['quantity'];

}

function verifMail($mail){

    global $pdo;

    $stmt = $pdo->query("SELECT COUNT(id) AS quantity FROM contacts WHERE email = '$mail'");
    $result = $stmt->fetch();
    return $result['quantity'];

}

function addContact($contact){

    global $pdo;

    try{

        $sql = "INSERT INTO contacts (id, firstname, lastname, email, tel, web) VALUES (:id, :firstname, :lastname, :email, :tel, :web)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $contact['id']);
        $stmt->bindParam(':firstname', $contact['firstname']);
        $stmt->bindParam(':lastname', $contact['lastname']);
        $stmt->bindParam(':email', $contact['email']);
        $stmt->bindParam(':tel', $contact['tel']);
        $stmt->bindParam(':web', $contact['web']);

        $stmt->execute();

        return "success";
    }catch (PDOException $e){
        $msg = $e->getMessage();
        return $msg;
    }
    $pdo = null;

}

function updateContact($contact_update){

    global $pdo;

    try {

        $sql = "UPDATE contacts SET firstname=:firstname, lastname=:lastname, email=:email, tel=:tel, web=:web WHERE id=:id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':firstname', $contact_update['firstname']);
        $stmt->bindParam(':lastname', $contact_update['lastname']);
        $stmt->bindParam(':email', $contact_update['email']);
        $stmt->bindParam(':tel', $contact_update['tel']);
        $stmt->bindParam(':web', $contact_update['web']);
        $stmt->bindParam(':id', $contact_update['id']);

        $stmt->execute();

        // afficher un message de succès
        echo $stmt->rowCount() . " records UPDATED successfully";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $pdo = null;

}

function deleteContact($id){

    global $pdo;

    $stmt_del_contact = $pdo->query("DELETE FROM contacts WHERE id = '$id'");

    $stmt_del_contact->execute();

}

?>
