<template>
    <button @click="doDelete()" class="btn btn-danger" :disabled="isLoading">
        <span v-show="!isLoading">
            <slot></slot>
        </span>
        <span v-show="isLoading">Deleting...</span>
    </button>
</template>

<script>
    export default {
        name: "DeleteButton",

        props: {
            deleteUrl: {
                type: String,
            },
        },

        data() {
            return {
                isLoading: false
            }
        },

        methods: {
            async doDelete() {
                if (!confirm('Are you sure?')) return;

                this.isLoading = true

                try {
                    let response = await axios.delete(this.deleteUrl)
                    this.$emit('deleted')
                    alert('deleted')
                } catch (error) {
                    alert(error.response.data.message)
                }

                this.isLoading = false
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
