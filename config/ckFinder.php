<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', 0);

return [

    'authentication' => true,
    'licenseName' => '',
    'licenseKey' => '',
    'privateDir' => [
        'backend' => storage_path('app/public/editor/file/default'),
        'tags' => storage_path('app/public/editor/file/tags'),
        'logs' => storage_path('app/public/editor/file/logs'),
        'cache' => storage_path('app/public/editor/file/cache'),
        'thumbs' => storage_path('app/public/editor/file/thumb'),
    ],

    'images' => [
        'maxWidth' => 1600,
        'maxHeight' => 1200,
        'quality' => 80,
        'sizes' => [
            'small' => ['width' => 480, 'height' => 320, 'quality' => 80],
            'medium' => ['width' => 600, 'height' => 480, 'quality' => 80],
            'large' => ['width' => 800, 'height' => 600, 'quality' => 80],
        ],
    ],

    'backends' => [
        [
            'name' => 'default',
            'adapter' => 'local',
            'baseUrl' => storage_path('app/public/editor/file'),
            //  'root'         => '', // Can be used to explicitly set the CKFinder user files directory.
            'chmodFiles' => 0777,
            'chmodFolders' => 0755,
            'filesystemEncoding' => 'UTF-8',
        ],
    ],
    'defaultResourceTypes' => '',
    'resourceTypes' => [
        [
            'name' => 'Files', // Single quotes not allowed.
            'directory' => 'files',
            'maxSize' => 0,
            'allowedExtensions' => '7z,aiff,asf,avi,bmp,csv,doc,docx,fla,flv,gif,gz,gzip,jpeg,jpg,mid,mov,mp3,mp4,mpc,mpeg,mpg,ods,odt,pdf,png,ppt,pptx,qt,ram,rar,rm,rmi,rmvb,rtf,sdc,swf,sxc,sxw,tar,tgz,tif,tiff,txt,vsd,wav,wma,wmv,xls,xlsx,zip',
            'deniedExtensions' => '',
            'backend' => 'default',
        ],
        [
            'name' => 'Images',
            'directory' => 'images',
            'maxSize' => 0,
            'allowedExtensions' => 'bmp,gif,jpeg,jpg,png',
            'deniedExtensions' => '',
            'backend' => 'default',
        ],
    ],
    'roleSessionVar' => 'CKFinder_UserRole',
    'accessControl' => [
        'role' => '*',
        'resourceType' => '*',
        'folder' => '/',
        'FOLDER_VIEW' => true,
        'FOLDER_CREATE' => true,
        'FOLDER_RENAME' => true,
        'FOLDER_DELETE' => true,
        'FILE_VIEW' => true,
        'FILE_CREATE' => true,
        'FILE_RENAME' => true,
        'FILE_DELETE' => true,
        'IMAGE_RESIZE' => true,
        'IMAGE_RESIZE_CUSTOM' => true,
    ],
    'overwriteOnUpload' => false,
    'checkDoubleExtension' => true,
    'disallowUnsafeCharacters' => false,
    'secureImageUploads' => true,
    'checkSizeAfterScaling' => true,
    'htmlExtensions' => [
        'html',
        'htm',
        'xml',
        'js',
    ],
    'hideFolders' => [
        '.*',
        'CVS',
        '__thumbs',
    ],
    'hideFiles' => [
        '.*',
    ],
    'forceAscii' => false,
    'xSendfile' => false,
    'debug' => false,
    'pluginsDirectory' => __DIR__.'/plugins',
    'plugins' => [

    ],
    'cache' => [
        'imagePreview' => 24 * 3600,
        'thumbnails' => 24 * 3600 * 365,
        'proxyCommand' => 0,
    ],
    'tempDirectory' => sys_get_temp_dir(),
    'sessionWriteClose' => true,
    'csrfProtection' => true,
    'headers' => [

    ],
];
