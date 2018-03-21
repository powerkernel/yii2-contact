Yii2 Contact
============
Yii2 Contact

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist powerkernel/yii2-contact "*"
```

or add

```
"powerkernel/yii2-contact": "*"
```

to the require section of your `composer.json` file.


MongoDB
-------

```
php yii mongodb-migrate --migrationPath=@vendor/powerkernel/yii2-contact/migrations/ --migrationCollection=contact_migration
```
