<?php 
use app\core\Application ;

?><!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
      
    <header class="bg-dark mb-3">
        <nav class="navbar navbar-expand container navbar-dark">
            <a href="/" class="navbar-brand">MVC PHP <small>freecodecamp</small></a>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a href="/" class="nav-link active">Accueil</a>
              </li>
              <li class="nav-item">
                <a href="/contact" class="nav-link">Contact</a>
              </li>
            </ul>
            <?php if(Application::isGuest()) : ?>
            <ul class="ms-auto navbar-nav">
              <li class="nav-item">
                <a href="/register" class="nav-link">Register</a>
              </li>
              <li class="nav-item">
                <a href="/login" class="nav-link">Login</a>
              </li>
            </ul>
          <?php else : ?>
            <ul class="ms-auto navbar-nav">
              <li class="nav-item">
                <a href="/profile" class="nav-link">Mon Profil</a>
              </li>
              <li class="nav-item">
                <a href="/logout" class="nav-link">Logout</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">Welcome <?php echo Application::$APP->user->getDisplayName() ?></a>
              </li>
            </ul>
          <?php endif ?>
        </nav>
    </header>


    <div class="container">
        <?php if( Application::$APP->session->getFlash("success") ) : ?>
          <div class="alert alert-success">
            <?= Application::$APP->session->getFlash("success") ?>
          </div>
        <?php endif ?>
      {{content}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>