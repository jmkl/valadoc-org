<?php
//	ini_set("display_errors","1");
//	ERROR_REPORTING(E_ALL);

if ($_GET['page'] == '') {
  $_GET['page'] = 'index.htm';
}
$hash_frag = $_GET['_escaped_fragment_'];
if (isset ($hash_frag)) {
  if ($hash_frag == '') {
    $_GET['page'] = 'index.htm';
  } else {
    $parts = explode ('=', $hash_frag);
    $key = $parts[0];
    $value = $parts[1];
    if ($key == 'wiki') {
      $_GET['page'] = $value.".htm";
    } else if ($key == 'api') {
      $_GET['page'] = $value.".html";
    } else {
      $_GET['page'] = 'index.htm';
    }
  }
}

function get_title () {
  $is_wiki = substr($_GET['page'], -4) === '.htm';
  $segments = explode ('/', $_GET['page']);

  for ($i = 0; $i < count ($segments) ; $i++) {
    $segments[$i] = htmlentities ($segments[$i]);
  }

  if (count ($segments) == 2) {
    // package content
    if ($is_wiki) {
      return $segments[0];
    } else {
      // api description: <element-name> -- <package-name>
      return basename ($segments[1], ".html") . ' &ndash; ' . $segments[0];
    }
  }

  return  "Valadoc.org - Stays crunchy. Even in milk.";
}

?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="fragment" content="!">
    <title><?php echo get_title (); ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Droid+Serif:400|Droid+Sans+Mono">
    <link rel="stylesheet" href="/styles/main.css" type="text/css">
    <link rel="apple-touch-icon" href="/images/icon.png" />
    <link rel="shortcut icon" href="images/favicon.ico">
  </head>
  <body>
    <nav>
      <div id="search-box">
        <input id="search-field" type="text" placeholder="Search" autofocus="autofocus" autocompletion="off" autosave="search" /><img id="search-field-clear" src="/images/clean.svg" />
      </div>
      <span class="title"><a href="/index.htm"><img alt="Valadoc" src="images/logo.svg"/></a></span>
      <span class="subtitle">Stays crunchy, even in milk.</span>
      <div id="links">
        <ul>
          <li><a href="https://wiki.gnome.org/Projects/Vala/Tutorial">Tutorial</a></li>
          <li><a href="templates/markup.htm">Markup</a></li>
          <li><a href="https://wiki.gnome.org/Projects/Vala">About Vala</a></li>
          <li><a href="templates/about.htm">About Valadoc</a></li>
        </ul>
      </div>
    </nav>
    <div id="sidebar">
      <ul id="search-results"></ul>
      <div id="navigation-content">
        <noscript>
          <?php @readfile ($_GET['page'] . '.navi.tpl'); ?>
        </noscript>
      </div>
    </div>
    <div id="content-wrapper">
      <div id="content">
        <noscript>
        <?php @readfile ($_GET['page'] . '.content.tpl'); ?>
        </noscript>
      </div>
      <div id="comments" style="margin: 10px;" />

      <div class="site_footer">
      <!-- Generated by <a href="http://www.valadoc.org/">Valadoc</a> -->
      </div>
    </div>
  <script type="text/javascript" src="/scripts/jquery.min.js"></script>
  <script type="text/javascript" src="/scripts/jquery.ba-hashchange.min.js"></script>
  <script type="text/javascript" src="/scripts/wtooltip.js"></script>
  <script type="text/javascript" src="/scripts/valadoc.js"></script>
  <script type="text/javascript" src="/scripts/main.js"></script>
  <script type="text/javascript">
  //if (document.location.hash != '') {
  load_link (hash_to_url (window.location.hash), window.location.hostname);
  //}
  </script>
  </body>
</html>
