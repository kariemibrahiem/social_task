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
        'name' => 'Partners',
        'icon' => 'bx bx-user',
        'url' => 'partnerss.index',
        "permissions" => "partnerss_read",
        'slug' => 'partnerss',
        'submenu' => [
            (object)[
                'name' => 'Partners',
                'url' => 'partnerss.index',
                "permissions" => "partnerss_read",
                'slug' => 'partnerss',
            ],
            (object)[
                'name' => 'Create Partners',
                'url' => 'partnerss.create',
                "permissions" => "partnerss_create",
                'slug' => 'partnerss.create',
            ]
        ]


    ],
    (object)[
        'name' => 'Collaboration',
        'icon' => 'bx bx-user',
        'url' => 'collaborations.index',
        "permissions" => "collaborations_read",
        'slug' => 'collaborations',
        'submenu' => [
            (object)[
                'name' => 'Collaboration',
                'url' => 'collaborations.index',
                "permissions" => "collaborations_read",
                'slug' => 'collaborations',
            ],
            (object)[
                'name' => 'Create Collaboration',
                'url' => 'collaborations.create',
                "permissions" => "collaborations_create",
                'slug' => 'collaborations.create',
            ]
        ]


    ],
    
    (object)[
        'name' => 'Project',
        'icon' => 'bx bx-user',
        'url' => 'Backprojects.index',
        "permissions" => "projects_read",
        'slug' => 'projects',
        'submenu' => [
            (object)[
                'name' => 'Project',
                'url' => 'Backprojects.index',
                "permissions" => "projects_read",
                'slug' => 'projects',
            ],
            (object)[
                'name' => 'Create Project',
                'url' => 'Backprojects.create',
                "permissions" => "projects_create",
                'slug' => 'projects.create',
            ]
        ]


    ]
];
