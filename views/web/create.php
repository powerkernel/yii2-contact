<?php

/* @var $this yii\web\View */
/* @var $model powerkernel\contact\models\Contact */

$this->title = Yii::t('contact', 'Contact Us');
$this->params['breadcrumbs'][] = $this->title;

// GMaps
$map = false;
$language = Yii::$app->language;
if (!empty($settings['latLng'])) {
    $latLng = $settings['latLng'];
    $name = Yii::$app->name;
    $js = <<<EOD
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
        content: "<b>{$name}</b><br/>{$settings['address']}<br/>{$settings['city']}, {$settings['country']}"
    });
    infowindow.open(marker.get("map"), marker);
    google.maps.event.addListener(marker, "click", function() {
        infowindow.open(marker.get("map"), marker);
    });
}

function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?key={$settings['mapApi']}&v=3.exp&callback=initialize&language={$language}';
    document.body.appendChild(script);
}
window.onload = loadScript;
EOD;
    $this->registerJs($js, \yii\web\View::POS_END);
    $map = true;
}

?>

<div class="contact-web-create" xmlns="http://www.w3.org/1999/html">
    <div class="box box-info">
        <div class="box-body">
            <div class="row">
                <?php if ($map): ?>
                    <div class="col-md-7 hidden-xs hidden-sm">
                        <div id="map-canvas" style="height: 100vh;">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-xs-12 col-sm-12 col-md-<?= $map ? '5' : '12' ?>">
                    <div itemscope itemtype="http://schema.org/Organization">
                        <h2><span itemprop="name"><?= Yii::$app->name ?></span></h2>
                        <?php if (!empty($settings['address'])): ?>
                            <p>
                                <abbr title="<?= Yii::$app->getModule('contact')->t('Address') ?>" class="glyphicon glyphicon-map-marker"></abbr>
                                <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                    <span itemprop="streetAddress"><?= $settings['address'] ?></span>,
                                    <span itemprop="addressLocality"><?= $settings['city'] ?></span>,
                                    <span itemprop="addressCountry"><?= $settings['country'] ?></span>
                                </span>
                            </p>
                        <?php endif; ?>
                        <?php if (!empty($settings['phone'])): ?>
                            <p><abbr title="<?= Yii::$app->getModule('contact')->t('Phone') ?>" class="glyphicon glyphicon-phone-alt"></abbr>
                                <span itemprop="telephone"><?= $settings['phone'] ?></span>
                                <a href="tel:<?= $settings['phone'] ?>"
                                   class="btn btn-xs btn-primary hidden-sm hidden-md hidden-lg"><span
                                        class="glyphicon glyphicon-earphone"></span> <?= Yii::$app->getModule('contact')->t('Call') ?></a>
                            </p>
                        <?php endif; ?>
                    </div>
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>