<?php
return array(
    'YUNZHI_PAGE_SIZE'      => 2,          //默认分页大小

	'DEFAULT_MODULE'        => 'Login',  // 默认模块
    'ACTION_SUFFIX'         => 'Action',//设置ACTION前缀为action
    'TAGLIB_PRE_LOAD'       => 'Yunzhi',   // 需要额外加载的标签库(须指定标签库名称)，多个以逗号分隔 

    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__IMG__'       => __ROOT__ . '/public/image',
        '__CSS__'       => __ROOT__ . '/public/css',
        '__JS__'        => __ROOT__ . '/public/js',
        '__LIB__'       => __ROOT__ . '/public/lib',
    ),

   	'DB_PREFIX' => 'panjie_', // 数据库表前缀
   	'DB_TYPE'   => 'mysqli', // 数据库类型
    'DB_HOST'   => '127.0.0.1',
    'DB_NAME'   => 'panjie', // 数据库名performancems
    'DB_USER'   => 'root', // 用户名performancems
    'DB_PWD'    => '',  // 密码b2408cac49ed15d67c390dd08a8b0158
    'DB_PORT'   => '3306', // 端口3306);
    'PAGE_SIZE' => '4',//分页中，每页显示的条数使用C(PAGE_SIZE)读取;
);
