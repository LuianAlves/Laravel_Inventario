<template>
  <div>
    <div class="row mb-3 mt-5">
      <div class="col-12">
        <router-link
          to="/customer"
          class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
        >
          <span class="icon text-white-50">
            <i class="fas fa-paste"></i>
          </span>
          <span class="text">All Customer</span>
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
                    <h1 class="h4 text-gray-900 pb-4">Add Customere</h1>
                  </div>
                  <form
                    class="user"
                    @submit.prevent="customerInsert"
                    enctype="multipart/form-data"
                  >
                    <!-- 01 | Name, Email -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Name -->
                        <div class="col-5 offset-1">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="buying_price"
                            ><b>Customer Name</b></label
                          >
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            id="name"
                            placeholder="Enter Full Name"
                            v-model="form.name"
                          />
                        </div>
                        <!-- Email -->
                        <div class="col-4 offset-1">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="buying_price"
                            ><b>Customer Email</b></label
                          >
                          <input
                            type="email"
                            class="form-control form-control-sm"
                            id="email"
                            aria-describedby="emailHelp"
                            placeholder="Enter Email Address"
                            v-model="form.email"
                          />
                        </div>
                      </div>
                    </div>

                    <!-- 02 | Address, Phone, Sallery -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- Address -->
                        <div class="col-5 offset-1">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="buying_price"
                            ><b>Customer Address</b></label
                          >
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            id="address"
                            placeholder="Enter Your Address"
                            v-model="form.address"
                          />
                        </div>
                        <!--Phone -->
                        <div class="col-4 offset-1">
                          <label
                            style="font-size: 13px; color: #a38cff"
                            for="buying_price"
                            ><b>Customer Phone</b></label
                          >
                          <input
                            type="text"
                            class="form-control form-control-sm"
                            id="phone"
                            placeholder="Enter Phone Number"
                            v-model="form.phone"
                          />
                        </div>
                      </div>
                    </div>

                    <!--  04 | Photo -->
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-5 offset-1 mt-3">
                          <input
                            type="file"
                            class="custom-file-input form-control-sm"
                            id="customFile"
                            @change="onFileSelected"
                          />
                          <label class="custom-file-label col-form-label-sm" for="customFile"
                            >Customer Photo</label
                          >
                        </div>
                        <div class="col-1 offset-1 mt-3">
                          <img
                            :src="form.photo"
                            style="height: 35px; width: 40px"
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
        name: null,
        email: null,
        address: null,
        phone: null,
        photo: null
      },

      errors: {},
    };
  },

  methods: {
    onFileSelected(e) {
      // Imagem ao Lado do Input form.photo
      let file = e.target.files[0];
      if (file.size > 1048770) {
        Notification.image_validation();
      } else {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.form.photo = e.target.result;
          // console.log(this.form.photo)
        };

        reader.readAsDataURL(file);
      }
      // console.log(files)
    },
    customerInsert() {
      // crud - Create
      let url = "api/customer";
      axios
        .post(url, this.form)
        .then((response) => {
          console.log(response);

          this.$router.push({ name: "customer" });

          Notification.success();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
