<?php

return [
    'sidebar' => [
        'dashboard' => [
            'title' => 'dashboard',
            'route' => 'admin.dashboard',
            'icon' => '<i class="bi bi-grid"></i>',
        ],

        'users' => [
            'title' => 'manage_users',
            'route' => 'admin.manage.users',
            'icon' => '<i class="bi bi-people"></i>',
        ],

        'songs' => [
            'title' => 'manage_songs',
            'icon' => '<i class="bi bi-file-earmark-music"></i>',
            'submenu' => [
                'add' => ['title' => 'add_song', 'route' => 'admin.songs.add'],
                'list' => ['title' => 'list_songs', 'route' => 'admin.songs.list'],
            ],
        ],

        'albums' => [
            'title' => 'manage_albums',
            'icon' => '<i class="bi bi-journal-album"></i>',
            'submenu' => [
                'add' => ['title' => 'add_album', 'route' => 'admin.albums.create'],
                'list' => ['title' => 'list_albums', 'route' => 'admin.albums.index'],
            ],
        ],

        'authors' => [
            'title' => 'manage_authors',
            'icon' => '<i class="bi bi-person-lines-fill"></i>',
            'submenu' => [
                'add' => ['title' => 'add_author', 'route' => 'admin.authors.create'],
                'list' => ['title' => 'list_authors', 'route' => 'admin.authors.index'],
            ],
        ],

        'categories' => [
            'title' => 'manage_categories',
            'icon' => '<i class="bi bi-bookmarks"></i>',
            'submenu' => [
                'add' => ['title' => 'add_category', 'route' => 'admin.categories.create'],
                'list' => ['title' => 'list_categories', 'route' => 'admin.categories.index'],
            ],
        ],
    ],
    'paginate' =>[
        "author" => 10,
        'category' => 10,
        'album' =>10,
    ],
    'format' => [
        'datetime' => 'd/m/Y H:i',
    ],
];
