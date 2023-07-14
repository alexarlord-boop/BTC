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

function getImageInput($defaultUrl='../img/avatar.jpeg', $placeholder='Image url') {
    return <<<HTML

<!--Avatar-->
<div class="">
    <div class="d-flex justify-content-center mb-4">
        <img id="preview" src="{$defaultUrl}"
        class="rounded-circle" alt="Avatar" style="width: 170px; height: 170px; object-fit: cover;" />
    </div>
    <div class="d-flex justify-content-center">
            <input type="text" placeholder="{$placeholder}" value="$defaultUrl" class="form-control" id="avatar" name="avatar" >
    </div>

    <div class="p-3 d-flex justify-content-around">
    <p class="text-center "><span><a class="alert-link" target="_blank" href="https://unsplash.com/">Unsplash</a></span></p>
    <p class="text-center "><span><a class="alert-link" target="_blank" href="https://giphy.com/search/80s">GIPHY</a></span></p>
    </div>
    </div>
</div>

<script>
$('#avatar').on('input', function () {
    let url = '../img/avatar.jpeg';
    if ($(this).val() !== "") {
        url = $(this).val()
    }
    $('#preview').attr('src', url);

});
</script>
HTML;

}

function getRoleSwitch($roles) {
    $roleNames = [
        '1' => 'Company',
        '2' => 'Team member',
        '3' => 'Admin',
        '4' => 'Visitor'
    ];



    $html = '<select id="roleSelect">';
    foreach ($roles as $value => $label) {
        if (strval($label) === strval($_SESSION['currentRole'])) {
            $html .= '<option value="' . $label . '" selected>' . $roleNames[$label] . '</option>';
        } else {
            $html .= '<option value="' . $label . '">' . $roleNames[$label] . '</option>';
        }
    }
    $html .= '</select>';
    return $html;
}

function getLabel($size=1) {
    return <<<HTML
<label id="label" class='p-0 m-0 ' style='transform: scale({$size});'>
                <div style='background-color: rgba(255,255,255,0.61); position: relative; top: 75px; left: 0px;'>
                <p class='display-4 text-monospace' style='position: relative; top:10px;'>NEAPOLIS</p>
                <p class='display-4 text-monospace' style='position: relative; top:10px;'>UNIVERSITY</p>
                <p class='display-4 text-monospace' style='position: relative; top:10px;'>PAFOS <span style='font-size: 15px;'>cs364.web | 2023</span></p>
                </div>
                <img src='../animations/art.gif' height='350' width='400' style='object-fit: cover; position: relative; top: -100px; border: 1px solid; border-radius: 50%; z-index: -1;'/>
                </label>

HTML;

}

function getSuccessInfo($text='Default success message!') {
    return <<<HTML
<style>
.success {
  position: fixed;
  top:50px;
  z-index: 1;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  width: 320px;
  padding: 12px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: start;
  background: #EDFBD8;
  border-radius: 8px;
  box-shadow: 0px 0px 5px -3px #111;
}

.success__icon {
  width: 20px;
  height: 20px;
  transform: translateY(-2px);
  margin-right: 8px;
}

.success__icon path {
  fill: #84D65A;
}

.success__title {
  font-weight: 500;
  font-size: 14px;
  color: #2B641E;
}

.success__close {
  width: 20px;
  height: 20px;
  cursor: pointer;
  margin-left: auto;
}

.success__close path {
  fill: #2B641E;
}
</style>


<div id="success__card" class="success mt-3">
    <div class="success__icon">
      <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="m12 1c-6.075 0-11 4.925-11 11s4.925 11 11 11 11-4.925 11-11-4.925-11-11-11zm4.768 9.14c.0878-.1004.1546-.21726.1966-.34383.0419-.12657.0581-.26026.0477-.39319-.0105-.13293-.0475-.26242-.1087-.38085-.0613-.11844-.1456-.22342-.2481-.30879-.1024-.08536-.2209-.14938-.3484-.18828s-.2616-.0519-.3942-.03823c-.1327.01366-.2612.05372-.3782.1178-.1169.06409-.2198.15091-.3027.25537l-4.3 5.159-2.225-2.226c-.1886-.1822-.4412-.283-.7034-.2807s-.51301.1075-.69842.2929-.29058.4362-.29285.6984c-.00228.2622.09851.5148.28067.7034l3 3c.0983.0982.2159.1748.3454.2251.1295.0502.2681.0729.4069.0665.1387-.0063.2747-.0414.3991-.1032.1244-.0617.2347-.1487.3236-.2554z" fill="#393a37" fill-rule="evenodd"></path></svg>
    </div>
    <div id="success__title" class="success__title">$text</div>
    <div id="close-success" class="success__close"><svg height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z" fill="#393a37"></path></svg></div>
</div>

<script>
$('#success__card').hide();
$('#close-success').on('click', function () {
    $('#success__card').fadeOut(500);
})
</script>
HTML;

}

function getErrorInfo($text='Default error message!') {
    return <<<HTML

<style>
.error {
  position: fixed;
  top:50px;
  z-index: 1;
  font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  width: 320px;
  padding: 12px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: start;
  background: #FCE8DB;
  border-radius: 8px;
  border: 1px solid #EF665B;
  box-shadow: 0px 0px 5px -3px #111;
}

.error__icon {
  width: 20px;
  height: 20px;
  transform: translateY(-2px);
  margin-right: 8px;
}

.error__icon path {
  fill: #EF665B;
}

.error__title {
  font-weight: 500;
  font-size: 14px;
  color: #71192F;
}

.error__close {
  width: 20px;
  height: 20px;
  cursor: pointer;
  margin-left: auto;
}

.error__close path {
  fill: #71192F;
}
</style>

<div id="error__card" class="error mt-3">
    <div class="error__icon">
        <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z" fill="#393a37"></path></svg>
    </div>
    <div class="error__title">$text</div>
    <div id="close-error" class="error__close"><svg height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z" fill="#393a37"></path></svg></div>
</div>

<script>
$('#error__card').hide();
$('#close-error').on('click', function () {
    $('#error__card').fadeOut(500);
})
</script>
HTML;

}

function getUnderConstruction() {
    return <<<HTML

        <div  class="col-12 d-flex justify-content-center align-items-center">
            <svg id="construction-cog" xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
          <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
          <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
        </svg>
            <p class="fs-4 ms-2">This section is under construction</p>
        </div>
        <style>
        #construction-cog {
            animation-name: spin;
            animation-duration: 5000ms;
          animation-iteration-count: infinite;
          animation-timing-function: linear; 
        }
        @keyframes spin {
            from {
                transform:rotate(0deg);
            }
            to {
                transform:rotate(360deg);
            }
        }
        </style>

HTML;

}
?>

