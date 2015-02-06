<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Name
	|--------------------------------------------------------------------------
	|
	| Application name is used for console applications for defining which
	| application folder we are in. It must be unique name for application
	|
	*/

	'name' => "my.app",

	/*
	|--------------------------------------------------------------------------
	| Theme Name
	|--------------------------------------------------------------------------
	|
	| Theme name is default theme which is used by this application. Because 
	| of being many application assets which are unique for this application
	| must be put in the theme folder.
	|
	*/

	'theme_name' => "my.theme",

	/*
	|--------------------------------------------------------------------------
	| Default Language
	|--------------------------------------------------------------------------
	|
	| Apllication is working with the language files which is in the folder
	| that you can set with this variable. 
	|
	*/

	'default_language' => 'en',
	
	/*
	|--------------------------------------------------------------------------
	| 
	|--------------------------------------------------------------------------
	|
	|
	|
	*/

	'default_namespace' 	=> '',
	'default_module' 		=> '',
	'default_controller' 	=> 'index',
	'default_action' 		=> 'index',

	/*
	|--------------------------------------------------------------------------
	| Extra/Trailing slashes
	|--------------------------------------------------------------------------
	|
	| Sometimes a route could be accessed with extra/trailing slashes and the 
	| end of the route, those extra slashes would lead to produce a not-found 
	| status in the dispatcher. You can set up the router to automatically 
	| remove the slashes from the end of handled route:
	|
	*/

	'extra_slashes' => false,

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => true,

	/*
	|--------------------------------------------------------------------------
	| Do you need HTML Minification ?
	|--------------------------------------------------------------------------
	|
	| HTML Minification is used for minify HTML buffer. U need Output 
	| Control Function is enabled like ob_start
	|
	*/

	'html_minify' => true,

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	|
	| Phalcon automatically may detect your baseUri, but if you want to 
	| increase the performance of your application is recommended setting up 
	| it manually:
	|
	*/

	'base-url' => null,

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default timezone for your application, which
	| will be used by the PHP date and date-time functions. We have gone
	| ahead and set this to a sensible default for you out of the box.
	|
	*/

	'timezone' => 'UTC',

	/*
	|--------------------------------------------------------------------------
	| Encryption of Cookies
	|--------------------------------------------------------------------------
	|
	| By default, cookies are automatically encrypted before be sent to the 
	| client and decrypted when retrieved. This protection allow unauthorized 
	| users to see the cookies’ contents in the client (browser). Although 
	| this protection, sensitive data should not be stored on cookies.
	|
	*/

	'cookie_encryption' => true,

	/*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	|
	| This key is used by the encrypting configuration file and should be set
	| to a random, 32 character string, otherwise these encrypted strings
	| will not be safe. Please do this before deploying an application!
	|
	*/

	'key' => 'this-is-my-secret-key',

	/*
	|--------------------------------------------------------------------------
	| Encryption Type
	|--------------------------------------------------------------------------
	|
	| This type is used by the encrypting configuration file and should be set
	| form http://php.net/manual/en/mcrypt.ciphers.php
	|
	*/

	'cipher' => MCRYPT_RIJNDAEL_256,

	/*
	|--------------------------------------------------------------------------
	| Encryption Type
	|--------------------------------------------------------------------------
	|
	| One of the encryption modes supported by libmcrypt (ecb, cbc, cfb, ofb)
	|
	*/

	'encryption_mode' => 'ecb',

	/*
	|--------------------------------------------------------------------------
	| Work Factor
	|--------------------------------------------------------------------------
	|
	| Sets the default working factor for bcrypts password’s salts
	|
	*/

	'work_factor' => 12,

	/*
	|--------------------------------------------------------------------------
	| Application Path Registration
	|--------------------------------------------------------------------------
	|
	| The third option is to register directories, in which classes could be 
	| found. This option is not recommended in terms of performance, since 
	| Phalcon will need to perform a significant number of file stats on each 
	| folder, looking for the file with the same name as the class. It’s  
	| important to register the directories in relevance order. 
	|
	| Remember always add a trailing slash at the end of the paths.
	|
	| Example Usage:
	|
	| array(
	|  	"library/MyComponent/",
	|  	"library/OtherComponent/Other/",
	|	"vendor/example/adapters/",
	|	"vendor/example/"
	| )    
	|
	*/

	'paths' => array(
		APPLICATION_PATH . 'controllers/',
        APPLICATION_PATH . 'models/',
        APPLICATION_PATH . 'tasks/'
    ),

	/*
	|--------------------------------------------------------------------------
	| Application Classes Registration
	|--------------------------------------------------------------------------
	|
	| The last option is to register the class name and its path. This 
	| autoloader can be very useful when the folder convention of the project 
	| does not allow for easy retrieval of the file using the path and the 
	| class name. This is the fastest method of autoloading. However the more 
	| your application grows, the more classes/files need to be added to this 
	| autoloader, which will effectively make maintenance of the class list 
	| very cumbersome and it is not recommended.
	|
	| Example Usage:
	|
	| array(
	| 	"Some"         => "library/OtherComponent/Other/Some.php",
	| 	"Example\Base" => "vendor/example/adapters/Example/BaseClass.php",
	| )  
	|
	*/

	'classes' => array(),

	/*
	|--------------------------------------------------------------------------
	| Registering Namespaces
	|--------------------------------------------------------------------------
	|
	| If you’re organizing your code using namespaces, or external libraries 
	| do so, the registerNamespaces() provides the autoloading mechanism. It 
	| takes an associative array, which keys are namespace prefixes and their 
	| values are directories where the classes are located in. The namespace 
	| separator will be replaced by the directory separator when the loader 
	| try to find the classes. Remember always to add a trailing slash at the 
	| end of the paths.
	|
	| Example Usage:
	|
	| array(
	| 	'Example\Base' => "vendor/example/base/"
	| )  
	|
	*/

	'namespaces' => array(
	),

	/*
	|--------------------------------------------------------------------------
	| Registering Prefixes
	|--------------------------------------------------------------------------
	|
	| This strategy is similar to the namespaces strategy. It takes an 
	| associative array, which keys are prefixes and their values are 
	| directories where the classes are located in. The namespace separator 
	| and the “_” underscore character will be replaced by the directory 
	| separator when the loader try to find the classes. Remember always to 
	| add a trailing slash at the end of the paths.
	|
	| Example Usage:
	|
	| array(
	| 	"Example_Base"     => "vendor/example/base/",
	| 	"Example_Adapter"  => "vendor/example/adapter/",
	| 	"Example_"         => "vendor/example/",
	| )
	|
	*/

	'prefixes' => array(),

	/*
	|--------------------------------------------------------------------------
	| Additional File Extensions
	|--------------------------------------------------------------------------
	|
	| Some autoloading strategies such as “prefixes”, “namespaces” or 
	| “directories” automatically append the “php” extension at the end of the 
	| checked file. If you are using additional extensions you could set it 
	| with the method “setExtensions”. 
	|
	*/

	'extensions' => array("php"),

	/*
	|--------------------------------------------------------------------------
	| Module Registration : SOON
	|--------------------------------------------------------------------------
	|
	| Module registration is used for setting all installed modules.
	|		
	| Example Usage:
	|
	| array(
	| 	'dashboard' => array(
	| 		'className' => 'Modules\Dashboard\Module',
	|		'path' => APPLICATION_PATH . 'modules/dashboard/Module.php'
	| 	)
	| )
	|
	*/

	'modules' => array()
);