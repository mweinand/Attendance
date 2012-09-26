return array(
    'controllers' => array(
        'invokables' => array(
            'CheckIn\Controller\CheckIn' => 'Checkin\Controller\CheckInController',
        ),
    ),
	
	// The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'checkin' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/checkin[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'CheckIn\Controller\CheckIn',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'checkin' => __DIR__ . '/../view',
        ),
    ),
);
