<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'CLI Config',
    'description' => 'TYPO3 CMS extension to provide a command to set global system settings on CLI.',
    'category' => 'backend',
    'author' => 'Armin Vieweg',
    'author_email' => 'armin@v.ieweg.de',
    'version' => '0.0.0',
    'state' => 'stable',
    'constraints' => [
        'depends' =>
            [
                'typo3' => '13.0.0-13.9.99',
            ],
        'conflicts' =>
            [
                'typo3_console' => ''
            ],
        'suggests' => [],
    ],
);
