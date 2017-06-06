<?php
return [
    'singular' => 'Project',
    'plural' => 'Projects',
    'empty' => 'No projects created!',
    'pages_count' => '(:count) Pages',

    'actions' => [
        'create' => 'Create new project',
        'edit' => 'Edit the project',
        'delete' => 'Delete the project',
    ],

    'flash' => [
        'created' => 'The project has been created successfuly.',
        'updated' => 'The project has been updated successfuly.',
        'deleted' => 'The project has been deleted successfuly.',
    ],

    'attributes' => [
        'user_id' => 'User',
        'name' => 'Project Name',
        'description' => 'Project Description',
    ],

    'delete' => [
        'title' => 'Delete Confirmation !',
        'ask' => 'Are you sure you want to delete this project ?',
        'buttons' => [
            'cancel' => 'Cancel',
            'confirm' => 'Yes, Delete it.',
        ],
    ],
];