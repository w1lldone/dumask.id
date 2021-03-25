<template>
  <div>
    <li class="nav-item">
        <a 
        class="nav-link text-primary font-weight-bold"
        data-toggle="modal"
        data-target="#login-modal"
        href="#"
        >
        MASUK
        </a>
    </li>
    <div
      class="modal fade"
      id="login-modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal-id"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" v-show="isPageLogin" role="document">
        <div class="modal-content">
          <div class="modal-header border-0 mx-4">
              <div class="flex">
                <h2
                class="modal-title font-weight-bold text-primary"
                >
                MARI BERGABUNG
                </h2>
                <h5
                class="modal-title font-weight-bold text-secondary"
                >
                BERSAMA DUMASK.ID
                </h5>
              </div>
            
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
            <a href="/auth/google/redirect" class="btn btn-secondary w-100 my-2">
                <div class="d-flex">
                    <span class="ml-auto pr-3 mdi mdi-google"></span>
                    <span class="mr-auto">MASUK DENGAN GOOGLE</span>
                </div>
            </a>   
            
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
                <span><a href="#" @click="toggleModalType()">di sini.</a></span>
            </p>
          </div>
        </div>
      </div>

      <div class="modal-dialog modal-dialog-centered" v-show="!isPageLogin" role="document">
        <div class="modal-content">
          <div class="modal-header border-0 mx-4">
              <div class="flex">
                <h2
                class="modal-title font-weight-bold text-primary"
                >
                MARI BERGABUNG
                </h2>
                <h5
                class="modal-title font-weight-bold text-secondary"
                >
                BERSAMA DUMASK.ID
                </h5>
              </div>
            
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
            <a href="/auth/google/redirect" class="btn btn-secondary w-100 my-2">
                <div class="d-flex">
                    <span class="ml-auto pr-3 mdi mdi-google"></span>
                    <span class="mr-auto">MASUK DENGAN GOOGLE</span>
                </div>
            </a>   
            
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
                <span><a href="#" @click="toggleModalType()">di sini.</a></span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginModal",

  data() {
    return {
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
      isLoading: false,
      isPageLogin: true,
      errors: {},
    };
  },

  methods: {
    async doLogin() {
      this.isLoading = true;

      try {
        let response = await axios.post("/login", this.form);
        return location.reload();
      } catch (error) {
        console.log(error.response);
        this.errors = error.response.data.errors;
      }

      this.isLoading = false;
    },

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

    toggleModalType(){
      this.isPageLogin = !this.isPageLogin;
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