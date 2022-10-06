<template>
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                  </div>
                  <div class="alert alert-danger" v-if="errors.invalid">{{ errors.invalid }}</div>
                  <form class="user" autocomplete="off">
                    <div
                      class="form-group"
                      :class="{
                                                'has-error': errors.email
                                            }"
                    >
                      <input
                        type="text"
                        class="form-control form-control-user"
                        placeholder="Enter Email..."
                        v-model="data.email"
                        autocomplete="false"
                      />
                      <p class="text-danger" v-if="errors.email">{{ errors.email[0] }}</p>
                    </div>
                    <div
                      class="form-group"
                      :class="{
                                                'has-error': errors.email
                                            }"
                    >
                      <input
                        type="password"
                        class="form-control form-control-user"
                        placeholder="Password"
                        autocomplete="false"
                        v-model="data.password"
                      />
                      <p class="text-danger" v-if="errors.password">{{ errors.password[0] }}</p>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input
                          type="checkbox"
                          class="custom-control-input"
                          id="customCheck"
                          v-model="data.remember_me"
                        />
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button
                      type="submit"
                      class="btn btn-primary btn-user btn-block"
                      @click.prevent="postLogin"
                    >Login</button>
                    <hr />
                  </form>
                  <div class="text-center">
                    <router-link class="small" to="/forgot-password">Lupa Password?</router-link>
                  </div>
                  <div class="text-center">
                    <router-link class="small" to="/register">Daftar Akun !</router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapMutations, mapGetters, mapState } from "vuex";
export default {
  data() {
    return {
      data: {
        email: "",
        password: "",
        remember_me: false,
      },
      reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
    };
  },

  created() {
    if (this.isAuth) {
      this.$router.push({ name: "home" });
    }
  },
  computed: {
    ...mapGetters(["isAuth"]),
    ...mapState(["errors"]),
  },
  methods: {
    ...mapActions("auth", ["submit"]),
    ...mapActions("user", ["getUserLogin"]),
    ...mapMutations(["CLEAR_ERRORS"]),

    postLogin() {
      this.$vs.loading();
      if (!this.data.email) {
        setTimeout(() => {
          this.$vs.loading.close();
        }, 500);
      }
      if (!this.data.password) {
        setTimeout(() => {
          this.$vs.loading.close();
        }, 500);
      }
      if (!this.reg.test(this.data.email)) {
        setTimeout(() => {
          this.$vs.loading.close();
        }, 500);
      }
      this.submit(this.data).then(() => {
        if (this.isAuth) {
          setTimeout(() => {
            this.$vs.loading.close();
          }, 2000);
          this.CLEAR_ERRORS();
          this.getUserLogin();
          this.$router.push({ name: "home" });
          this.$swal({
            toast: true,
            position: "top-start",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
            icon: "success",
            title: "Login Berhasil",
          });
        } else {
          setTimeout(() => {
            this.$vs.loading.close();
          }, 500);
        }
      });
    },
  },
};
</script>
