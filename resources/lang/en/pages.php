<?php
return [
    'singular' => 'Page',
    'plural' => 'Pages',
    'empty' => 'No pages created!',

    'actions' => [
        'create' => 'Create new page',
        'edit' => 'Edit the page',
        'delete' => 'Delete the page',
    ],

    'flash' => [
        'created' => 'The page has been created successfuly.',
        'updated' => 'The page has been updated successfuly.',
        'deleted' => 'The page has been deleted successfuly.',
    ],

    'attributes' => [
        'project_id' => 'Project',
        'title' => 'Page title',
        'body' => 'Page body',
    ],

    'delete' => [
        'title' => 'Delete Confirmation !',
        'ask' => 'Are you sure you want to delete this page ?',
        'buttons' => [
            'cancel' => 'Cancel',
            'confirm' => 'Yes, Delete it.',
        ],
    ],
];