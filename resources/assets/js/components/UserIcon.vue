<template>
    <avatar :src="src" :size="size" :style="{ display: display }"></avatar>
</template>

<script>
    export default{
        data() {
            return {
                src: `/user/${this.user}/icon`,
                display: this.type === 'inline' ? 'inline-block' : 'block'
            }
        },
        props: {
            user: {
                type: String,
                required: true
            },
            size: {
                type: String
            },
            type: {
                type: String
            }
        },
        components:{
            'avatar': require('./Avatar.vue')
        }
    }
</script>
