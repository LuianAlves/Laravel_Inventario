<template>
  <div>
    <div class="row mb-3 mt-5">
      <div class="col-12">
        <router-link
          to="/employee"
          class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
        >
          <span class="icon text-white-50">
            <i class="fas fa-paste"></i>
          </span>
          <span class="text">All Employee</span>
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
                    <h1 class="h4 text-gray-900 pb-4">Employee Update</h1>
                  </div>
                  <form
                    class="user"
                    @submit.prevent="employeeUpdate"
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
                            placeholder="Enter Full Name"
                            v-model="form.name"
                          />
                        </div>
                        <!-- Email -->
                        <div class="col-6">
                          <input
                            type="email"
                            class="form-control"
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
                        <div class="col-5">
                          <input
                            type="text"
                            class="form-control"
                            id="address"
                            placeholder="Enter Your Address"
                            v-model="form.address"
                          />
                        </div>
                        <!--Phone -->
                        <div class="col-4">
                          <input
                            type="number"
                            class="form-control"
                            id="phone"
                            placeholder="Enter Phone Number"
                            v-model="form.phone"
                          />
                        </div>
                        <!-- Sallery -->
                        <div class="col-3">
                          <input
                            type="number"
                            class="form-control"
                            id="sallery"
                            placeholder="Enter Your Sallery"
                            v-model="form.sallery"
                          />
                        </div>
                      </div>
                    </div>

                    <!-- 03 | Nid - Date -->
                    <div class="form-group">
                      <div class="form-row">
                        <!-- NID -->
                        <div class="col-5">
                          <input
                            type="number"
                            class="form-control"
                            id="nid"
                            placeholder="Enter NID"
                            v-model="form.nid"
                          />
                        </div>
                        <!-- Join Date -->
                        <div class="col-4">
                          <input
                            type="date"
                            class="form-control"
                            id="joining_date"
                            v-model="form.joining_date"
                          />
                        </div>
                      </div>
                    </div>

                    <!--  04 | Photo -->
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-6 m-1">
                          <input
                            type="file"
                            class="custom-file-input"
                            id="customFile"
                            @change="onFileSelected"
                          />
                          <label class="custom-file-label" for="customFile"
                            >Choose Photo</label
                          >
                        </div>
                        <div class="col-5 m-1">
                          <img
                            :src="form.photo"
                            style="height: 40px; width: 40px"
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
        name: '',
        email: '',
        address: '',
        phone: '',
        sallery: '',
        nid: '',
        joining_date: '',
        photo: '',
        newphoto: ''
      },

      errors: {},
    };
  },

  created() {
    let id = this.$route.params.id;

    axios
      .get('/api/employee/'+id)
      .then(({ data }) => (this.form = data))
      .catch((error) => {
        console.log(error);
      });
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
          this.form.newphoto = e.target.result;
          // console.log(this.form.photo)
        };

        reader.readAsDataURL(file);
      }
      // console.log(files)
    },

    employeeUpdate() {
      let id = this.$route.params.id;
      // crud - Update
      axios
        .patch('/api/employee/'+id, this.form)
        .then((response) => {
          console.log(response);

          this.$router.push({ name: "employee" });

          Notification.success();
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
};
</script>
