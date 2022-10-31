<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,


    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'text'    => 'اعدادات المنصة',
            'icon'    => 'fas fa-cogs',
            'can'     => "manage-item",
            'url'     => 'settings',
        ],
        [
            'text'    => 'روابط الوردبريس',
            'icon'    => 'fab fa-wordpress',
            'can'     => "manage-item",
            'submenu' => [
                [
                    'text'    => 'التحليلات الفنية',
                    'icon'    => 'fas fa-fw fa-share',
                    'can'     => "manage-item",
                    'url'     => env('wordpress_url').'/wp-admin/edit.php?post_type=technical-analysis',
                    'target'  => '_blank'
                ],
                [
                    'text'    => 'تصنيفات التحليلات',
                    'icon'    => 'fas fa-fw fa-share',
                    'can'     => "manage-item",
                    'url'     => env('wordpress_url').'/wp-admin/edit-tags.php?taxonomy=analytics-category&post_type=technical-analysis',
                    'target'  => '_blank'
                ],
                [
                    'text'    => 'الفيديوهات',
                    'icon'    => 'fas fa-fw fa-share',
                    'can'     => "manage-item",
                    'url'     => env('wordpress_url').'/wp-admin/edit.php?post_type=videos',
                    'target'  => '_blank'
                ],
                [
                    'text'    => 'وسائل الدفع',
                    'icon'    => 'fas fa-fw fa-share',
                    'can'     => "manage-item",
                    'url'     => env('wordpress_url').'/wp-admin/edit.php?post_type=payments-methods',
                    'target'  => '_blank'
                ],
                [
                    'text'    => 'الخدمات',
                    'icon'    => 'fas fa-fw fa-share',
                    'can'     => "manage-item",
                    'url'     => env('wordpress_url').'/wp-admin/edit.php?post_type=services',
                    'target'  => '_blank'
                ],
            ]
        ],
        [
            'text'    => 'شركات التداول',
            'icon'    => 'fas fa-hand-holding-usd',
            'can'     => "manage-item",
            'submenu' => [
                [
                    'text' => 'عرض شركات التداول',
                    'icon_color' => 'red',
                    'url'  => 'forex-companies',
                ],
                [
                    'text' => 'اضافة شركة التداول',
                    'icon_color' => 'yellow',
                    'url'  => 'forex-companies/create',
                ]
            ]
        ],
        [
            'text'    => 'المشتركين الاعضاء',
            'icon'    => 'fas fa-users',
            'can'     => "manage-item",
            'submenu' => [
                [
                    'text' => 'عرض المشتركين الاعضاء',
                    'icon_color' => 'red',
                    'url'  => 'users',
                ]
            ]
        ],
        [
            'text'    => 'الحسابات',
            'icon'    => 'fas fa-user-circle',
            'can'     => "manage-item",
            'submenu' => [
                [
                    'text' => 'عرض الحسابات',
                    'icon_color' => 'yellow',
                    'url'  => 'accounts',
                ]
            ]
        ],
        [
            'text'    => 'حساباتى',
            'icon'    => 'fas fa-user-circle',
            'can'     => "manage-item-as-user",
            'submenu' => [
                [
                    'text' => 'حساباتى',
                    'icon_color' => 'red',
                    'url'  => 'my-accounts',
                ]
            ]
        ],
        [
            'text'    => 'الاكسبرتات',
            'icon'    => 'fas fa-file-excel',
            'can'     => "manage-item",
            'submenu' => [
                [
                    'text' => 'عرض الاكسبرتات',
                     'icon_color' => 'red',
                    'url'  => 'experts-files',
                ],
                [
                    'text' => 'اضافة اكسبرتات',
                    'icon_color' => 'orange',
                    'url'  => 'experts-files/create',
                ]
            ]
        ],
        [
            'text'    => 'مؤشر سليم',
            'icon'    => 'fas fa-file-excel',
            'can'     => "manage-item",
            'submenu' => [
                [
                    'text' => 'عرض ملفات مؤشر سليم',
                     'icon_color' => 'red',
                    'url'  => 'directrix-files',
                ],
                [
                    'text' => 'اضافة ملف مؤشر سليم',
                    'icon_color' => 'orange',
                    'url'  => 'directrix-files/create',
                ]
            ]
        ],
        [
            'text'    => 'طلبات شحن محفظتى ',
            'icon'    => 'fas fa-wallet',
            'can'     => "manage-item-as-user",
            'submenu' => [
                [
                    'text' => 'طلباتى',
                     'icon_color' => 'green',
                    'url'  => 'my-wallet',
                ]
            ]
        ],
        [
            'text'    => 'طلبات سحب من رصيدي ',
            'icon'    => 'fas fa-coins',
            'can'     => "manage-item-as-user",
            'submenu' => [
                [
                    'text' => 'طلباتى',
                     'icon_color' => 'green',
                    'url'  => 'my-withdraw-orders',
                ]
            ]
        ],
        [
            'text'    => 'كاش باك حساباتى ',
            'icon'    => 'fas fa-wallet',
            'can'     => "manage-item-as-user",
            'submenu' => [
                [
                    'text' => 'كاش باك حساباتى',
                     'icon_color' => 'green',
                    'url'  => 'my-cashbacks',
                ],
                [
                    'text' => 'كاش باك المنتهي',
                     'icon_color' => 'orange',
                    'url'  => 'my-expire-cashbacks',
                ]
            ]
        ],
        [
            'text'    => 'كاش باك الحسابات ',
            'icon'    => 'fas fa-wallet',
            'can'     => "manage-item",
            'submenu' => [
                [
                    'text' => 'كاش باك الحسابات',
                     'icon_color' => 'red',
                    'url'  => 'cashback-accounts',
                ],
                [
                    'text' => 'اضافة كاش باك',
                     'icon_color' => 'yellow',
                    'url'  => 'cashback/regenerate-cashback',
                ],
                [
                    'text' => 'استيراد كاش باك',
                     'icon_color' => 'yellow',
                    'url'  => 'cashback/import-cashback',
                ]
            ]
        ],
        [
            'text'    => 'خدماتى',
            'icon'    => 'fas fa-box',
            'can'     => "manage-item-as-user",
            'submenu' => [
                [
                    'text' => 'عرض خدماتى ',
                    'icon_color' => 'red',
                    'url'  => 'my-services',
                ]
            ]
        ],
        [
            'text'    => 'ملفات الاكسبرتات',
            'icon'    => 'fas fa-file-excel',
            'can'     => "manage-item-as-user",
            'submenu' => [
                [
                    'text' => 'ملفات الاكسبرتات ',
                    'icon_color' => 'red',
                    'url'  => 'my-experts-files',
                ]
            ]
        ],
        [
            'text'    => 'خدمة التوصيات',
            'icon'    => 'fas fa-file-excel',
            'can'     => "manage-item-as-user",
            'submenu' => [
                [
                    'text' => 'خدمة التوصيات',
                    'icon_color' => 'red',
                    'url'  => 'recommended-services/create',
                ]
            ]
        ],
        [
            'text'    => 'خدمة مؤشرات سليم',
            'icon'    => 'fas fa-file-excel',
            'can'     => "manage-item-as-user",
            'submenu' => [
                [
                    'text' => 'خدمة مؤشرات سليم',
                    'icon_color' => 'red',
                    'url'  => 'directrix-services',
                ]
            ]
        ],
        [
            'text'    => 'التسويق بالعمولة',
            'icon'    => 'fas fa-wallet',
            'can'     => "manage-item",
            'submenu' => [
                [
                    'text' => 'مسوقي العمولة',
                    'icon_color' => 'red',
                    'url'  => 'affiliaters',
                ],
                [
                    'text' => 'مرتبات الموظفين ',
                    'icon_color' => 'orange',
                    'url'  => 'affiliate-employmee',
                ],
                [
                    'text' => 'أرباح مسوقي العمولة',
                     'icon_color' => 'yellow',
                    'url'  => 'affiliates-profites',
                ],
                [
                    'text' => 'طلبات سحب أرباح',
                     'icon_color' => 'yellow',
                    'url'  => 'affiliates-withdraw-profites',
                ]
            ]
        ],
        [
            'text'    => 'التسويق بالعمولة',
            'icon'    => 'fas fa-bullhorn',
            'can'     => "manage-item-as-affiliater",
            'submenu' => [
                [
                    'text' => 'التسويق بالعمولة',
                    'icon_color' => 'red',
                    'url'  => 'affiliates/create',
                ],
                 [
                    'text' => 'المدعويين ',
                    'icon_color' => 'red',
                    'url'  => 'affiliatees/show',
                ],
                [
                    'text' => 'المرتب ',
                    'icon_color' => 'red',
                    'can'=>'manage-item-as-employee',
                    'url'  => 'affiliatees/show-employee-salaries',
                ],
                [
                    'text' => 'أرباح التسويق بالعمولة ',
                    'icon_color' => 'red',
                    'url'  => 'affiliatees/my-profits',
                ],
                [
                    'text' => 'طلبات سحب الارباح',
                    'icon_color' => 'red',
                    'url'  => 'affiliatees/withdraws',
                ]

            ]
        ],
        [
            'text'    => 'المسجلين بالدورات',
            'icon'    => 'fas fa-wallet',
            'can'     => "manage-item",
            'submenu' => [
                [
                    'text' => 'المسجليين بالدورة',
                    'icon_color' => 'red',
                    'url'  => 'courses-orders',
                ]
            ]
        ]

    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'SimpleLightBox' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/simple-lightbox/simple-lightbox.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/simple-lightbox/simple-lightbox.js',
                ]
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                ],
            ],
        ],
        'bootstrapSwitch' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-switch/js/bootstrap-switch.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css',
                ],
            ],
        ],
        'niceSelect' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/nice-select/js/jquery.nice-select.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/nice-select/css/nice-select.css',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
