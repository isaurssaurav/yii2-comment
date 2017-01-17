
Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require isaurssaurav/yii2-comment
```

or add

```json
"isaurssaurav/yii2-comment": "*"
```

to the require section of your composer.json.
Font Awesome is required*

Configuration
-----------------------

**Database Migrations**

Before using Comments Widget, we'll also need to prepare the database.
```php
php yii migrate --migrationPath=@vendor/isaurssaurav/yii2-comment/migration
```

**Module setup**
To access the module, you need to add the following code to your application configuration:
```php
'modules' => [
    'comment' => [
        'class' => 'isaurssaurav\yii\comments\Module',
    ],
]
```

Usage
-------------------
**Basic example:**
```
use isaurssaurav\yii\comment\widgets\CommentWidget;

//echo where you want to show comment
 echo CommentWidget::widget();

```
Properties
-------------------
1.limit 
  Default value is 2
  No of comment you want to show at first.This number also controls number of comment shown after LOAD MORE is clicked
2.sort
  ASC or DESC
3.recognize_schema
  Defaultly it catches current url, but You can changed it to idk page_id or something

```
use isaurssaurav\yii\comment\widgets\CommentWidget;

//echo where you want to show comment
 echo CommentWidget::widget([
	limit => 10,
	sort => DESC,
]);

```
[![demo.png](https://s29.postimg.org/53a9lgpqf/demo.png)](https://postimg.org/image/6v38gd937/)


