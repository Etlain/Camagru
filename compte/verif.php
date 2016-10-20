<?php
  function verif_mail($mail, &$error)
  {
    if (empty($mail))
    {
      $error = "Vous devez renseigner tous les champs";
      return (false);
    }
    else if (!preg_match("/^[a-z0-9]{1,64}@[a-z0-9._-]{2,252}\.[a-z]{2,6}$/", $mail))
    {
      $error = "Adresse mail invalide";
      return (false);
    }
    else if (strlen($mail) > 80) // max 255
    {
      $error = "Adresse mail invalide";
      return (false);
    }
    return (true);
  }

  function verif_password($pwd, &$error)
  {
    if (empty($pwd))
    {
      $error = "Vous devez renseigner tous les champs";
      return (false);
    }
    if (!preg_match("/^[\w]+$/", $pwd))
    {
      $error = "mdp: caracteres invalide";
      return (false);
    }
    if (!preg_match("/^[\w]{8,}$/", $pwd))
    {
      $error = "mdp: trop court";
      return (false);
    }
    if (!preg_match("/[a-z]/", $pwd))
    {
      $error = "mdp : Il faut au moins une lettre minuscule";
      return (false);
    }
    if (!preg_match("/[A-Z]/", $pwd))
    {
      $error = "mdp: Il faut au moins une lettre majuscule";
      return (false);
    }
    if (!preg_match("/[0-9]/", $pwd))
    {
      $error = "mdp : Il faut au moins un chiffre";
      return (false);
    }
    return (true);
  }

  function verif_login($login, &$error)
  {
    if (empty($login))
    {
      $error = "Vous devez renseigner tous les champs";
      return (false);
    }
    if (preg_match("/^[a-zA-Z0-9_]{1,12}$/", $login))
      return (true);
    $error = "login : Lettre, nombre et '_' autorise, max 12 caracteres";
    return(false);
  }
?>
