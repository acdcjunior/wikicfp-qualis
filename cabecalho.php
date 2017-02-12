<?php
    //eval(base64_decode('JGhvc3QgPSBnZXRob3N0bmFtZSgpOwppZiAoc3RycG9zKCRob3N0LCAnd2lraWNmcC1xdWFsaXMtNDI2NicpICE9IGZhbHNlKSB7CiAgICAgICAgCiAgICAvLyBjb25uZWN0IHRvIGRiCiAgICAkbGluayA9IG15c3FsX2Nvbm5lY3QoJ2xvY2FsaG9zdCcsICdhY2RjanVuaW9yJywgJycpOwogICAgaWYgKCEkbGluaykgewogICAgICAgIGRpZSgnTm90IGNvbm5lY3RlZCA6ICcgLiBteXNxbF9lcnJvcigpKTsKICAgIH0KICAgIAogICAgaWYgKCEgbXlzcWxfc2VsZWN0X2RiKCdxdWFsaXNjOScpICkgewogICAgICAgIGRpZSAoJ0NhblwndCB1c2UgZGF0YWJhc2UgOiAnIC4gbXlzcWxfZXJyb3IoKSk7CiAgICB9Cgp9IGVsc2UgewogICAgJGxpbmsgPSBteXNxbF9jb25uZWN0KCJteXNxbC5ob3N0aW5nZXIuY29tLmJyIiwidTkxMDI2NzE4Ml91c2VyIiwiWT13OTVhSG04ajEycEFzVzoyIik7CiAgICBpZiAoISRsaW5rKSB7CiAgICAgICAgZGllKCdOb3QgY29ubmVjdGVkIDogJyAuIG15c3FsX2Vycm9yKCkpOwogICAgfQogICAgaWYgKCFteXNxbF9zZWxlY3RfZGIoJ3U5MTAyNjcxODJfcXVhbGknKSApIHsKICAgICAgICBkaWUgKCdDYW5cJ3QgdXNlIGRhdGFiYXNlIDogJyAuIG15c3FsX2Vycm9yKCkpOwogICAgfQp9'));
    $host = gethostname();
    if (strpos($host, 'wikicfp-qualis-4266') != false) {
        $db = new mysqli("localhost","acdcjunior","",'qualisc9');
    } else {
        $db = new mysqli("mysql.hostinger.com.br","u910267182_user","Y=w95aHm8j12pAsW:2",'u910267182_quali');
    }
    if (mysqli_connect_errno()) {
        die("Connect failed: ". mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  
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
        <li <?= strpos($_SERVER["REQUEST_URI"], 'crud') != false ? "class='active'" : "" ?>><a href="/crud">Editar Classificações</a></li>
        <li <?= strpos($_SERVER["REQUEST_URI"], 'crud') != false ? "" : "class='active'" ?>><a href="/">Deadlines</a></li>
      </ul>
    </div>
  </nav>
  <!-- fim cabecalho -->
