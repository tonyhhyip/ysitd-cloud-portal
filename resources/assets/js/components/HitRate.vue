<template>
    <md-card :class="class">
        <span slot="title">PHP Class Loader Cache Hit Rate</span>
        <p>{{ rate }} %</p>
    </md-card>
</template>

<script>
    import Vue from 'vue';
    import VueResource from 'vue-resource';
    import {roundOff} from '../utils';
    Vue.use(VueResource);
    export default {
        props: ['class'],
        data: {
                rate: {
                    type: Number,
                    required: false,
                    default: 0
                }
        },
        ready() {
            this.$http.get('/hit').then((response) => {
                const number = parseFloat(response.text());
                this.$set('rate', roundOff(number, 3));
            }, () => {
                console.log('KORUED');
            })
        }
    }
</script>

<style scoped>
    p {
        font-size: 3em;
    }
</style>