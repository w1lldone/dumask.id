<template>
    <div>
        <button
        class="btn btn-danger"
        data-toggle="modal"
        :data-target="'#delete-modal-' + deleteType + '-' + deleteId"
        >
            <span class="mdi mdi-delete"></span>
        </button>
        <div
        class="modal fade"
        :id="'delete-modal-' + deleteType + '-' + deleteId"
        tabindex="-1"
        role="dialog"
        aria-labelledby="modal-id"
        aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header mx-4">
                        <h5
                        class="modal-title font-weight-bold text-muted"
                        style="text-transform: uppercase"
                        >
                        HAPUS {{ deleteType }}
                        </h5>
                        <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        >
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-left mx-4">
                        <div>
                            Apakah Anda yakin akan menghapus {{ deleteType }} {{ deleteName }}
                        </div>
                        <div class="mt-4 text-right">
                            <button type="button" class="btn btn-primary mx-2 shadow" data-dismiss="modal">TIDAK</button>
                            <button
                                class="btn btn-secondary shadow"
                                v-show="!isLoading"
                                @click="doDelete()"
                            >
                                YA
                            </button>
                            <button class="btn btn-secondary" disabled v-show="isLoading">
                                YA
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DeleteModal",

        props: {
            deleteUrl: {
                type: String,
            },
            deleteType: {
                type: String,
            },
            deleteName: {
                type: String
            },
            deleteId: {
                type: String
            }
        },

        data() {
            return {
                isLoading: false
            }
        },

        methods: {
            async doDelete() {

                this.isLoading = true

                try {
                    let response = await axios.delete(this.deleteUrl)
                    this.$emit('deleted')
                    $('.modal').modal('hide')
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
