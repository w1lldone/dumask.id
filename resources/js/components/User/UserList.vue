<template>
    <div>
        <div class="row my-4" v-for="(user, index) in users" :key="user.id">
            <div class="col-md-6">
                <h5 class="m-0">{{ user.name }}</h5>
                <span class="text-muted">{{ user.email }}</span>
            </div>
            <div class="col-md-2">
                <span v-if="user.is_superadmin">
                    Superadmin
                </span>
                <span v-if="user.perimissions">
                    {{ user.permissions.join(', ') }}
                </span>
            </div>
            <div class="col-md-4 text-right">
                <button 
                class="btn btn-warning"
                data-toggle="modal"
                :data-target="'#edit-user-modal-' + user.id"
                >
                    Edit
                </button>
                <delete-button :delete-url="`/user/${user.id}`" @deleted="handleDeleted(index)"></delete-button>
            </div>
            <user-edit-modal :editedUser="user"></user-edit-modal>
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
        },

        data() {
            return {
                users: this.initialUsers,
                editedUser: {},
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