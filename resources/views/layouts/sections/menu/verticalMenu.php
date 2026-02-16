<?php

return [
    (object)[
        'name' => 'Dashboard',
        'icon' => 'bx bx-home-circle',
        'url' => 'dashboard-analytics',
        "permissions" => "dashboard",
        'slug' => 'dashboard',
    ],

    (object)[
        'name' => 'admins_Management',
        'icon' => 'bx bx-group',
        'url' => 'users.index',
        "permissions" => "admins_read",
        'slug' => 'users',
        'submenu' => [
            (object)[
                'name' => 'Admins',
                'icon' => 'bx bx-shield-quarter',
                'url' => 'admins.index',
                "permissions" => "admins_read",
                'slug' => 'admins',
            ],
            (object)[
                'name' => 'Create_admin',
                'url' => 'admins.create',
                "permissions" => "admins_create",
                'slug' => 'admins.create',
            ]
        ]
    ],

    (object)[
        'name' => 'users_management',
        'icon' => 'bx bx-user',
        'url' => 'users.index',
        "permissions" => "user_read",
        'slug' => 'user',
        'submenu' => [
            (object)[
                'name' => 'Users',
                'icon' => 'bx bx-user',
                'url' => 'users.index',
                "permissions" => "user_read",
                'slug' => 'users',
            ],

        ]
    ],
    (object)[
        'name' => 'Post',
        'icon' => 'bx bx-user',
        'url' => 'posts.index',
        "permissions" => "posts_read",
        'slug' => 'posts',
        'submenu' => [
            (object)[
                'name' => 'Post',
                'url' => 'posts.index',
                "permissions" => "posts_read",
                'slug' => 'posts',
            ],
        ]


    ],
    (object)[
        'name' => 'role',
        'icon' => 'bx bx-user',
        'url' => 'Role.index',
        "permissions" => "role_read",
        'slug' => 'role',
        'submenu' => [
            (object)[
                'name' => 'role',
                'url' => 'Role.index',
                "permissions" => "role_read",
                'slug' => 'Role',
            ],
        ]
    ],

    (object)[
        'name' => 'settings',
        'icon' => 'bx bx-cog',
        'url' => 'settings.index',
        "permissions" => "role_read",
        'slug' => 'settings',
        'submenu' => [
            (object)[
                'name' => 'settings',
                'url' => 'settings.index',
                "permissions" => "role_read",
                'slug' => 'settings',
            ],
        ]
    ],

    (object)[
        'name' => 'Comments',
        'icon' => 'bx bx-user',
        'url' => 'comments.index',
        "permissions" => "comments_read",
        'slug' => 'comments',
        'submenu' => [
            (object)[
                'name' => 'Comments',
                'url' => 'comments.index',
                "permissions" => "comments_read",
                'slug' => 'comments',
            ]
        ]
    ],
    (object)[
        'name' => 'Connection',
        'icon' => 'bx bx-user',
        'url' => 'connections.index',
        "permissions" => "connections_read",
        'slug' => 'connections',
        'submenu' => [
            (object)[
                'name' => 'Connection',
                'url' => 'connections.index',
                "permissions" => "connections_read",
                'slug' => 'connections',
            ],
        ]
    ]
,
];
