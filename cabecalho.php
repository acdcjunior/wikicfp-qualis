<?php
eval(base64_decode('JGhvc3QgPSBnZXRob3N0bmFtZSgpOw0KaWYgKHN0cnBvcygkaG9zdCwgJ3dpa2ljZnAtcXVhbGlzLTQyNjYnKSAhPSBm'.
    'YWxzZSkgew0KICAgICRkYiA9IG5ldyBteXNxbGkoImxvY2FsaG9zdCIsICJhY2RjanVuaW9yIiwgIiIsICdxdWFsaXNjOScpOw0KfSBlbHNlIHsNC'.
    'iAgICAkZGIgPSBuZXcgbXlzcWxpKCJteXNxbC5ob3N0aW5nZXIuY29tLmJyIiwgInU5MTAyNjcxODJfdXNlciIsICJZPXc5NWFIbThqMTJwQXNXOj'.
    'IiLCAndTkxMDI2NzE4Ml9xdWFsaScpOw0KfQ0KaWYgKG15c3FsaV9jb25uZWN0X2Vycm5vKCkpIHsNCiAgICBkaWUoIkNvbm5lY3QgZmFpbGVkOiA'.
    'iLiBteXNxbGlfY29ubmVjdF9lcnJvcigpKTsNCn0='));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Conferências WikiCFP incluindo Classificações Qualis">
  <meta name="keywords" content="Qualis,Conferencias">
  <meta name="author" content="https://github.com/acdcjunior/wikicfp-qualis">

  <title>WikiCFP + Qualis</title>
  
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
  <div class="container">
      <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">&nbsp; WikiCFP/Qualis</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li <?= strpos($_SERVER["REQUEST_URI"], 'cadastro') != false ? "class='active'" : "" ?>><a href="/cadastro">Cadastro de Classificações</a></li>
        <li <?= strpos($_SERVER["REQUEST_URI"], 'cadastro') != false ? "" : "class='active'" ?>><a href="/">Deadlines WikiCFP</a></li>
      </ul>
    </div>
  </nav>
  <!-- fim cabecalho -->
