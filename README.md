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
// Example
$db = new DB;
$db->from('user')->where('email', 'test@test.test')->get();
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
// Example
$user = new User;
$user->get(
    (object) [
        'email' => 'test@test.test',
    ]
);
```

  *Auth class* - user authentication.
| Action        | Using                 | return  |
| ------------- | --------------------- |:-------:|
| get auth user | Auth::user();         | object  |
| login user    | Auth::login($data);   | boolean |
| logout user   | Auth::logout();       | boolean |  
```php
$data;           // object //
/* if 'boolean' it return (boolean) 'true' for success or 'false' for failed action */
// Example
Auth::login((object) [
   'email' => 'test@test.test',
   'password' => 'Test123!'
]);
```

*Validator class* - validate data.
| Action           | Using                                 | return  |
| ---------------- | ------------------------------------- |:-------:|
| set validation   | $validator = new Validator($props);   |         |
| validate data    | $validator->validate($data);          |         |  
| check for error  | $validator->error();                  | string  |  
```php
$props = (object) ['key' => 'type']; // object //
/*
'key' - name value like 'email' or 'name'
'type' - type of value like 'required', 'password'. You can pass more than one value separating '|'
Types you can use:
'required' - value is required,
'min:nr' - minimal length value is required [nr - number of length],
'max:nr' - maximal length value is required [nr - number of length],
'email' - value must have email syntax,
'password' - value must have min 1 number, 1 uppercase string, 1 lowercase string, and 1 special character,
'confirm_password' - check if passing object has password type and compare this two values ('password' value must be declared in passing object),
'unique_table' - check if passing value is already in database. Value after '_' is the name of table in database ex. 'unique_users',
'is_hashed' - if passing with password like 'password|is_hashed' it define that password has already hashed and will not be validated like 'password' (min values not required)
*/
$data = (object) ['name' => 'value'];
/*
'name' - name must be the same as in the $props object passed when creating new Validator,
'value' - value for specific name. Will be cheked validation requirements.
*/
// Example
$validator = new Validator((object) [
   'name' => 'required',
   'email' => 'unique_users|min:6|email',
   'password' => 'password',
   'confirm_password' => 'confirm_password'
]);
$validator->validate((object) [
   'name' => 'test',
   'email' => 'test@test.test',
   'password' => 'Test123!',
   'confirm_password' => 'Test123!'
]);
if($validator->error()) // error //;
else // do some action //;
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
$location; // string //
$data_remove; // string | array //
// Example
Session::isAuth('index');
```

*Request* - controlls incoming requests.
| Action                | Using                                        | return  |
| --------------------- | -------------------------------------------- |:-------:|
| initialize Request    | $request = new Request;                      |         |
| get data from request | $request->method($method)->format('$format); | object  |  
```php
$request = new Request;
$method; // string //
/*
Methods: GET, POST, PUT, PATCH, DELETE
default = GET
*/
$format // string //
/*
Formats: raw, json
default = raw
*/
// Example
$request = new Request;
$req = $request->method('POST')->format('json');
echo $req;
```



