<?php

return [

    '~^$~' => [\Controllers\MainController::class, 'main'],
    '~^addtask~' => [\Controllers\MainController::class, 'addtask'],
    '~^auth~' => [\Controllers\AuthorizationController::class, 'main'],
    '~^logout~' => [\Controllers\AuthorizationController::class, 'logout'],
    '~^admin~' => [\Controllers\AuthorizationController::class, 'actionLogin'],
    //[\Controllers\AuthorizationController::class, 'actionLogin'] => '~^$~',
];
