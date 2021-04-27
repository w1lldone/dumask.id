<template>
    <div>
        <div class="d-flex">
            <div class="col-md-3">
                <img
                    class="img-fluid rounded-circle p-2 w-100"
                    src="img/profile_photo.png"
                    alt="Profile Picture"
                    
                >
            </div>
            <div class="col-md-9">
                <div class="d-flex my-3">
                    <div class="col-3 text-secondary font-weight-bold">
                        Nama
                    </div>
                    <div class="col-6">
                        <span v-show="!isEdit">
                            {{ user.name }}
                        </span>
                        <div class="form-group mb-0">
                            <input
                            type="text"
                            class="form-control"
                            :class="{ 'is-invalid': hasErrors('name') }"
                            v-show="isEdit"
                            v-model="form.name"
                            />
                            <div class="invalid-feedback">
                                {{ getErrors("name") }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex my-3">
                    <div class="col-3 text-secondary font-weight-bold">
                        Email
                    </div>
                    <div class="col-6">
                        {{ user.email }}
                    </div>
                </div>
                <div class="d-flex my-3">
                    <div class="col-3 text-secondary font-weight-bold">
                        Role
                    </div>
                    <div class="col-6">
                        <span v-if="user.is_superadmin">
                            Superadmin
                        </span>
                        <span v-else>
                            Member
                        </span>
                    </div>
                </div>
                <div class="d-md-flex">
                    <button 
                        v-show="!isEdit" 
                        class="btn btn-primary col-12 col-md-4 mx-3"
                        @click="isEdit = true"
                    >
                        EDIT PROFIL
                    </button>

                    <button 
                        v-show="isEdit && !isLoading" 
                        class="btn btn-success col-12 col-md-2 mx-3"
                        @click="doSave()"
                    >
                        SAVE
                    </button>
                    <button 
                        v-show="isEdit && isLoading" 
                        disabled
                        class="btn btn-success col-12 col-md-2 mx-3"
                    >
                        SAVING
                    </button>
                    <button 
                        v-show="isEdit && !isLoading" 
                        class="btn btn-outline-primary col-12 col-md-2 mx-3"
                        @click="doResetEdit()"
                    >
                        CANCEL
                    </button>
                    <button 
                        v-show="isEdit && isLoading" 
                        disabled
                        class="btn btn-outline-primary col-12 col-md-2 mx-3"
                    >
                        CANCEL
                    </button>

                    <button 
                        v-show="!isUpdatePassword"
                        class="btn btn-primary col-12 col-md-4 mx-3"
                        @click="isUpdatePassword = true"
                    >
                        GANTI PASSWORD
                    </button>
                </div>
                
                
                <div v-show="isUpdatePassword" class="mt-4">
                    <div v-if="!user.has_no_password" class="d-flex my-3">
                        <div class="col-3 my-auto text-secondary font-weight-bold">
                            Password Lama
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <input
                                type="password"
                                class="form-control"
                                :class="{ 'is-invalid': hasErrors('old_password') }"
                                v-model="form.old_password"
                                />
                                <div class="invalid-feedback">
                                    {{ getErrors("old_password") }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex my-3">
                        <div class="col-3 my-auto text-secondary font-weight-bold">
                            Password Baru
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <input
                                type="password"
                                class="form-control"
                                :class="{ 'is-invalid': hasErrors('password') }"
                                v-model="form.password"
                                />
                                <div class="invalid-feedback">
                                    {{ getErrors("password") }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex my-3">
                        <div class="col-3 my-auto text-secondary font-weight-bold">
                            Konfirmasi Password
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <input
                                type="password"
                                class="form-control"
                                :class="{ 'is-invalid': hasErrors('password_confirmation') }"
                                v-model="form.password_confirmation"
                                />
                                <div class="invalid-feedback">
                                    {{ getErrors("password_confirmation") }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-md-flex">
                        <button 
                            v-show="isUpdatePassword && !isLoading" 
                            class="btn btn-success col-12 col-md-2 mx-3"
                            @click="doUpdatePassword()"
                        >
                            SAVE
                        </button>
                        <button 
                            v-show="isUpdatePassword && isLoading" 
                            disabled
                            class="btn btn-success col-12 col-md-2 mx-3"
                        >
                            SAVING
                        </button>
                        <button 
                            v-show="isUpdatePassword && !isLoading" 
                            class="btn btn-outline-primary col-12 col-md-2 mx-3"
                            @click="doResetUpdatePassword()"
                        >
                            CANCEL
                        </button>
                        <button 
                            v-show="isUpdatePassword && isLoading" 
                            disabled
                            class="btn btn-outline-primary col-12 col-md-2 mx-3"
                        >
                            CANCEL
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProfilePage",

        props: {
            user: {
                type: Object,
            },
        },

        

        data() {
            return {
                form: {...this.user},    
                isLoading: false,
                isEdit: false,
                isUpdatePassword: false,
                errors: {}
            }
            
        },

        methods: {
            async doSave() {
                this.isLoading = true;

                try {
                    var url = "/profile/update";
                    let response = await axios.put(url, this.form);
                    return location.reload();
                } catch (error) {
                    alert(error.response.data.message);
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                }
                this.isLoading = false;
            },

            async doUpdatePassword() {
                this.isLoading = true;

                try {
                    var url = "/profile/update-password";
                    let response = await axios.put(url, this.form);
                    return location.reload();
                } catch (error) {
                    alert(error.response.data.message);
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                }
                this.isLoading = false;
            },

            doResetEdit() {
                this.form = {...this.user}
                this.isEdit = false;
                this.isLoading = false;
            },

            doResetUpdatePassword() {
                this.form = {...this.user}
                this.isUpdatePassword = false;
                this.isLoading = false;
            },

            hasErrors(key) {
                if (this.errors[key]) {
                    return true;
                }

            return false;
            },

            getErrors(key) {
                if (this.hasErrors(key)) {
                    return this.errors[key].join(", ");
                }

            return "";
            },
            
        },
    }
</script>

<style lang="scss" scoped>

</style>
