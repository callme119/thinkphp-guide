<?php
return array(
  'DEFAULT_MODULE'        => 'Login',  // 默认模块
    'ACTION_SUFFIX'         => 'Action',//设置ACTION前缀为action

    'DB_PREFIX' => 'yunzhi_', // 数据库表前缀
    'DB_TYPE'   => 'mysqli', // 数据库类型
    'DB_HOST'   => '127.0.0.1',
    'DB_NAME'   => 'test', // 数据库名performancems
    'DB_USER'   => 'root', // 用户名performancems
    'DB_PWD'    => '',  // 密码b2408cac49ed15d67c390dd08a8b0158
    'DB_PORT'   => '3306', // 端口3306);
    'PAGE_SIZE' => '4',//分页中，每页显示的条数使用C(PAGE_SIZE)读取;
    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__IMG__'       => __ROOT__ . '/Public/img',
        '__CSS__'       => __ROOT__ . '/Public/css',
        '__JS__'        => __ROOT__ . '/Public/js',
        '__LIB__'       => __ROOT__ . '/Public/lib',
      )
);