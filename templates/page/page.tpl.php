<?php

/**
 * @file page.tpl.php
 * Main page template file for the aarhus-mobile theme.
 */
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>
<body class="<?php print $body_classes; ?><?php if (!empty($admin)) print ' '.admin;  ?>">
  <div class="header">
    <div class="top">
    <?php if ($user->uid): ?>
      <?php print l(t('Logout'),'logout', array('attributes' => array('class' => 'login-btn'))) ?>
    <?php else: ?>
      <?php print l(t('Log ind'),'user/login', array('attributes' => array('class' => 'login-btn'),'query' => 'destination=user/status')) ?>
    <?php endif; ?>
    <?php if ($site_logo): ?>
      <?php print $site_logo ?>
    <?php endif; ?>
    </div>
    <div class="bottom">
      <div id="search">
        <?php print $search; ?>
      </div>
    </div>
  </div>
  <?php print $main_menu ?>
  
  <?php if ($help OR $messages): ?>
    <div id="drupal-messages">
      <?php print $help ?>
      <?php print $messages ?>
    </div>
  <?php endif; ?>

  <?php print $content; ?>

  <?php print $bottom_menu; ?>
  
  <div class="branding">
    <a class="logo-aak" href="http://aarhus.dk" title="Aarhus Kommune">Aarhus Kommume</a>
    <a class="logo-ting" href="http://ting.dk" title="TING">Empowered by TING</a>
  </div>
  
  <?php print $closure; ?>
</body>
</html>
