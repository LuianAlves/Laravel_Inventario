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
                    <h1 class="h4 text-gray-900 pb-4">Add Category</h1>
                  </div>

                  <form
                    class="user"
                    @submit.prevent="categoryInsert"
                    enctype="multipart/form-data"
                  >
                    <!-- 01 | Name -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Name -->
                        <div class="col-6">
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            id="category_name"
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
                            class="btn btn-info btn-sm btn-icon-split font-weight-bold float-right"
                          >
                            <span class="text">Create</span>
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
            category_name: null,
        },

        errors: {},
        };
    },

    methods: {
        categoryInsert() {
            //crud - create

            let url = 'api/category'

            axios.post(url, this.form)
                .then((response) => {
                    this.$router.push({ name: 'category' })

                    Notification.success()
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        }
    },
};
</script>
