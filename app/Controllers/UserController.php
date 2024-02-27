<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\GenderModel;

class UserController extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
    public function addUser()
    {
        $data = array();
        helper('form');

        //When button save clicked
        if($this->request == 'post'){
            $post = $this->request->getPost(['first_name', 'middle_name', 'last_name', 'age', 'gender_id', 'email', 'password']);

            //Provide rules
            $rules = [
                'first_name' => ['label' => 'first_name', 'rules' => 'required'],
                'middle_name' => ['label' => 'middle_name', 'rules' => 'permit_empty'],
                'last_name' => ['label' => 'last_name', 'rules' => 'required'],
                'age' => ['label' => 'age', 'rules' => 'required|numeric'],
                'gender_id' => ['required'],
                'email' => ['label' => 'email', 'rules' => 'required|is_unique[users.email]'],
                'password' => ['label' => 'password', 'rules' => 'required_with[password]|matches[password]']
            ];

            //Check if one of the field has error, otherwise save to database
            if(! $this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                //Encrpyt password
                $post['password'] = sha1($post['password']);

                $userModel = new UserModel();
                $userModel->save($post);

                return('User Successfully Saved!');
            }      
        }

        $genderModel = new GenderModel();
        $data['genders'] = $genderModel->findAll();
        return view('user/add', $data);
    }
}

