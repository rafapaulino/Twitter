# PHP GET TOTAL OF FOLLOWERS IN TIWTTER

## Example of use

Install: composer require rafael.paulino/twitter

```php
<?php
require_once 'vendor/autoload.php';

use Twitter\CountFollowers;

$twitter = new CountFollowers('Your Account Name');
$total = $twitter->getTotal();
var_dump($total);
```
