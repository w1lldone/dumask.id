<template>
  <div>
    <button
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#create-user-modal-id"
    >
      TAMBAH USER
    </button>
    <div
      class="modal fade"
      id="create-user-modal-id"
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
              id="modal-title"
            >
              TAMBAH USER
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
          <div class="modal-body mx-4">
            <div class="form-group">
              <label for="name">
                Nama
                <abbr class="text-danger">*</abbr>
              </label>
              <div class="input-group">
                <input
                  type="text"
                  required
                  class="form-control"
                  :class="{ 'is-invalid': hasErrors('name'), 'border-right-0' : form.name, 'rounded' : !form.name }"
                  v-model="form.name"
                />
                <div
                  v-show="form.name"
                  class="input-group-append"
                >
                  <button
                    class="btn border-dark border-left-0"
                    style="border-color: #ced4da !important"
                    @click="form.name = null"
                  >
                    <span class="mdi mdi-close text-dark" style="font-size: 14px !important"></span>
                  </button>
                </div>
              </div>    
              <div class="invalid-feedback">
                {{ getErrors("name") }}
              </div>
            </div>
            <div class="form-group">
              <label for="email">
                Email
              <abbr class="text-danger">*</abbr>
              </label>
              <div class="input-group">
                <input type="email"
                required 
                v-model="form.email" 
                class="form-control"
                :class="{ 'is-invalid': hasErrors('email'), 'border-right-0' : form.email, 'rounded' : !form.email }"
                />
                <div
                  v-show="form.email"
                  class="input-group-append"
                >
                  <button
                    class="btn border-dark border-left-0"
                    style="border-color: #ced4da !important"
                    @click="form.email = null"
                  >
                    <span class="mdi mdi-close text-dark" style="font-size: 14px !important"></span>
                  </button>
                </div>
              </div>
              <small class="text-dark">Pastikan email yang Anda gunakan masih aktif. Contoh : nama@mail.com</small>
              <div class="invalid-feedback">
                {{ getErrors("email") }}
              </div>
            </div>
            <div class="form-group">
              <label for="role">
                Role
              <abbr class="text-danger">*</abbr>
              </label>
              <div class="d-flex">
                <div class="custom-control custom-radio">
                    <input
                      type="radio"
                      class="custom-control-input"
                      id="role-radio-one"
                      value= "true"
                      v-model="form.is_superadmin"
                    />
                    <label class="custom-control-label" for="role-radio-one">
                      Superadmin
                    </label>
                </div>
                <div class="custom-control custom-radio ml-4">
                    <input
                      type="radio"
                      class="custom-control-input"
                      id="role-radio-two"
                      value= "false"
                      v-model="form.is_superadmin"
                    />
                    <label class="custom-control-label" for="role-radio-two">
                      Member
                    </label>
                </div>
              </div>
            </div>
            <div class="form-group" v-if="form.is_superadmin == 'false'">
              <label for="permissions">Permissions</label>
              <div class="d-flex">
                <div
                  class="custom-control custom-checkbox mr-4"
                  v-for="(permission) in permissions"
                  :key="permission"
                >
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    :id="`permission-${permission}`"
                    :value="permission"
                    v-model="form.permissions"
                  />
                  <label
                    class="custom-control-label"
                    style="text-transform: capitalize;"
                    :for="`permission-${permission}`"
                    >{{ permission }}</label
                  >
                </div>
                <div class="invalid-feedback">
                  {{ getErrors("permissions") }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="password">
                Password
                <abbr class="text-danger">*</abbr>
              </label>
              <div class="input-group">
                <input 
                  :type="passwordInputType" 
                  v-model="form.password" 
                  class="form-control border-right-0" 
                  :class="{ 'is-invalid': hasErrors('password') }"
                />
                <div class="input-group-append">
                  <button
                    v-show="form.password"
                    class="btn border-dark border-left-0 border-right-0"
                    style="border-color: #ced4da !important"
                    @click="form.password = null"
                  >
                    <span class="mdi mdi-close text-dark" style="font-size: 14px !important"></span>
                  </button>
                  <div
                    v-on:mousedown="passwordInputType = 'text'"
                    v-on:mouseup="passwordInputType = 'password'"
                    class="btn border-dark border-left-0"
                    :class="{ 'text-dark' : (passwordInputType == 'password') }"
                    style="border-color: #ced4da !important"
                  >
                    <span class="mdi mdi-eye-outline" style="font-size: 14px !important"></span>
                  </div>
                </div>
              </div>
              <small class="text-dark">Minimal 8 karakter</small>
              <div class="invalid-feedback">
                {{ getErrors("password") }}
              </div>
            </div>
            <div class="form-group mt-4 text-right">
               <button
                style="background: #A7A7A7"
                class="btn text-white shadow mx-2"
                @click="doReset()"
              >
                RESET
              </button>
              <button
                class="btn btn-primary shadow"
                v-show="!isLoading"
                @click="doSubmit()"
              >
                SAVE
              </button>
              <button class="btn btn-success" disabled v-show="isLoading">
                SAVING...
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
  name: "UserCreateModal",

  props: {
    permissions: Array
  },

  data() {
    return {
      form: {
        name: null,
        email: null,
        is_superadmin: 'false',
        password: null,
        permissions: [],
      },
      isLoading: false,
      errors: {},
      passwordInputType : 'password'
    };
  },

  methods: {
    async doSubmit() {
      this.isLoading = true;

      try {
        let response = await axios.post("/user", this.form);
        return location.reload();
      } catch (error) {
        alert(error.response.data.message);
        console.log(error.response);
        this.errors = error.response.data.errors;
      }

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

    doReset() {
      this.form = {
        name: null,
        email: null,
        is_superadmin: 'false',
        password: null,
        permissions: [],
      }
    },

    showPassword() {

    }
  },
};
</script>

<style lang="scss" scoped>
</style>