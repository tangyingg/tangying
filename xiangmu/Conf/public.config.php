<?php
/**
 * Ar default public config file.
 *
 * @author ycassnr <ycassnr@gmail.com>
 */
return array(
    // 组件配置开始
    'components' => array(
        // 懒惰加载
        'lazy' => true,
        'db' => array(
            // 懒惰加载
            'lazy' => true,
            // mysql数据库组件
            'mysql' => array(
                'config' => array(
                    // 读库
                    'read' => array(
                        // 默认读库配置
                        'default' => array(
                            // 'dsn' =>'mysql:host=211.149.195.135;dbname=ceshi;port=9906',
                            // 'user' => 'mzmtest',
                            // 'pass' => 'mzmtest2016',
                            'dsn' => 'mysql:host=localhost;dbname=signup;port=3306',
                            'user' => 'root',
                            'pass' => 'root',
                            'prefix' => '',
                            'option' => array(
                                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
                                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
                            ),
                        ),

                    ),

                ),
            ),
        ),
        // mysql 配置结束
    ),

    // 关闭trace信息
    'DEBUG_SHOW_TRACE' => false,
    //'DEBUG_LOG' => 1,
    'TPL_SUFFIX' => html,



    // 项目
    'moduleLists' => array(
        'main',
        'admin'
    ),


);
