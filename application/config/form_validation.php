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
        'rules' => 'max_length[512]')
      ),

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
          'field' => 'status',
          'label' => 'Status',
          'rules' => 'is_natural|greater_than[-1]|less_than[2]'),
        array(
          'field' => 'level',
          'label' => 'Level',
          'rules' => 'required|greater_than[0]'),
        array(
          'field' => 'category',
          'label' => 'Category',
          'rules' => 'required|greater_than[0]'),
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
          'field' => 'expire',
          'label' => 'Expire date',
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
          'rules' => 'max_length[1024]'),
        array(
          'field' => 'edu_req',
          'label' => 'Education',
          'rules' => 'max_length[256]'),
        array(
          'field' => 'skill_req',
          'label' => 'Skills',
          'rules' => 'max_length[256]'),
        array(
          'field' => 'lang_req',
          'label' => 'Languages',
          'rules' => 'max_length[256]'),
        array(
          'field' => 'exp_req',
          'label' => 'Experience',
          'rules' => 'max_length[256]')
        ),

    'cv' => array(
        array(
          'field' => 'id',
          'label' => 'ID',
          'rules' => 'is_natural'),
        array(
          'field' => 'subject',
          'label' => 'Subject',
          'rules' => 'trim|required|max_length[128]'),
        array(
          'field' => 'status',
          'label' => 'Status',
          'rules' => 'is_natural|greater_than[-1]|less_than[2]'),
        array(
          'field' => 'edu_lev',
          'label' => 'Education level',
          'rules' => 'max_length[256]'),
        array(
          'field' => 'skill',
          'label' => 'Skills',
          'rules' => 'max_length[256]'),
        array(
          'field' => 'language',
          'label' => 'Language',
          'rules' => 'max_length[256]'),
        array(
          'field' => 'exp',
          'label' => 'Experience',
          'rules' => 'max_length[256]'),
        array(
          'field' => 'region',
          'label' => 'Region',
          'rules' => 'greater_than[0]'),
        array(
          'field' => 'add_info',
          'label' => 'Additional information',
          'rules' => 'max_length[256]')
        ),
    'application' => array(
        array(
          'field' => 'job',
          'label' => 'Job',
          'rules' => 'required|is_natural_no_zero'),
        array(
          'field' => 'euid',
          'label' => 'Employer ID',
          'rules' => 'required|is_natural_no_zero'),
        array(
          'field' => 'cv',
          'label' => 'CV',
          'rules' => 'required|is_natural_no_zero')
        ),
    'invitation' => array(
        array(
          'field' => 'cid',
          'label' => 'CV ID',
          'rules' => 'required|is_natural_no_zero'),
        array(
          'field' => 'auid',
          'label' => 'Applicant ID',
          'rules' => 'required|is_natural_no_zero'),
        array(
          'field' => 'job',
          'label' => 'Job',
          'rules' => 'required|is_natural_no_zero')
        )
    );
