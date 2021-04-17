<template>
    <div>
        <div class="row my-4" v-for="(user, index) in users" :key="user.id">
            <div class="col-md-4">
                <h5 class="m-0">{{ user.name }}</h5>
                <span class="text-muted">{{ user.email }}</span>
            </div>
            <div class="col-md-2">
                <b v-if="user.is_superadmin">
                    Superadmin
                </b>
            </div>
            <div class="col-md-4">
                <span v-if="user.permissions">
                    {{ user.permissions.join(', ') }}
                </span>
            </div>
            <div class="col-md-2">
                <user-edit-modal :permissions="permissions" class="d-inline" :editedUser="user"></user-edit-modal>
                <delete-button :delete-url="`/user/${user.id}`" @deleted="handleDeleted(index)">
                    <span class="mdi mdi-delete"></span>
                </delete-button>
            </div>
        </div>
    </div>
</template>

<script>
import DeleteButton from '../DeleteButton.vue'
import UserEditModal from './UserEditModal.vue'
    export default {
  components: { DeleteButton, UserEditModal },
        name: "UserList",

        props: {
            initialUsers: {
                type: Array,
            },
            permissions: Array,
        },

        data() {
            return {
                users: this.initialUsers,
                form: {},
            }
        },

        methods: {
            handleDeleted(index) {
                this.users.splice(index, 1)
            },
            editUser(user) {
                console.log(user)
                this.editedUser = user;

            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
