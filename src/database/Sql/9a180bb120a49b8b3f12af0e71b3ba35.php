<?php

return array (
  'new-db' => 
  array (
    'admin_users' => 
    array (
      '53c645a0e831a3757daf9938ea7e02c19d7ac10ea016418ae95fe0fe4dc7fd66a695d4dc' => 
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
      '53c645a0e831a3757daf9938ea7e02c1198c714ea3f3d7653aae91b259ce2437b8c0b999' => 
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
      '34c888a08a350bdf4d5f23a914240b436314e624cbe6d581d4885ffcd732ac6fcc5a114d' => 
      array (
        'query' => 'UPDATE admin_users SET username = :username , email = :email , allow_global_edit = :allow_global_edit  WHERE adminid = :adminid ',
        'bind' => 
        array (
          'username' => 'wekiwork',
          'email' => 'helloamadiify@gmail.com',
          'allow_global_edit' => '1',
          'adminid' => '2',
        ),
      ),
      '9b8bffe4dbea279b0c6f89ad01d7633f9ee9afc689bd05994c0d6fa0316f63652bbcf039' => 
      array (
        'query' => 'UPDATE admin_users SET username = :username , email = :email  WHERE adminid = :adminid ',
        'bind' => 
        array (
          'username' => 'wekiwork',
          'email' => 'helloamadiify@gmail.com',
          'adminid' => '2',
        ),
      ),
      '60393c73636b29dbd17560ad9050cd08463b68d6f29f947441bb0b65c4f9581700da5235' => 
      array (
        'query' => 'UPDATE admin_users SET username = :username  WHERE adminid = :adminid ',
        'bind' => 
        array (
          'username' => 'wekiwork',
          'adminid' => '2',
        ),
      ),
      '1567f99d5a0c51ed972d49c72e6298bec620b0d47dcb19ecde675bc37b3552f2d3e702df' => 
      array (
        'query' => 'UPDATE admin_users SET password = :password , password_salt = :password_salt  WHERE adminid = :adminid ',
        'bind' => 
        array (
          'password' => '$2y$10$ncOMYM/DQIF21KeU6QWKQ.yqF26yPl3aQ5VeL/h9WKUbYqvEOo6ny',
          'password_salt' => '85344cfa597e15df733c700e87f4c1f5',
          'adminid' => '2',
        ),
      ),
      '34c888a08a350bdf4d5f23a914240b43799bd57c6394f22031406501d839a9b30983cf18' => 
      array (
        'query' => 'UPDATE admin_users SET username = :username , email = :email , allow_global_edit = :allow_global_edit  WHERE adminid = :adminid ',
        'bind' => 
        array (
          'username' => 'wekiwork',
          'email' => 'helloamadiify@gmail.com',
          'allow_global_edit' => '0',
          'adminid' => '2',
        ),
      ),
      'f8db24ecb871f1c9ebe8f800e486d45ca1fd54cb110087fa76c002e9bee10fa5e8ebd6ee' => 
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
    ),
    'service_requests' => 
    array (
      'a04ccdc5128f25ba32793e147f26304ab36be96c548acccd24bd875951ae23b60ae6c0e2' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '20000',
          'statusid' => '4',
          'mechanicid' => '4',
          'serviceid' => '6',
        ),
      ),
      'a04ccdc5128f25ba32793e147f26304a61c321e2da209a3f12bd9b1a9afb9cae2e6bfab1' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '20000',
          'statusid' => '4',
          'mechanicid' => '1',
          'serviceid' => '6',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b91ecb92426e19e6fcb951038af6b6f2e2c21d64f4f' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '90000',
          'statusid' => '4',
          'mechanicid' => '1',
          'date_assigned' => '1641655884',
          'serviceid' => '5',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b9161c321e2da209a3f12bd9b1a9afb9cae2e6bfab1' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '20000',
          'statusid' => '4',
          'mechanicid' => '1',
          'date_assigned' => '',
          'serviceid' => '6',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b91753fafcc632378530f715581c627418852ccf5dc' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '30000',
          'statusid' => '4',
          'mechanicid' => '1',
          'date_assigned' => '1641717674',
          'serviceid' => '2',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b91e6866a8d2e80072564963b01f6ff786c188a47c9' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '30000',
          'statusid' => '4',
          'mechanicid' => '1',
          'date_assigned' => '1641717792',
          'serviceid' => '2',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b910328519ac31d9a28e8814b9053c126ae28edc569' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '30000',
          'statusid' => '4',
          'mechanicid' => '1',
          'date_assigned' => '1641718337',
          'serviceid' => '2',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b9117e13a76bdbe0ddbc312329cb9bcf466f4bcb3b0' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '20000',
          'statusid' => '4',
          'mechanicid' => '1',
          'date_assigned' => '1641718674',
          'serviceid' => '2',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b917ba8ad4809a24fea90347306a7a65fc00655928c' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '20000',
          'statusid' => '4',
          'mechanicid' => '1',
          'date_assigned' => '1641718878',
          'serviceid' => '2',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b9195368bea277f98a0f3fbcf120c5bc4a38c27eebe' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '40000',
          'statusid' => '4',
          'mechanicid' => '1',
          'date_assigned' => '1641732700',
          'serviceid' => '2',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b91e21a130616d708585fd1c290d33b56cbf61ade91' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '67000',
          'statusid' => '4',
          'mechanicid' => '1',
          'date_assigned' => '1641733097',
          'serviceid' => '2',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b91e1f3df2d28ad0d7e49383b5ecbece91873bf1ec1' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '56000',
          'statusid' => '4',
          'mechanicid' => '1',
          'date_assigned' => '1641733186',
          'serviceid' => '2',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b91118d503d2553cc29a634e07fbb39df737067570e' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '24000',
          'statusid' => '4',
          'mechanicid' => '1',
          'date_assigned' => '1641734066',
          'serviceid' => '2',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b9111d2250385e5bebd4841fef28d537925898de4c3' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '24000',
          'statusid' => '2',
          'mechanicid' => '1',
          'date_assigned' => '1641734066',
          'serviceid' => '2',
        ),
      ),
      '38dfdbcf7e2e4d1baeb64378def39b91b64fd27c69a726d1b1cd06c3147c09f9dd559202' => 
      array (
        'query' => 'UPDATE service_requests SET service_fee = :service_fee , statusid = :statusid , mechanicid = :mechanicid , date_assigned = :date_assigned  WHERE serviceid = :serviceid ',
        'bind' => 
        array (
          'service_fee' => '40000',
          'statusid' => '4',
          'mechanicid' => '4',
          'date_assigned' => '1641754466',
          'serviceid' => '7',
        ),
      ),
    ),
    'mechanics' => 
    array (
      'b714f17261a659ca5a31bcbf79e16d604837aff13c5697d166248cda50a8f7b468d4ac3e' => 
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
      'b714f17261a659ca5a31bcbf79e16d6049633cfca57a1e387c5d37ce88f036571f7cb3aa' => 
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
      '7ff439818a9817427679213be56ab2c6d475e43336dd442cbfaef8cb11e23e8065081f1f' => 
      array (
        'query' => 'UPDATE mechanics SET mechanic_name = :mechanic_name , mechanic_email = :mechanic_email , mechanic_phone = :mechanic_phone , stateid = :stateid  WHERE mechanicid = :mechanicid ',
        'bind' => 
        array (
          'mechanic_name' => 'AutoFixer Global',
          'mechanic_email' => 'support@autofixer.com.ng',
          'mechanic_phone' => '08000000000',
          'stateid' => '14',
          'mechanicid' => 4,
        ),
      ),
      'b714f17261a659ca5a31bcbf79e16d60d533661695ea4d26413a255c25a0e8e2c535b908' => 
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
    ),
  ),
);

?>