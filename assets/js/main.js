const $ = require('jquery');
require('materialize-css');
require('./modules/alert')($);

global.$ = global.jQuery = $;
