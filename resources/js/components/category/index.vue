<template>
  <div>
    <div class="row justify-content-between mb-3 mt-5">
      <div class="col-6">
        <router-link
          to="/store-category"
          class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
        >
          <span class="icon text-white-50">
            <i class="fas fa-marker"></i>
          </span>
          <span class="text">New Category</span>
        </router-link>
      </div>
      <div class="col-3">
        <input
          v-model="searchTerm"
          class="form-control form-control-sm float-right"
          type="text"
          placeholder="Search Name"
        />
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 my-2">
        <!-- Simple Tables -->
        <div class="card">
          <div
            class="
              card-header
              py-3
              d-flex
              flex-row
              align-items-center
              justify-content-between
            "
          >
            <h6 class="m-0 font-weight-bold text-primary">List Categories</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="category in filtersearch" :key="category.id">
                  <td>{{ category.category_name }}</td>
                  <td>
                    <router-link
                      :to="{
                        name: 'edit-category',
                        params: { id: category.id },
                      }"
                      class="btn btn-info btn-sm"
                    >
                      <i class="fas fa-edit"></i>
                    </router-link>
                    <a
                      @click="deleteCategory(category.id)"
                      class="btn btn-danger btn-sm text-white"
                    >
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
    <!--Row-->
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
      categories: [],
      searchTerm: "",
    };
  },

  methods: {
    allCategory() {
      // crud - Read
      let url = "api/category";

      axios
        .get(url)
        .then(({ data }) => (this.categories = data))
        .catch();
    },

    deleteCategory(id) {
      // crud - delete
      let url = "/api/category/";
      // alert-modal
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(url+id)
            .then(() => {
              this.categories = this.categories.filter((category) => {
                return category.id != id;
              });
            })
            .catch(() => {
              this.$router.push({ name: "category" });
            });

          Notification.delete();
        }
      });
    },
  },

  computed: {
    //serach items
    filtersearch() {
      return this.categories.filter((category) => {
        return category.category_name.match(this.searchTerm);
      });
    },
  },

  mounted() {
    this.allCategory(); // crud - Read
  },
};
</script>
