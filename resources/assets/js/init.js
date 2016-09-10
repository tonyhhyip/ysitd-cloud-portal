'use strict';
import Vue from 'vue';
import VueMaterialComponent from 'vue-material-components';
Vue.use(VueMaterialComponent);

const route = location.pathname.replace(/^\//, '').split('/')[0];
const ele = document.getElementById(`collapse-${route}`);
if (ele && ele !== null) {
  $(ele).addClass('active');
  $('.collapsible-header', ele).addClass('active');
}

$(document.getElementsByClassName('button-collapse')).sideNav();
$(document.getElementsByClassName('dropdown-button')).dropdown();
$(document.getElementsByClassName('materialboxed')).materialbox();
