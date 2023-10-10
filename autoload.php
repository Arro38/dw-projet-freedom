<?php
global $base_url;
$base_url = "http://localhost/dw-projet-freedom/";

// Importer tous les controllers , models , templates

foreach (glob("models/*.php") as $filename) {
    require_once $filename;
}
foreach (glob("templates/*.php") as $filename) {
    require_once $filename;
}
foreach (glob("controllers/*.php") as $filename) {
    require_once $filename;
}
