<template>
    <div>
        <div class="row">
            <div class="col s12 m12">
                <ul class="tabs z-depth-2">
                    <li class="tab col s6">
                        <a href="#comment-write" class="active">Write</a>
                    </li>
                    <li class="tab col s6">
                        <a href="#comment-preview">Preview</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div id="comment-write" class="col s12">
                <textarea placeholder="You may type Markdown here" v-model="content"></textarea>
            </div>
            <div id="comment-preview" class="col s12" v-html="content | marked"></div>
        </div>
    </div>
</template>

<style scoped>
    #comment-preview {
        min-height: 54px;
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
    import marked from 'marked';
    export default{
        data() {
            return {
                content: ''
            }
        },
        filters: {
            marked
        },
        ready() {
            $('ul.tabs', this.$el).tabs();
        }
    }
</script>
