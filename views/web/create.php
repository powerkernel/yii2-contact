<?php

use harrytang\contact\ContactModule;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model harrytang\contact\models\Contact */

$this->title = Yii::t('contact', 'Contact Us');
$this->params['breadcrumbs'][] = $this->title;

// GMaps
$map=false;
if(!empty(ContactModule::getInstance()->params['latLng'])){
    $latLng=ContactModule::getInstance()->params['latLng'];
    $name=Yii::$app->name;
    $js=<<<EOD
function initialize() {
    var pos = new google.maps.LatLng({$latLng});
    var mapOptions = {
        zoom: 15,
        center: pos,
        scrollwheel: false
    };
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var marker = new google.maps.Marker({
        position: pos,
        map: map,
        title: "{$name}"
    });

    var infowindow = new google.maps.InfoWindow({
        content: "<b>{$name}</b>"
    });
    infowindow.open(marker.get("map"), marker);
    google.maps.event.addListener(marker, "click", function() {
        infowindow.open(marker.get("map"), marker);
    });
}

function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&callback=initialize';
    document.body.appendChild(script);
}
window.onload = loadScript;
EOD;
    $this->registerJs($js, \yii\web\View::POS_END);
    $map=true;
}

?>
<div class="contact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <hr/>
    </div>
    <div class="row">
        <?php if($map):?>
        <div class="col-md-7 hidden-xs hidden-sm">
            <div id="map-canvas" style="height: 100vh;">
            </div>
        </div>
        <?php endif;?>
        <div class="col-xs-12 col-sm-12 col-md-<?= $map?'5':'12' ?>">
            <h2><?= Yii::$app->name ?></h2>

            <?php if(!empty(ContactModule::getInstance()->params['address'])):?>
            <p>
                <abbr title="<?= ContactModule::t('Address') ?>" class="glyphicon glyphicon-map-marker"></abbr>
                <?= ContactModule::getInstance()->params['address'] ?><br />
                <?= ContactModule::getInstance()->params['city'] ?>, <?= ContactModule::getInstance()->params['country'] ?>
            </p>
            <?php endif;?>

            <?php if(!empty(ContactModule::getInstance()->params['phone'])):?>
            <p><abbr title="<?= ContactModule::t('Phone') ?>" class="glyphicon glyphicon-earphone"></abbr>
                <?= ContactModule::getInstance()->params['phone'] ?></p>
            <?php endif;?>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>