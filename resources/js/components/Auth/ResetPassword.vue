<template>
  <div>
    <div class="card border-0 shadow my-auto" style="border-radius: 0.5em">
      <div class="card-body">
          <div class="text-center mb-3">
            <img src="/img/logo_navbar.svg" class="w-50" alt="logo_dumask">
          </div>
          <div class="flex text-center mb-3">
              <h2
              class="text-center font-weight-bold text-primary"
              >
              RESET PASSWORD
              </h2>
          </div>

          <input type="hidden" name="token" v-model="form.token">

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email"
            required 
            v-model="form.email" 
            class="form-control"
            :class="{ 'is-invalid': hasErrors('email') }"
            />
            <div class="invalid-feedback">
              {{ getErrors("email") }}
            </div>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" v-model="form.password" class="form-control" :class="{ 'is-invalid': hasErrors('password') }"/>
            <div class="invalid-feedback">
              {{ getErrors("password") }}
            </div>
          </div>

          <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" v-model="form.password_confirmation" class="form-control" :class="{ 'is-invalid': hasErrors('password_confirmation') }"/>
            <div class="invalid-feedback">
              {{ getErrors("password_confirmation") }}
            </div>
          </div>

          <div class="form-group mt-4 text-right">
            <button
              class="btn btn-primary w-100"
              v-show="!isLoading"
              @click="doResetPassword()"
            >
              RESET PASSWORD
            </button>
            <button class="btn btn-primary w-100" disabled v-show="isLoading">
              RESET PASSWORD
            </button>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ResetPassword",

  props: {
    email: {
      type: String
    },
    token: {
      type: String
    }
  },

  data() {
    return {
      form: {
        token: this.token,
        email: this.email,
        password: null,
        password_confirmation: null,
      },
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    async doResetPassword() {
      this.isLoading = true;

      try {
        let response = await axios.post("/reset-password", this.form);
        //return location.href('/dashboard');
      } catch (error) {
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
};
</script>

<style lang="scss" scoped>

</style>