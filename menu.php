
<nav>
  <div class="nav-wrapper">
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <a href="<?php echo Config::DIRETORIO_SITE; ?>index.php"><img class="lazy brand-logo" data-original="<?php echo Config::DIRETORIO_SITE; ?>images/logo.png"></a>
    <ul class="hide-on-med-and-down left right social-media-ul">
	<li><a href="#" class="social-media-a"> <img class="social-media-icon" src="images/facebook.svg" alt=""></a></li>
    <li><a href="#" class="social-media-a"><img class="social-media-icon" src="images/twitter.svg" alt=""></a></li> 
    <li><a href="#" class="social-media-a"> <img class="social-media-icon" src="images/instagram.svg" alt=""></a></li>
      <li>
        <fieldset>
          <form method="GET" action="<?php echo Config::DIRETORIO_SITE; ?>busca.php?">
            <label><img class="social-media-loupe" src="images/loupe.svg" alt=""></label>
            <input type="text" name="b" value="<?php if(isset($_GET['b'])){echo $_GET['b'];} ?>" placeholder="Buscar" required>
          </form>
        </fieldset>
      </li>
    </ul>
    <ul class="side-nav" id="mobile-demo">
	<li><a href="#">  <i class="fab fa-facebook-square fa-lg"></i></a></li>
    <li><a href="#"> <i class="fab fa-instagram fa-lg"></i></a></li> 
    <li><a href="#"> <i class="fab fa-twitter fa-lg"></i></a></li>
      <li>
        <fieldset>
          <form method="GET" action="<?php echo Config::DIRETORIO_SITE; ?>busca.php?">
            <label><span class="fa fa-search"></span></label>
            <input type="text" name="b" required>
          </form>
        </fieldset>
      </li>
    </ul>
  </div>
</nav>