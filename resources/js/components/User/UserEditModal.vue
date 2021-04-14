<template>
  <div>
    <button
      class="btn btn-primary"
      data-toggle="modal"
      :data-target="'#edit-user-modal-' + editedUser.id"
    >
      <span class="mdi mdi-pencil"></span>
    </button>
    <div
      class="modal fade"
      :id="'edit-user-modal-' + editedUser.id"
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
              Edit User
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
                    :class="{ 'is-invalid': hasErrors('email') }"
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
                      :id="`role-${editedUser.id}-superadmin`"
                      value= "true"
                      v-model="form.is_superadmin"
                    />
                    <label class="custom-control-label" :for="`role-${editedUser.id}-superadmin`">
                      Superadmin
                    </label>
                </div>
                <div class="custom-control custom-radio ml-4">
                    <input
                      type="radio"
                      class="custom-control-input"
                      :id="`role-${editedUser.id}-member`"
                      value= "false"
                      v-model="form.is_superadmin"
                    />
                    <label class="custom-control-label" :for="`role-${editedUser.id}-member`">
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
                    :id="`permission-${editedUser.id}-${permission}`"
                    :value="permission"
                    v-model="form.permissions"
                  />
                  <label
                    class="custom-control-label"
                    style="text-transform: capitalize;"
                    :for="`permission-${editedUser.id}-${permission}`"
                    >{{ permission }}</label
                  >
                </div>
                <div class="invalid-feedback">
                  {{ getErrors("permissions") }}
                </div>
              </div>
            </div>
            <div class="form-group mt-4 text-right">
              <button
                class="btn btn-secondary text-white shadow mx-2"
                @click="doReset()"
              >
                RESET
              </button>
              <button
                class="btn btn-primary shadow"
                v-show="!isLoading"
                @click="doSubmit()"
              >
                Save
              </button>
              <button class="btn btn-primary" disabled v-show="isLoading">
                Saving...
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
  name: "UserEditModal",
  props: {
    editedUser: {
      type: Object,
    },
    permissions: Array,
  },

  data() {
    return {
      form: {},
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    async doSubmit() {
      this.isLoading = true;

      try {
        let response = await axios.put(
          "/user/" + this.editedUser.id.toString(),
          this.form
        );
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
      this.form = {...this.editedUser}
      this.form.is_superadmin = this.form.is_superadmin == true ? 'true' : 'false';
      if (this.form.permissions == null) {
        this.form.permissions = []
      }
    }
  },
  mounted() {
    this.form = {...this.editedUser}
    this.form.is_superadmin = this.form.is_superadmin == true ? 'true' : 'false';
    if (this.form.permissions == null) {
      this.form.permissions = []
    }
  }
};
</script>

<style lang="scss" scoped>
</style>