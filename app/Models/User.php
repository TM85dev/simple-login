<?php

namespace app\Models;

use app\Models\DB;
use app\Traits\TraitRes;

class User {
    use TraitRes;

    protected $user;
    private $password = '';
    protected $request;

    public function get(object $request) {
        $db = new DB;
        $email = isset($request->email) ? $request->email : '';
        $this->user = $db->from('users')->where('email', $email)->get();
        $this->password = isset($request->password) ? md5($request->password) : $this->password;
        return $this->user;
    }
    public function create(object $request) {
        $db = new DB;
        $data = (object) [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ];
        $db->from('users')->insert($data)->set();
        if($db->error()) $this->error = 'Unable to create user';
        else $this->res = "User was created";
    }
    public function edit(object $request) {
        $db = new DB;
        $data = (object) [
            'name' => $request->new_name,
            'old_email' => $request->old_email,
            'email' => $request->new_email,
            'password' => $request->new_password
        ];
        $db->from('users')->update($data)->set();
        if($db->error()) $this->error = 'Unable to edit user';
        else $this->res = 'Edit user successfully';
    }
    public function remove(string $email) {
        $db = new DB;
        $data = (object) ['email' => $email];
        $db->from('users')->delete($data)->set();
        if($db->error()) $this->error = 'Unable to delete user';
        else $this->res = 'Delete user successfully';
    }
}

?>