<?php
$taustavarv = null;
$tekstivarv =null;
$textcolor =null;
$txtcolor_select= ["must","kollan","roheline","sinine","valge"];
$txtcolorError = null;
$toScript = "\t" .'<script type="text/javascript" src="script.js" defer></script>' ."\n"; 
require("header.php");
?>
<link rel="stylesheet" href="style.css">

<body>
    <div class="suur_kast">
      <span id="kella_kast">
        <div id="kell_paev"></div>
        <div id="kell_kuu_aasta"></div>
        <div id="kella_aeg"></div>
      </span>
    </div>
<br>   
<div id=startnupp>
<p class="nupp">
<input onclick="start()" type="button" value="Peata kell" id="stardi_kell"></input></p>
</div>
</body>
</html>

