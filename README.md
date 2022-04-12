# Simple Login

#### Simple login and register system

1. **Info**
⋅⋅⋅Login and register system created with PHP (7.4 +).
⋅⋅⋅For manage files I use MVC architectural pattern. Every classes for this pattern are located in app folder.
⋅⋅⋅Include files I use autoloader script.
⋅⋅⋅Other files like style and javascript are located in assets folder.

2. **Functionality**
*DB class* - connects to database and get/input/edit/delete data.

Example
```php
$db = new DB;
$db->from('user')->where('email', 'demo@demo.demo')->get();
// return object 
// syntax: <table name>(string) where <column name>(string) = <data>(string)
// limitations - return single object so passing data must be unique for selected column

$db = new DB;
$db->from('user')->create(
    (object) [
        'email' => 'demo@demo.demo',
        'password' => '123456'
    ]
)->set();
// save data to database
// syntax: (object) [
//    <column name>(string) => <data>(string),
//    ...,
// ]