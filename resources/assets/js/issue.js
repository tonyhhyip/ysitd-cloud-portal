import Vue from 'vue';

new Vue({
  el: '#vue-root',
  components: {
    'comment-field': require('./components/CommentField.vue'),
    'user-icon': require('./components/UserIcon.vue'),
    'issue-comments': require('./components/IssueComments.vue')
  }
});