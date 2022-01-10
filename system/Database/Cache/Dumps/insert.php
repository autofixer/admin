<?php

return array (
  '28bf7ba35400812c36eaa768b7c9e7a5' => 
  array (
    'query' => 'INSERT INTO admin_users (username,email,password,password_salt) VALUES (:username0,:email0,:password0,:password_salt0)',
    'bind' => 
    array (
      'username0' => 'wekiwork',
      'email0' => 1,
      'password0' => '$2y$10$ImFquI5KS9TsaR7NBGoUZ.J4pOeVPDkeNZZoVxQPxURsHDPvXNqyO',
      'password_salt0' => '2ce696285a6da5d76c65f4ff79858a67',
    ),
  ),
  '25e80fca3bf83302d48e8427dd6aa0d8' => 
  array (
    'query' => 'INSERT INTO admin_users (username,email,password,password_salt) VALUES (:username0,:email0,:password0,:password_salt0)',
    'bind' => 
    array (
      'username0' => 'wekiwork',
      'email0' => 'helloamadiify@gmail.com',
      'password0' => '$2y$10$r9TNHFEY.KApPhEZpdivvunK0233VX8kHQhN0L3myf1SuyeIQ/igW',
      'password_salt0' => 'fce1d0ff3ca4fc197c303046e80bb03f',
    ),
  ),
  '5b89bbbe19d9081989cac51cf3ca629e' => 
  array (
    'query' => 'SELECT mechanicid FROM mechanics {where}',
    'bind' => 
    array (
    ),
  ),
  '8502a2cd190de66176a9adc0ea0e614d' => 
  array (
    'query' => 'INSERT INTO mechanics (mechanic_name,mechanic_email,mechanic_phone,stateid) VALUES (:mechanic_name0,:mechanic_email0,:mechanic_phone0,:stateid0)',
    'bind' => 
    array (
      'mechanic_name0' => 'Ifeanyi Amadi',
      'mechanic_email0' => 'hellojoesphi@gmail.com',
      'mechanic_phone0' => '07017170555',
      'stateid0' => 3,
    ),
  ),
  '277474eebb950c0629c12f6a0c3408ec' => 
  array (
    'query' => 'SELECT adminid FROM admin_users {where}',
    'bind' => 
    array (
    ),
  ),
  '5dd4721a1588c52376349ac9f4ac646c' => 
  array (
    'query' => 'SELECT quoteid FROM service_quotes {where}',
    'bind' => 
    array (
    ),
  ),
  'b34c2373ee278255337b4090e2701f72' => 
  array (
    'query' => 'SELECT serviceid FROM service_requests {where}',
    'bind' => 
    array (
    ),
  ),
  '00a4e43c618fecc3f4f123995df388f7' => 
  array (
    'query' => 'SELECT contactid FROM contact_messages {where}',
    'bind' => 
    array (
    ),
  ),
  '0d9e0966403767d339f142049628b70a' => 
  array (
    'query' => 'SELECT subscriberid FROM newsletter_subscribers {where}',
    'bind' => 
    array (
    ),
  ),
  '25278b4e6ec099e8d8b81ee80778350c' => 
  array (
    'query' => 'SELECT * FROM country_states {where}',
    'bind' => 
    array (
    ),
  ),
  '483c13dd5279f716a849bc9b7bce7dba' => 
  array (
    'query' => 'INSERT INTO mechanics (mechanic_name,mechanic_email,mechanic_phone,stateid) VALUES (:mechanic_name0,:mechanic_email0,:mechanic_phone0,:stateid0)',
    'bind' => 
    array (
      'mechanic_name0' => 'Ifeanyi Amadi',
      'mechanic_email0' => 'hellojoesphi@gmail.com',
      'mechanic_phone0' => '07017170555',
      'stateid0' => '14',
    ),
  ),
  '67dd84ca59a5f860129e62bf12219a3b' => 
  array (
    'query' => 'INSERT INTO admin_users (username,email,password,password_salt,allow_global_edit) VALUES (:username0,:email0,:password0,:password_salt0,:allow_global_edit0)',
    'bind' => 
    array (
      'username0' => 'autofixer global',
      'email0' => 'admin@autofixer.com.ng',
      'password0' => '$2y$10$IGREhXtz07j4P8Y/1LUPUOgohkp0EpJrWojmVlDPkZ.BMsFchJywi',
      'password_salt0' => 'ac3db3a3b4774b8b02d7db0be0735cb9',
      'allow_global_edit0' => 1,
    ),
  ),
  'a8b44ca54c6b7fa2e69434f52e9a302e' => 
  array (
    'query' => 'INSERT INTO mechanics (mechanic_name,mechanic_email,mechanic_phone,stateid) VALUES (:mechanic_name0,:mechanic_email0,:mechanic_phone0,:stateid0)',
    'bind' => 
    array (
      'mechanic_name0' => 'Grove Paul',
      'mechanic_email0' => 'grove@example.com',
      'mechanic_phone0' => '07017170555',
      'stateid0' => '14',
    ),
  ),
);
