<?php

function errorMessage($errors, $field){
    if(isset($errors[$field])){
        return $errors[$field];
    } else {
        return "";
    }
}

// permet d'afficher la class d'erreur en css
function errorClass($errors, $field){
    if(isset($errors[$field])){
        return "has-error";
    } else {
        return "";
    }
}

// fonction formater une string (evite l'injection de code)
function Rec($text){
   $text = trim($text); // effacer les blancs avant et après les textes
   $text = htmlspecialchars($text, ENT_QUOTES); // converts to string with " and ' as well
   $text = htmlentities($text, ENT_QUOTES);
   $text = nl2br($text);

   return $text;
};

// fonction pour valider le formulaire prend un tableau en paramètre
function validateContact($contact){
    $errors = [];
    if(empty($contact['firstname'])){
        $errors['firstname'] = 'Le prénom est requis.';
    }

    if(empty($contact['lastname'])){
        $errors['lastname'] = 'Le nom est requis.';
    }

    if(strlen($contact['email'])<2){
      $errors['email'] = 'L\'email est requis.';
    }else{
      if(!ereg('^[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+'.
        '@'.
        '[-!#$%&\'*+\/0-9=?A-Z^_`a-z{|}~]+\.'.
        '[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+$',
        $contact['email'])){
            $errors['email'] = 'L\'email n\'est pas valide.';
        }
    }

    if(empty($contact['email'])){
        $errors['email'] = 'L\'email est requis.';
    }

    if(empty($contact['tel'])){
        $errors['tel'] = 'Le téléphone est requis.';
    }

    // vérifier que le contact n'est pas déja enregistré en BDD
    if(verifMail($contact['email']) != 0){
        // erreur
        $errors['exist_mail'] = 'Cet email existe déjà';
    }

    return $errors;
}

function validateUpdateContact($contact){
    $errors = [];
    if(empty($contact['firstname'])){
        $errors['firstname'] = 'Le prénom est requis.';
    }

    if(empty($contact['lastname'])){
        $errors['lastname'] = 'Le nom est requis.';
    }

    if(strlen($contact['email'])<2){
        $errors['email'] = 'L\'email est requis.';
    }else{
        if(!ereg('^[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+'.
            '@'.
            '[-!#$%&\'*+\/0-9=?A-Z^_`a-z{|}~]+\.'.
            '[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+$',
            $contact['email'])){
            $errors['email'] = 'L\'email n\'est pas valide.';
        }
    }

    if(empty($contact['email'])){
        $errors['email'] = 'L\'email est requis.';
    }

    if(empty($contact['tel'])){
        $errors['tel'] = 'Le téléphone est requis.';
    }

    return $errors;
}

// function qui affichera les contact prend un tableau en paramètre
function displayContacts($contacts, $currentPage) {
    foreach ($contacts as $contact){
        echo "<tr>";
        foreach ($contact as $key=>$content){
            $contact_id = $contact['id'];
            if($key != 'id'){
                echo "<td>$content</td>";
            }
        }
        echo "<td><a href=\"view.php?id=$contact_id&p=$currentPage\"><span class=\"glyphicon glyphicon-eye-open\"></span></a></td>
                <td><a href=\"update.php?id=$contact_id&p=$currentPage\"><span class=\"glyphicon glyphicon-pencil\"></span></a></td>
                <td><a href=\"delete.php?id=$contact_id&p=$currentPage\"><span class=\"glyphicon glyphicon-remove-circle\"></span></a></td>
                </tr>";
    }

}

// fonction qui gère la pagination
// prend en paramètre un entier nbPages et une string link pour construire l'url
function pagination($nbPages, $link){
    for($i = 1; $i <=$nbPages; $i ++){
        echo "<li><a href=\"$link?p=$i\"> $i </a></li>";
    }
}

// petite fonction simple pour mieux présenter le debug
function debug($tab){
  echo '<pre>';
    print_r($tab);
  echo '</pre>';
}
