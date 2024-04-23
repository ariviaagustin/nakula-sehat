<?php 
  function judul_helper($data)
  {
    $data = strtolower($data);
    $data = str_replace(" ", "-", $data);
    $data = str_replace(".", "-", $data);
    $data = str_replace(",", "-", $data);
    $data = str_replace("'", "-", $data);
    $data = str_replace('"', "-", $data);
    $data = str_replace("!", "-", $data);
    $data = str_replace("@", "-", $data);
    $data = str_replace("#", "-", $data);
    $data = str_replace("$", "-", $data);
    $data = str_replace("%", "-", $data);
    $data = str_replace("^", "-", $data);
    $data = str_replace("&", "-", $data);
    $data = str_replace("*", "-", $data);
    $data = str_replace("(", "-", $data);
    $data = str_replace(")", "-", $data);
    $data = str_replace("+", "-", $data);
    $data = str_replace("=", "-", $data);
    $data = str_replace(";", "-", $data);
    $data = str_replace(":", "-", $data);
    $data = str_replace("?", "-", $data);
    $data = str_replace(">", "-", $data);
    $data = str_replace("<", "-", $data);
    $data = str_replace("/", "-", $data);
    $data = str_replace("]", "-", $data);
    $data = str_replace("[", "-", $data);
    $data = str_replace("{", "-", $data);
    $data = str_replace("}", "-", $data);
    $data = str_replace("---", "-", $data);
    $data = str_replace("--", "-", $data);

    return $data;
  }
?>  