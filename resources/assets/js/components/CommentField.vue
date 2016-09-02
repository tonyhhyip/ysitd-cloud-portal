<template>
    <md-card>
        <span slot="title">Comment</span>
        <markdown-textarea v-ref:md></markdown-textarea>
        <div slot="actions">
            <button class="btn" @click="submit">Comment</button>
        </div>
    </md-card>
</template>

<style scoped>
    .card-content > div {
        height: auto;
    }

    textarea {
        height: auto;
        display: block;
        width: 100%;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        overflow: auto;
        margin: 0;
    }
</style>

<script>
    export default{
        props: {
            url: {
                type: String,
                required: true,
                twoWays: false
            },
            token: {
                type: String,
                required: true,
                twoWays: false
            }
        },
        components: {
            'markdown-textarea': require('./MarkdownTextarea.vue')
        },
        methods: {
            submit() {
                console.log(this.$refs.md.$get('content'));
            }
        }
    }
</script>
