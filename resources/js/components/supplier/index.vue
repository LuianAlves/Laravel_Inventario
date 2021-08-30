<template>
    <div>
        <div class="row justify-content-between mb-3 mt-5">
            <div class="col-6">
                <router-link
                    to="/store-supplier"
                    class="
            btn btn-primary btn-sm btn-icon-split
            font-weight-bold
            text-white
          "
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-marker"></i>
                    </span>
                    <span class="text">New Supplier</span>
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
                        <h6 class="m-0 font-weight-bold text-primary">
                            List Suppliers
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Shop Name</th>
                                    <th>Photo</th>
                                    <th>Phone</th>
                                    <th>Name</th>
                                    <!-- <th>Email</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="supplier in filtersearch"
                                    :key="supplier.id"
                                >
                                    <td>{{ supplier.shopname }}</td>
                                    <td>
                                        <img
                                            :src="supplier.photo"
                                            style="height: 40px; width: 40px; border-radius: 50%"
                                        />
                                    </td>
                                    <td>{{ supplier.phone }}</td>
                                    <td>{{ supplier.name }}</td>
                                    <!-- <td>{{ supplier.email }}</td> -->
                                    <td>
                                        <router-link
                                            :to="{name: 'edit-supplier', params: {id:supplier.id} }"
                                            class="btn btn-info btn-sm"
                                        >
                                            <i class="fas fa-edit"></i>
                                        </router-link>
                                        <a
                                            @click="deleteSupplier(supplier.id)"
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
            suppliers: [],
            searchTerm: ""
        };
    },

    methods: {
        allSupplier() {
            // crud - Read
            let url = "api/supplier";
            axios
                .get(url)
                .then(({ data }) => (this.suppliers = data))
                .catch();
        },

        deleteSupplier(id) {
            // crud - Delete
            let url = "api/supplier/" + id;

            Swal.fire({
                // alert-modal
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete(url)
                        .then(() => {
                            this.suppliers = this.suppliers.filter(supplier => {
                                return supplier.id != id;
                            });
                        })
                        .catch(() => {
                            this.$router.push({ name: "supplier" });
                        });

                    Notification.delete(); // notification
                }
            });
        }
    },

    computed: {
        // search itens
        filtersearch() {
            return this.suppliers.filter(supplier => {
                return supplier.name.match(this.searchTerm);
            });
        }
    },

    mounted() {
        this.allSupplier(); // crud - Read
    }
};
</script>
