<?php

 Route::get('/', 'Frontend\HomeController@getIndex');
 Route::get('/user', 'Frontend\HomeController@getIndex1');
 Route::get('/login', 'Frontend\HomeController@getlogin');
 Route::get('/register', 'Frontend\HomeController@getregister');
 
 Route::get('/blog', 'Frontend\BlogController@getIndex');
  Route::get('/blog-lat', 'Frontend\BlogController@getBloglat');
  Route::get('/feature', 'Frontend\BlogController@getFeature');
 
     
 