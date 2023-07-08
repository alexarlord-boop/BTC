<?php

function getMainBtn($href, $text) {
    return <<<HTML
<style>
button {
 color: #090909;
 width: 150px;
 height: 150px;
 padding: 0.7em 1.7em;
 margin: 5px;
 font-size: 18px;
 border-radius: 0.5em;
 background: #e8e8e8;
 border: 1px solid #e8e8e8;
 transition: all .3s;
 box-shadow: 6px 6px 12px #c5c5c5,
             -6px -6px 12px #ffffff;
}

button:active {
 color: #666;
 box-shadow: inset 4px 4px 12px #c5c5c5,
             inset -4px -4px 12px #ffffff;
}
</style>

<button onclick="goTo('{$href}')">
$text
</button>

<script>
function goTo(link) {
    window.location.href = link;
}
</script>
HTML;

}

?>