'use strict';
import './ajax';
import Vue from 'vue';

$(document.getElementsByClassName('modal-trigger')).leanModal();

new Vue({
  el: '#vue-root',
  components: {
    'create-permission': require('./components/auth/CreatePermission.vue')
  }
});