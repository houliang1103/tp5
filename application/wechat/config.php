<?php
//配置文件
return [
    'weixin' => [
        /**
         * Debug 模式，bool 值：true/false
         *
         * 当值为 false 时，所有的日志都不会记录
         */
        'debug' => true,

        /**
         * 账号基本信息，请从微信公众平台/开放平台获取
         */
        'app_id' => 'wxf8971c7ab559e8d2',         // AppID
        'secret' => '0d69d45b8f74275924b6549d0d83dc9b',     // AppSecret
        'token' => 'weixin',          // Token
        'aes_key' => '',                    // EncodingAESKey，安全模式与兼容模式下请一定要填写！！！

        /**
         * 日志配置
         *
         * level: 日志级别, 可选为：
         *         debug/info/notice/warning/error/critical/alert/emergency
         * permission：日志文件权限(可选)，默认为null（若为null值,monolog会取0644）
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level' => 'debug',
            'permission' => 0777,
            'file' => '/tmp/easywechat.log',
        ],

        /**
         * OAuth 配置
         *
         * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
         * callback：OAuth授权完成后的回调页地址
         */
        'oauth' => [
            'scopes' => ['snsapi_userinfo'],
            'callback' => '/wechat/user/call',
        ],

        /**
         * 微信支付
         */
        'payment' => [
            'merchant_id' => 'your-mch-id',
            'key' => 'key-for-signature',
            'cert_path' => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
            'key_path' => 'path/to/your/key',      // XXX: 绝对路径！！！！
            // 'device_info'     => '013467007045764',
            // 'sub_app_id'      => '',
            // 'sub_merchant_id' => '',
            // ...
        ],
        'guzzle' => [
            'timeout' => 3.0, // 超时时间（秒）
            'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
        ],

    ]

];