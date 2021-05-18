<template>
  <div>
    <div class="card border-0 shadow my-auto" style="border-radius: 0.5em">
      <div class="card-body">
          <div class="text-center mb-3">
            <img src="/img/logo_navbar.svg" class="w-md-50" alt="logo_dumask">
          </div>
          <h2 class="text-center font-weight-bold text-primary">
              SELAMAT DATANG
          </h2>
          <div class="flex text-center">
            <a
              href="/auth/google/redirect"
              class="btn btn-outline-dark btn-google my-2 mx-auto"
              style="padding-right: 8px; padding-left: 8px; height: 40px"
            >
              <div class="d-flex h-100">
                  <img
                    src="/img/icon_google.png"
                    alt=""
                    class="ml-auto my-auto"
                    style="max-width: 18px; height: 18px;">
                  <span
                    class="mr-auto my-auto"
                    style="font-weight: 500; font-size: 14px; padding-left: 24px;"
                  >
                  Sign in with Google
                  </span>
              </div>
            </a>
          </div>
          <p
            class="text-center text-muted w-100 my-4"
            style="border-bottom: 1px solid #D5D5D5; line-height: 0.1em; margin: 10px 0 20px;"
          >
            <span style="background:#fff; padding:0 10px;">atau</span>
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

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" v-model="form.password" class="form-control" :class="{ 'is-invalid': hasErrors('password') }"/>
            <div class="invalid-feedback">
              {{ getErrors("password") }}
            </div>
          </div>

          <div class="form-group">
            <div class="custom-control custom-checkbox form-check-inline">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="remember_me"
                  v-model="form.remember"
                />
               <label for="remember_me" class="custom-control-label inline-flex items-center">Remember me</label>
            </div>
          </div>

          <div class="form-group mt-4 text-right">
            <button
              class="btn btn-primary w-100"
              v-show="!isLoading"
              @click="doLogin()"
            >
              MASUK
            </button>
            <button class="btn btn-primary w-100" disabled v-show="isLoading">
              MASUK
            </button>
          </div>
          <p class="text-center text-muted mt-2">
              Belum punya akun? Daftar
              <span><a href="/register">di sini.</a></span>
          </p>
          <p class="text-center text-muted mt-2">
              <span><a href="/forgot-password">Lupa Password?</a></span>
          </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginPage",

  data() {
    return {
      form: {
        email: null,
        password: null,
        remember: false
      },
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    async doLogin() {
      this.isLoading = true;

      try {
        let response = await axios.post("/login", this.form);
        window.location = response.data.redirect_url
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
 @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');
  .btn-google{
    font-family: 'Roboto', sans-serif !important;
    font-weight: 500 !important;
    color: #292929;
    background-color: white;
  }

  .btn-google:hover{
    background: #FFFFFF !important;
    border-color: black !important;
  }
</style>
