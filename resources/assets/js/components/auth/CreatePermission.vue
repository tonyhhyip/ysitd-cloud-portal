<template>
    <div class="modal modal-fixed-footer" id="create">
        <div class="modal-content">
            <h4>Create New Permission</h4>
            <md-input :value.sync="name"
                      success-msg="Can be added" error-msg="Already exists"
                      :valid="nameValidate">
                Name
            </md-input>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat">
                Cancel
            </a>
            <a href="#!" class="modal-action waves-effect waves-green btn" @click.prevent="submit">
                Add
            </a>
        </div>
    </div>
</template>

<style>

</style>

<script>
    import {refresh} from '../../ajax';
    export default{
        data() {
            return {
                name: '',
                nameValidate: null
            }
        },
        watch: {
            name(value) {
                this.nameValidate = null;
                if (value) {
                    this.$http.get(`/account/permission/${value}`).then(() => {
                        this.nameValidate = false;
                    }, () => {
                        this.nameValidate = true;
                    });
                }
            }
        },
        methods: {
            submit() {
                this.$http.post('/account/permission', {name: this.name}).then(() => {
                    $(document.getElementById('create')).closeModal();
                }, () => {
                    console.log('KORUED');
                });
            }
        }
    }
</script>
