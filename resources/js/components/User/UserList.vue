<template>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Permission</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="user.id">
                    <td class="align-middle">{{ user.name }}</td>
                    <td class="align-middle">{{ user.email }}</td>
                    <td class="align-middle">
                        <b v-if="user.is_superadmin">
                            Superadmin
                        </b>
                        <b v-else>
                            Member
                        </b>
                    </td>
                    <td class="align-middle">
                        <span v-for="(permission, index) in user.permissions" :key="index">    
                            <span v-if="permission == 'manage users'" class="badge text-white badge-secondary mx-1">
                                Manage Users
                            </span>
                            <span v-if="permission == 'manage stations'" class="badge text-white badge-gray mx-1" style="background: #5c5c5c">
                                Manage Stations
                            </span>
                        </span>
                    </td>
                    <td>
                        <div>
                            <user-edit-modal :permissions="permissions" class="d-inline" :editedUser="user"></user-edit-modal>
                            <delete-button :delete-url="`/user/${user.id}`" @deleted="handleDeleted(index)">
                                <span class="mdi mdi-delete"></span>
                            </delete-button>
                        </div>
                    </td>
                </tr>
            </tbody> 
        </table>        
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
