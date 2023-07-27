<?php
function getHeaderCard($text, $content = array(), $dbName, $onClick = "") {
    $contentHtml = '';
//    foreach ($content as $item) {
//        $loweredItem = strtolower($item);
//        $contentHtml .= "<div class='admin card-{$loweredItem} content'>{$item}</div>";
//    }
    $loweredText = strtolower($text);
    return <<<HTML
        <div class="admin card DB={$dbName}" id="$dbName" onclick="{$onClick}" style="cursor: pointer">
            <div class="admin card-{$loweredText} DB={$dbName}"><span>{$text}</span></div>
            {$contentHtml}
        </div>
HTML;
}
?>
