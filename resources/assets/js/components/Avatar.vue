<template>
    <span :class="[classes, class]">
        <img :src="src">
    </span>
</template>
<script>
    export default{
        data() {
          return {
              classes: {
                  'avatar': true,
                  'avatar-sm': this.size === 'medium',
                  'avatar-lg': this.size === 'large',
                  'avatar-xs': this.size === 'small'
              }
          }
        },
        props: {
            src: {
                type: String,
                required: true
            },
            size: {
                type: String
            },
            class: {
                type: Object
            }
        }
    }
</script>
