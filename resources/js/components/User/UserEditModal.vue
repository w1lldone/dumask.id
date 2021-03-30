<template>
  <div>
    <button
      class="btn btn-warning"
      data-toggle="modal"
      :data-target="'#edit-user-modal-' + editedUser.id"
    >
      Edit
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
          <div class="modal-body mx-4">
            <div class="form-group">
              <label for="name">Name</label>
              <input
                type="text"
                class="form-control"
                :class="{ 'is-invalid': hasErrors('name') }"
                v-model="form.name"
              />
              <div class="invalid-feedback">
                {{ getErrors("name") }}
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                required
                v-model="form.email"
                class="form-control"
                :class="{ 'is-invalid': hasErrors('email') }"
              />
              <div class="invalid-feedback">
                {{ getErrors("email") }}
              </div>
            </div>
            <div class="form-group py-2">
              <div class="custom-control custom-checkbox form-check-inline">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  :id="'checkbox-user-' + editedUser.id"
                  v-model="form.is_superadmin"
                />
                <label
                  class="custom-control-label"
                  :for="'checkbox-user-' + editedUser.id"
                  >Make user superadmin</label
                >
              </div>
            </div>
            <div class="form-group" v-if="form.is_superadmin == false">
              <label for="permissions">Permissions</label>
              <div
                class="custom-control custom-checkbox form-check-inline"
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
                  :for="`permission-${editedUser.id}-${permission}`"
                  >{{ permission }}</label
                >
              </div>
              <div class="invalid-feedback">
                {{ getErrors("permissions") }}
              </div>
            </div>
            <div class="form-group mt-4 text-right">
              <button
                class="btn btn-success"
                v-show="!isLoading"
                @click="doSubmit()"
              >
                Save user
              </button>
              <button class="btn btn-success" disabled v-show="isLoading">
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
  },
  mounted() {
    this.form = {...this.editedUser}
    if (this.form.permissions == null) {
      this.form.permissions = []
    }
  }
};
</script>

<style lang="scss" scoped>
</style>