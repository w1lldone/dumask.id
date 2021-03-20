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
                <button class="btn btn-warning">
                    edit
                </button>
                <delete-button :delete-url="`/user/${user.id}`" @deleted="handleDeleted(index)"></delete-button>
            </div>
        </div>
    </div>
</template>

<script>
import DeleteButton from '../DeleteButton.vue'
    export default {
  components: { DeleteButton },
        name: "UserList",

        props: {
            initialUsers: {
                type: Array,
            },
        },

        data() {
            return {
                users: this.initialUsers
            }
        },

        methods: {
            handleDeleted(index) {
                this.users.splice(index, 1)
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>