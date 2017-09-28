Yii2 Contact
============
Yii2 Contact

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist modernkernel/yii2-contact "*"
```

or add

```
"modernkernel/yii2-contact": "*"
```

to the require section of your `composer.json` file.


MySQL
-----

```
yii migrate --migrationPath=@vendor/modernkernel/yii2-contact/migrations/ --migrationTable={{%contact_migration}}
```

MongoDB
-------

```
php yii mongodb-migrate --migrationPath=@vendor/modernkernel/yii2-contact/migrations/mongodb/ --migrationCollection=contact_migration
```