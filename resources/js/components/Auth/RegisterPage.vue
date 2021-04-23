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
                MARI BERGABUNG
                </h2>
                <h5
                class="text-center font-weight-bold text-secondary"
                >
                BERSAMA DUMASK.ID
                </h5>
            </div>
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
                  Sign up with Google
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
            <label for="name">Nama</label>
            <input type="name"
            required 
            v-model="form.name" 
            class="form-control"
            :class="{ 'is-invalid': hasErrors('name') }"
            />
            <div class="invalid-feedback">
              {{ getErrors("name") }}
            </div>
          </div>

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
              @click="doRegister()"
            >
              DAFTAR
            </button>
            <button class="btn btn-primary w-100" disabled v-show="isLoading">
              DAFTAR
            </button>
          </div>
          <p class="text-center text-muted mt-2">
              Sudah punya akun? Masuk
              <span><a href="/login">di sini.</a></span>
          </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "RegisterPage",

  data() {
    return {
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
      isLoading: false,
      errors: {},
    };
  },

  methods: {
    async doRegister() {
      this.isLoading = true;

      try {
        let response = await axios.post("/register", this.form);
        return location.reload();
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