# NG
PHP Class containing Nigeria's Data 

### Usage 
Install package `composer require jajo/ng`


### Get States
```php 
<?php 
use Jajo\NG;

$ng = new NG();
$ng->states;
```
### Get Local Government Areas
```php 
<?php 
use Jajo\NG;

$ng = new NG();
$ng->getLGA( 'Lagos' );
```
### Get State Capital
```php 
<?php 
use Jajo\NG;

$ng = new NG();
$ng->getCapital( 'Lagos' );
```
### Get LGA or Capital owned by a state 
```php 
<?php 
use Jajo\NG;

$ng = new NG();
$ng->getStateBy( 'capital', 'Ikeja' );
$ng->getStateBy( 'lga', 'Ohafia' );
```
## Contributing
I would love to extend this class to a database of Nigerian data, I had to start somewhere. Any form of contribution is welcomed!

## Finally
Much love from Naija!!! 🇳🇬 🇳🇬