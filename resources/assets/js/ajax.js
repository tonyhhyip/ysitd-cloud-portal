'use strict';
import Vue from 'vue';
import VueResource from 'vue-resource';
import Cookie from 'js-cookie';

Vue.use(VueResource);

let token = null;

function getToken() {
  if (token !== null) {
    return token;
  }

  token = Cookie.get('XSRF-TOKEN');
  return token;
}

function refresh() {
  token = null;
  Vue.http.headers.common['X-XSRF-TOKEN'] = getToken();

  $.ajaxSetup({
    headers: {
      'X-XSRF-TOKEN': getToken()
    }
  });
}

refresh();

export {
  refresh
};