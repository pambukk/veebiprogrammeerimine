<?php
  $pageHeaderHTML = "<!DOCTYPE html> \n";
  $pageHeaderHTML .= '<html lang="et">'. "\n";
  $pageHeaderHTML .= "<head> \n";
  $pageHeaderHTML .= "\t" ."<style> \n";
  #$pageHeaderHTML .= "\t \t body{background-color: "; \n";
  #$pageHeaderHTML .= "\t \t color: " .$_SESSION["txtColor"] ."\n";
  $pageHeaderHTML .= "\t }";
  $pageHeaderHTML .= "</style> \n";
  if(isset($toScript)){$pageHeaderHTML .=$toScript;
  } 
  $pageHeaderHTML .= "</head> \n";
  echo $pageHeaderHTML;