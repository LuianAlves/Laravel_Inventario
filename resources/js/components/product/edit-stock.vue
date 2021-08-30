<template>
  <div>
    <div class="row mb-3 mt-5">
      <div class="col-12">
        <router-link
          to="/stock"
          class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
        >
          <span class="icon text-white-50">
            <i class="fas fa-paste"></i>
          </span>
          <span class="text">Go Back</span>
        </router-link>
      </div>
    </div>

    <div class="row justify-content-center my-2">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-left">
                    <h1 class="h4 text-gray-900 pb-4">Stock Update</h1>
                  </div>
                  <form class="user" @submit.prevent="stockUpdate">
                    <!-- 01 | Quantity -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Quantity -->
                        <div class="col-2">
                          <label style="font-size: 13px; color: #a38cff"
                            >Product Stock</label
                          >
                          <input
                            type="number"
                            class="form-control form-control-sm"
                            v-model="form.product_quantity"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="justify-content-end form-row">
                        <div class="col-3 mt-5">
                          <button
                            type="submit"
                            class="
                              btn btn-info btn-sm btn-icon-split
                              font-weight-bold
                              float-right
                            "
                          >
                            <span class="text">Update</span>
                            <span class="icon text-white-50">
                              <i class="fas fa-arrow-right"></i>
                            </span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </form>
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
export default {
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: "/" });
    }
  },

  data() {
    return {
      form: {
        product_quantity: ''
      },

      errors: {},
    };
  },

  created() {
    let id = this.$route.params.id;
    let url = "/api/product/" + id;
    axios
      .get(url)
      .then(({ data }) => (this.form = data))
      .catch();
  },

  methods: {
    stockUpdate() {
      let id = this.$route.params.id;
      let url = '/api/stock/update/' + id

      // crud - Update
      axios
        .post(url, this.form)
        .then(() => {
          this.$router.push({ name: "stock" });

          Notification.success();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
