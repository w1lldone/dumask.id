<template>
    <div>
        <table class="table table-borderless table-responsive d-md-table">
            <thead style="border-bottom: 1px solid #c4c4c4;">
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
                            <span v-if="permission == 'manage stations'" class="badge text-white mx-1" style="background: #5c5c5c">
                                Manage Stations
                            </span>
                        </span>
                    </td>
                    <td class="align-middle text-right">
                        <div>
                            <user-edit-modal :permissions="permissions" class="d-inline" :editedUser="user"></user-edit-modal>
                            <delete-modal 
                                class="d-inline mx-md-1" 
                                :delete-url="`/user/${user.id}`" 
                                :delete-id="(user.id).toString()"
                                :delete-name="user.name"
                                delete-type="user"
                                @deleted="handleDeleted(index)">
                            </delete-modal>
                        </div>
                    </td>
                </tr>
            </tbody> 
        </table>        
    </div>
</template>

<script>
import DeleteModal from '../DeleteModal.vue'
import UserEditModal from './UserEditModal.vue'
    export default {
  components: { DeleteModal, UserEditModal },
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
