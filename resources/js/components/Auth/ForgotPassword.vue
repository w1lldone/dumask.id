<template>
  <div>
    <div class="card border-0 shadow my-auto" style="border-radius: 0.5em">
      <div class="card-body">
          <div class="text-center mb-3">
            <img src="/img/logo_navbar.svg" class="w-md-50" alt="logo_dumask">
          </div>
          <p class="text-justify text-muted w-100 my-4">
            Masukkan alamat email akun Dumask.id<sup>&reg;</sup> Anda. 
            Kami akan mengirimkan link untuk reset password. 
          </p>

          <p v-show="isSent" class="text-justify text-success w-100 my-4">
            Kami telah mengirimkan link untuk reset password melalui email Anda. 
          </p>

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

          <div class="form-group mt-4 text-right">
            <button
              class="btn btn-primary w-100"
              v-show="!isLoading"
              @click="doEmailPasswordReset()"
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
  name: "ForgotPassword",

  data() {
    return {
      form: {
        email: null,
      },
      isLoading: false,
      isSent: false,
      errors: {},
    };
  },

  methods: {
    async doEmailPasswordReset() {
      this.isLoading = true;

      try {
        let response = await axios.post("/forgot-password", this.form);
        this.isSent = true;
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