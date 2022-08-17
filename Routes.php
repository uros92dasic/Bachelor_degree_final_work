<?php
    return [
        App\Core\Route::get ('|^user/register/?$|',                                 'Main',             'getRegister'),
        App\Core\Route::post('|^user/register/?$|',                                 'Main',             'postRegister'),
        
        App\Core\Route::get ('|^user/login/?$|',                                    'Main',             'getLogin'),
        App\Core\Route::post('|^user/login/?$|',                                    'Main',             'postLogin'),
        App\Core\Route::get ('|^user/logout/?$|',                                   'Main',             'getLogout'),
        

        App\Core\Route::get ('|^dani$|',                                            'Dani',             'show'),
        App\Core\Route::get ('|^dan/([0-9]+)/?$|',                                  'Dani',             'showProgrami'),

        App\Core\Route::get ('|^programi$|',                                        'Program',          'show'),
        App\Core\Route::get ('|^program/([0-9]+)/?$|',                              'Program',          'showProgram'),
        App\Core\Route::get ('|^program/([0-9]+)/dan/([0-9]+)/?$|',                 'Program',          'showTermini'),
        App\Core\Route::get ('|^program/([0-9]+)/delete/?$|',                       'Program',          'delete'),

        App\Core\Route::get ('|^program/([0-9]+)/dan/([0-9]+)/termin/([0-9]+)/?$|', 'Termin',           'show'),

        App\Core\Route::post('|^search$|',                                          'Program',          'postSearch'),

        # API routes:
        App\Core\Route::get ('|^api/program/([0-9]+)/?$|',                          'ApiProgram',       'showProgram'),

        App\Core\Route::get ('|^api/bookmarks/?$|',                                 'ApiBookmark',      'getBookmarks'),
        App\Core\Route::get ('|^api/bookmarks/add/([0-9]+)?$|',                     'ApiBookmark',      'addBookmark'),
        App\Core\Route::get ('|^api/bookmarks/clear/?$|',                           'ApiBookmark',      'clearBookmarks'),

        # User role routes:
        App\Core\Route::get ('|^user/profile/?$|',                                  'UserDashboard',    'index'),
        
        # ProgramModel <- program

        # LIST
        App\Core\Route::get ('|^user/program/?$|',                                  'UserProgramManagement', 'programi'),
        # EDIT FORM
        App\Core\Route::get ('|^user/program/edit/([0-9]+)/?$|',                    'UserProgramManagement', 'getEdit'),
        # EDIT LOGIC
        App\Core\Route::post('|^user/program/edit/([0-9]+)/?$|',                    'UserProgramManagement', 'postEdit'),
        # ADD FORM
        App\Core\Route::get ('|^user/program/add/?$|',                              'UserProgramManagement', 'getAdd'),
        # ADD LOGIC
        App\Core\Route::post('|^user/program/add/?$|',                              'UserProgramManagement', 'postAdd'),

        # LIST user/zakazi/program
        App\Core\Route::get ('|^user/zakazi/?$|',                                   'UserZakazivanjeManagement', 'zakazi'),
        App\Core\Route::get ('|^user/zakazi/program/?$|',                           'UserZakazivanjeManagement', 'programi'),
        App\Core\Route::get ('|^user/zakazi/program/([0-9]+)/?$|',                  'UserZakazivanjeManagement', 'dani'),
        App\Core\Route::get ('|^user/zakazi/program/([0-9]+)/dan/([0-9]+)/?$|',     'UserZakazivanjeManagement', 'termini'),

        App\Core\Route::get ('|^user/zakazi/program/([0-9]+)/dan/([0-9]+)/termin/([0-9]+)/?$|', 'UserZakazivanjeManagement', 'getAdd'),
        App\Core\Route::post('|^user/zakazi/program/([0-9]+)/dan/([0-9]+)/termin/([0-9]+)/?$|', 'UserZakazivanjeManagement', 'postAdd'),
        
        App\Core\Route::get ('|^user/zakazi/edit/([0-9]+)/?$|',                     'UserZakazivanjeManagement', 'getEdit'),
        App\Core\Route::post('|^user/zakazi/edit/([0-9]+)/?$|',                     'UserZakazivanjeManagement', 'postEdit'),

        App\Core\Route::any ('|^.*$|',                                              'Main', 'home')
    ];