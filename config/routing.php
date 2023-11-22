<?php

return[

        /**************************************************************************************
          Configuration
        **************************************************************************************/
        'configuration'=>[

                  /*  Modules
                  **************************************************************************************/
                  'modules'=>[

                              'controller'=>'Configuration\Modules',
                              'view'=>'configuration.modules',
                              'name'=>'configuration.modules',
                              'layout'=>'configuration.layouts.modules',

                  ], //End Landing

        ], //End Configuration

        /**************************************************************************************
          Share
        **************************************************************************************/
        'share'=>[

                  /*  Modules
                  **************************************************************************************/
                  'modules'=>[

                              /* Dashboard
                              **************************************************************************************/
                             'dashboard'=>[

                                            'controller'=>'Share\Modules\Dashboard',
                                            'view'=>'share.modules.dashboard',
                                            'name'=>'share.modules.dashboard',

                             ], //End Dashboard

                  ], //End Module

        ], //End Share


        /**************************************************************************************
          Application
        **************************************************************************************/
        'application'=>[

                  /* Modules
                  **************************************************************************************/
                  'modules'=>[

                              /* Dashboard
                              **************************************************************************************/
                              'dashboard'=>[

                                            /* Employee
                                            **************************************************************************************/
                                            'employee'=>[
                                                          'controller'=>'Application'.DIRECTORY_SEPARATOR.'Modules'.DIRECTORY_SEPARATOR.'Dashboard'.DIRECTORY_SEPARATOR.'Employee',
                                                          'view'=>'application.modules.dashboard.employee',
                                                          'name'=>'application.modules.dashboard.employee',
                                                          'layout'=>'application.layouts.modules.dashboard.employee',
                                                        ], //End Employee

                                            /* Customer
                                            **************************************************************************************/
                                            'customer'=>[
                                                          'controller'=>'Application'.DIRECTORY_SEPARATOR.'Modules'.DIRECTORY_SEPARATOR.'Dashboard'.DIRECTORY_SEPARATOR.'Customer',
                                                          'view'=>'application.modules.dashboard.customer',
                                                          'name'=>'application.modules.dashboard.customer',
                                                          'layout'=>'application.layouts.modules.dashboard.customer',
                                                        ], //End Customer

                              ], //End Dashboard

                              /* Landing
                              **************************************************************************************/
                              'landing'=>[

                                          /* dcs
                                          **************************************************************************************/
                                          'dcs'=>[

                                            'controller'=>'Application'.DIRECTORY_SEPARATOR.'Modules'.DIRECTORY_SEPARATOR.'Landing'.DIRECTORY_SEPARATOR.'dcs',
                                            'view'=>'application.modules.landing.dcs',
                                            'name'=>'application.modules.landing.dcs',
                                            'layout'=>'application.layouts.modules.landing.dcs',

                                          ]

                              ]

                  ],


        ], //End IUKL

]

?>
