<template>
  <div>
    <div class="row mb-3 mt-5">
      <div class="col-12">
        <router-link
          to="/category"
          class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
        >
          <span class="icon text-white-50">
            <i class="fas fa-paste"></i>
          </span>
          <span class="text">All Category</span>
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
                    <h1 class="h4 text-gray-900 pb-4">Category Update</h1>
                  </div>
                  <form
                    class="user"
                    @submit.prevent="categoryUpdate"
                    enctype="multipart/form-data"
                  >
                    <!-- 01 | Name, Email -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Name -->
                        <div class="col-6">
                          <input
                            type="text"
                            class="form-control"
                            id="name"
                            placeholder="Enter Category Name"
                            v-model="form.category_name"
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
        category_name: "",
      },

      errors: {},
    };
  },

  created() {
    // crud - read on input edit
    let id = this.$route.params.id;
    let url = '/api/category/'
    axios
      .get(url + id)
      .then(({ data }) => (this.form = data))
      .catch((error) => {
        console.log(error);
      });
  },

  methods: {
    categoryUpdate() {
      let id = this.$route.params.id;
      let url = '/api/category/'
        axios.patch(url+id, this.form)
          .then((response) => {
            this.$router.push({ name: 'category' })

            Notification.success()
          })
          .catch((error) => {
            this.errors = error.response.data.errors
          })
    },
  },
};
</script>
