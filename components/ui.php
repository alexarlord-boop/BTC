<?php

function getMainBtn($href, $text) {
    return <<<HTML
<style>
button.main {
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

button.main:active {
 color: #666;
 box-shadow: inset 4px 4px 12px #c5c5c5,
             inset -4px -4px 12px #ffffff;
}
</style>

<button class="main" onclick="goTo('{$href}')">
$text
</button>

<script>
function goTo(link) {
    window.location.href = link;
}
</script>
HTML;

}

function getImageInput() {
    return <<<HTML

<!--Avatar-->
<div class="col-md-8 offset-md-2">
    <div class="d-flex justify-content-center mb-4">
        <img src="../img/avatar.jpeg"
        class="rounded-circle" alt="Avatar" style="width: 150px;" />
    </div>
    <div class="d-flex justify-content-center">
            <input type="text" placeholder="Image url" class="form-control" id="avatar" name="avatar" >
        </div>
    </div>
</div>
HTML;

}

function getRoleSwitch($roles) {
    $roleNames = [
        '1' => 'Company',
        '2' => 'Team member'
    ];

    $html = '<select>';
    foreach ($roles as $value => $label) {
        $html .= '<option value="' . $value . '">' . $roleNames[$label] . '</option>';
    }
    $html .= '</select>';
    return $html;
}
?>