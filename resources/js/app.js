require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

// Router Imported
import { routes } from "./routes";

// Import User Class
import User from "./Helpers/User";
window.User = User;

// Import NotificationClass
import Notification from "./Helpers/Notification";
window.Notification = Notification;




// Import Sweet Alerts START
import Swal from "sweetalert2";
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: toast => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    }
});

window.Toast = Toast;
// Import Sweet Alerts END


window.Reload = new Vue();


const router = new VueRouter({
    routes,
    mode: "history"
});

const app = new Vue({
    el: "#app",
    router
});