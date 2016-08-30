import {config} from 'laravel-elixir';
config.json = {
  folder: 'json',
  outputFolder: 'json'
};

config.images = {
  folder: 'images',
  outputFolder: 'images'
};

import './resources/gulp';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

