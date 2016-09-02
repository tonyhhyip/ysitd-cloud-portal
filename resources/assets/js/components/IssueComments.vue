<template>
    <div class="row">
        <div class="col s12 m8">
            <div v-for="comment in comments" class="card horizontal">
                <div class="card-image">
                    <user-icon user="comment.user" size="medium"></user-icon>
                </div>
                <div class="card-stack">
                    <div class="card-content">
                        <div class="card-title">
                            {{ comment.display_name }}
                            <small>{{ commnet.created_at }}</small>
                        </div>
                        <div v-html="comment.content | marked"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.card-title small {
    color: grey;
}
</style>

<script>
    import Vue from 'vue';
    import VueResource from 'vue-resource';
    import marked from 'marked';
    Vue.use(VueResource);
    export default{
        props: ['id'],
        data: {
            comments: []
        },
        components: {
            'user-icon': require('./UserIcon.vue')
        },
        filters: {
            marked
        },
        ready() {
            this.$http.get(`/issue/${this.id}/comment`).then((response) => {
                const data = response.json();
                this.$set('comments', data.comments);
            }, () => {
                console.log('issue-comment KORUED');
            });
        }
    }
</script>
