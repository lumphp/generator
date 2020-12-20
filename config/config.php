<?php
return [
    'controller_template_path' => base_path(
        'generator/templates/controller.php'
    ),
    'model_template_path' => base_path(
        'generator/templates/model.php'
    ),
    'view_template_path' => base_path(
        'generator/templates/view.php'
    ),
    'model_target_path' => base_path('app/Models'),
    'controller_target_path' => base_path('app/Http/Controllers'),
    'view_target_path' => base_path('resources/views'),
];
