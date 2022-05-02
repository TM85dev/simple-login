# Simple Login

#### Simple login and register system

1. **Info**  
   Login and register system created with PHP (7.4 +) and JavaScript.  
   For back-end I use MVC architectural pattern. Every classes for this pattern are located in app folder.  
   Include files I use autoloader script.  
   Added some styles using sass (stored in assets/scss).  
   For manage requests from front-end I use TypeScript.  

2. **Functionality**  
   *DB class* - connects to database and get/input/edit/delete data.
   
| Action        | Using                                                          | return          |
| ------------- | -------------------------------------------------------------- |:---------------:|
| get data      | $db->from($table_name)->where($column_name, $value)->getAll(); | array[objects]  |
| get data      | $db->from($table_name)->where($column_name, $value)->get();    | object          |
| create data   | $db->from($table_name)->insert($data)->set();                  | res             |
| edit data     | $db->from($table_name)->update($data)->set();                  | res             |
| delete data   | $db->from($table_name)->delete($data)->set();                  | res             |  
```php
$db = new DB;
$table_name;     // string //
$column_name;    // string //
$value;          // string //
$data;           // object //
/* if 'res' you can get information about request from helper methods(response, error) */
$db->response(); // return when success //
$db->error();    // return when error //
```  

   *User class* - get/create/edit/delete user from database.
| Action        | Using                   |  return  |
| ------------- | ----------------------- |:--------:|
| get user      | $user->get($data);      | object   |
| create user   | $user->create($data);   | res      |
| edit user     | $user->edit($data);     | res      |
| delete user   | $user->remove($email);  | res      |  
```php
$user = new User;
$data;            // object //
$email;           // string //
/* if 'res' you can get information about request from helper methods(response, error) */
$db->response(); // return when success //
$db->error();    // return when error //
```

  *Auth class* - user authentication.
| Action        | Using                 | return  |
| ------------- | --------------------- |:-------:|
| get auth user | Auth::user();         | object  |
| login user    | Auth::login($data);   | res     |
| logout user   | Auth::logout();       | res     |  
```php
$data;           // object //
/* if 'res' you can get information about request from helper methods(response, error) */
$db->response(); // return when success //
$db->error();    // return when error //
```

*Validator* - validate data.
| Action         | Using                                 | return  |
| -------------- | ------------------------------------- |:-------:|
| set validation | $validator = new Validator($props);   |         |
| validate data  | $validator->validate($data);          |         |  
```php
$props = (object);
$data = (object);
```

*Session* - controlls session.
| Action              | Using                           | return  |
| ------------------- | ------------------------------- |:-------:|
| start session       | Session::start();               |         |
| check session       | Session::isAuth($location);     |         |  
| check session       | Session::isNotAuth($location);  |         |  
| destroy session     | Session::stop();                |         |  
| remove from session | Session::remove($data_remove);  |         |  
```php
$location = 'index.php';
$data_remove = string or array;
```

Example
```php
$db = new DB;
$db->from('user')->where('email', $email)->get();
---
$user = new User;
$user->get(
    (object) [
        'email' => $email,
    ]
);
---
Auth::user();
```

