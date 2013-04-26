<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Form validation rules */
$config = array(
    'signup_app' => array(
      array(
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'trim|required|alpha_dash|is_unique[User.Username]'),
      array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required|min_length[6]|max_length[64]'),
      array(
        'field' => 'confirm',
        'label' => 'Password confirmation',
        'rules' => 'required|matches[password]'),
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'trim|required|valid_email|is_unique[User.Email]'),
      array(
        'field' => 'name',
        'label' => 'Name',
        'rules' => 'trim|required'),
      array(
        'field' => 'sex',
        'label' => 'Sex',
        'rules' => 'required'),
      array(
        'field' => 'birthday',
        'label' => 'Birthday',
        'rules' => 'max_length[10]'),
      array(
        'field' => 'region',
        'label' => 'Region',
        'rules' => 'greater_than[0]'),
      array(
        'field' => 'address',
        'label' => 'Address',
        'rules' => 'max_length[256]'),
      array(
        'field' => 'description',
        'label' => 'Description',
        'rules' => 'max_length[512]')),

    'signup_emp' => array(
      array(
        'field' => 'username',
        'label' => 'Username',
        'rules' => 'trim|required|alpha_dash|is_unique[User.Username]'),
      array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'required|min_length[6]|max_length[64]'),
      array(
        'field' => 'confirm',
        'label' => 'Password confirmation',
        'rules' => 'required|matches[password]'),
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'trim|required|valid_email|is_unique[User.Email]'),
      array(
        'field' => 'name',
        'label' => 'Name',
        'rules' => 'trim|required'),
      array(
        'field' => 'region',
        'label' => 'Region',
        'rules' => 'greater_than[0]'),
      array(
        'field' => 'address',
        'label' => 'Address',
        'rules' => 'max_length[256]'),
      array(
        'field' => 'category',
        'label' => 'Category',
        'rules' => 'max_length[256]'),
      array(
        'field' => 'size',
        'label' => 'Size',
        'rules' => 'max_length[2]'),
      array(
        'field' => 'description',
        'label' => 'Description',
        'rules' => 'max_length[512]')
      ),

   'profile_app' => array(
      array(
        'field' => 'password',
        'label' => 'Password',
        'rules' => 'min_length[6]|max_length[64]'),
      array(
        'field' => 'confirm',
        'label' => 'Password confirmation',
        'rules' => 'matches[password]'),
      array(
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'trim|required|valid_email'),
      array(
        'field' => 'name',
        'label' => 'Name',
        'rules' => 'trim|required'),
      array(
        'field' => 'sex',
        'label' => 'Sex',
        'rules' => 'required'),
      array(
        'field' => 'birthday',
        'label' => 'Birthday',
        'rules' => 'max_length[10]'),
      array(
        'field' => 'region',
        'label' => 'Region',
        'rules' => 'greater_than[0]'),
      array(
        'field' => 'address',
        'label' => 'Address',
        'rules' => 'max_length[256]'),
      array(
        'field' => 'description',
        'label' => 'Description',
        'rules' => 'max_length[512]')
    ),

    'profile_emp' => array(
        array(
          'field' => 'password',
          'label' => 'Password',
          'rules' => 'min_length[6]|max_length[64]'),
        array(
          'field' => 'confirm',
          'label' => 'Password confirmation',
          'rules' => 'matches[password]'),
        array(
          'field' => 'email',
          'label' => 'Email',
          'rules' => 'trim|required|valid_email'),
        array(
          'field' => 'name',
          'label' => 'Name',
          'rules' => 'trim|required'),
        array(
          'field' => 'region',
          'label' => 'Region',
          'rules' => 'greater_than[0]'),
        array(
          'field' => 'address',
          'label' => 'Address',
          'rules' => 'max_length[256]'),
        array(
          'field' => 'category',
          'label' => 'Category',
          'rules' => 'max_length[256]'),
        array(
          'field' => 'size',
          'label' => 'Size',
          'rules' => 'max_length[2]'),
        array(
          'field' => 'description',
          'label' => 'Description',
          'rules' => 'max_length[512]')
        ),

    'job' => array(
        array(
          'field' => 'id',
          'label' => 'ID',
          'rules' => 'is_natural'),
        array(
          'field' => 'name',
          'label' => 'Name',
          'rules' => 'trim|required|max_length[128]'),
        array(
          'field' => 'category',
          'label' => 'Category',
          'rules' => 'max_length[255]'),
        array(
          'field' => 'min_salary',
          'label' => 'Min salary',
          'rules' => 'numeric'),
        array(
          'field' => 'max_salary',
          'label' => 'Max salary',
          'rules' => 'numeric'),
        array(
          'field' => 'max_salary',
          'label' => 'Max salary',
          'rules' => 'numeric'),
        array(
          'field' => 'name',
          'label' => 'Name',
          'rules' => 'max_length[10]'),
        array(
          'field' => 'region',
          'label' => 'Region',
          'rules' => 'greater_than[0]'),
        array(
          'field' => 'address',
          'label' => 'Address',
          'rules' => 'max_length[256]'),
        array(
          'field' => 'description',
          'label' => 'Description',
          'rules' => 'max_length[1024]')
        )
    );
