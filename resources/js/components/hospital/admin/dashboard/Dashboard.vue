<template>
    <div id="app">
        <div class="main-wrapper main-wrapper-1 mt-5">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline me-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-bs-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"><i class="fa-solid fa-bars text-muted"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i class="fa-solid fa-expand text-muted"></i>
                            </a></li>
                        <li>
                            <!-- <form class="form-inline me-auto">
                                <div class="search-element d-flex">
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form> -->
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-bs-toggle="dropdown"
                            class="nav-link nav-link-lg message-toggle">
                            <i class="fa-regular fa-envelope text-muted"></i>
                            <span class="badge headerBadge1">
                                6 </span> </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">
                                Messages
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-message">
                                <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="../../../../../../public/hospital/backend/app/assets/img/users/user-1.png"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">John
                                            Deo</span>
                                        <span class="time messege-text">Please check your mail !!</span>
                                        <span class="time">2 Min Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                                        <img alt="image"
                                            src="../../../../../../public/hospital/backend/app/assets/img/users/user-2.png"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                                            Smith</span> <span class="time messege-text">Request for leave
                                            application</span>
                                        <span class="time">5 Min Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                                        <img alt="image"
                                            src="../../../../../../public/hospital/backend/app/assets/img/users/user-5.png"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">Jacob
                                            Ryan</span> <span class="time messege-text">Your payment invoice is
                                            generated.</span> <span class="time">12 Min Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                                        <img alt="image"
                                            src="../../../../../../public/hospital/backend/app/assets/img/users/user-4.png"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">Lina
                                            Smith</span> <span class="time messege-text">hii John, I have upload
                                            doc
                                            related to task.</span> <span class="time">30
                                            Min Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                                        <img alt="image"
                                            src="../../../../../../public/hospital/backend/app/assets/img/users/user-3.png"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">Jalpa
                                            Joshi</span> <span class="time messege-text">Please do as specify.
                                            Let me
                                            know if you have any query.</span> <span class="time">1
                                            Days Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                                        <img alt="image"
                                            src="../../../../../../public/hospital/backend/app/assets/img/users/user-2.png"
                                            class="rounded-circle">
                                    </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                                            Smith</span> <span class="time messege-text">Client Requirements</span>
                                        <span class="time">2 Days Ago</span>
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li> -->
                    <!-- <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-bs-toggle="dropdown"
                            class="nav-link notification-toggle nav-link-lg"><i
                                class="fa-regular fa-bell text-muted"></i>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">
                                Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread"> <span
                                        class="dropdown-item-icon bg-primary text-white"> <i class="fas
												fa-code"></i>
                                    </span> <span class="dropdown-item-desc"> Template update is
                                        available now! <span class="time">2 Min
                                            Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-icon bg-info text-white"> <i class="far
												fa-user"></i>
                                    </span> <span class="dropdown-item-desc"> <b>You</b> and <b>Dedik
                                            Sugiharto</b> are now friends <span class="time">10 Hours
                                            Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-icon bg-success text-white"> <i class="fas
												fa-check"></i>
                                    </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
                                        moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                                            Hours
                                            Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-icon bg-danger text-white"> <i
                                            class="fas fa-exclamation-triangle"></i>
                                    </span> <span class="dropdown-item-desc"> Low disk space. Let's
                                        clean it! <span class="time">17 Hours Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span
                                        class="dropdown-item-icon bg-info text-white"> <i class="fas
												fa-bell"></i>
                                    </span> <span class="dropdown-item-desc"> Welcome to Otika
                                        template! <span class="time">Yesterday</span>
                                    </span>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li> -->
                    <li class="dropdown"><a href="#" data-bs-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img v-if="role === 'Admin' && hospitals.logo"
                                :src="`/hospital/backend/img/users/logo/${hospitals.logo}`" alt="User Logo"
                                class="user-img-radious-style" />
                            <img v-else-if="role === 'Doctor' && hospitals.doctor_image" :src="hospitals.doctor_image"
                                alt="Doctor Image" class="user-img-radious-style" />

                            <span class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title"><span v-if="role === 'Admin'" class="d-block">{{
                                hospitals.admin_name }}</span> <span v-else-if="role === 'Doctor'"
                                    class="d-block">{{ hospitals.doctorName }}</span>
                            </div>
                            <a href="#" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                            </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                                Activities
                            </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                                Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a @click="logout" class="dropdown-item has-icon text-danger" style="cursor: pointer;"> <i
                                    class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrappe">
                    <div class="sidebar-brand bg-info">
                        <a href="#">
                            <img v-if="role === 'Admin' && hospitals.logo"
                                :src="`/hospital/backend/img/users/logo/${hospitals.logo}`" alt="User Logo" width="60px"
                                height="auto" />

                            <img v-else-if="role === 'Doctor' && hospitals.doctor_image" :src="hospitals.doctor_image"
                                alt="Doctor Image" width="60px" height="60px" />

                            <p class="logo-name bg-info text-white py-3" style="font-size: 12px; line-height: 1.7;">
                                <span>{{ role ? role : 'Admin' }}</span>
                                <span v-if="role === 'Admin'" class="d-block">{{ hospitals.admin_name }}</span>
                                <span v-else-if="role === 'Doctor'" class="d-block">{{ hospitals.doctorName }}</span>
                            </p>
                        </a>
                    </div>
                    <ul class="sidebar-menu mt-3">
                        <li class="menu-header">Main</li>
                        <li class="dropdown active">
                            <router-link to="/hospital_dashboard" href="index.html" class="nav-link"><i
                                    class="fa-solid fa-desktop text-muted"></i><span>Dashboard</span></router-link>
                        </li>
                        <li v-show="role === 'Admin'" class="dropdown" style="cursor: pointer;">
                            <a class="menu-toggle nav-link has-dropdown"><i
                                    class="fa-solid fa-layer-group"></i><span>Options</span></a>
                            <ul class="dropdown-menu">
                                <li><router-link to="/department-category"
                                        class="nav-link">Department/Category</router-link></li>
                                <li><router-link to="/symtom" class="nav-link" href="chat.html">Symtoms</router-link>
                                </li>
                                <li><router-link to="/specialist" class="nav-link">Specialist</router-link></li>
                                <li><router-link to="/room" class="nav-link">Room Number</router-link></li>
                                <li><router-link to="/reference" class="nav-link">Reference</router-link></li>
                            </ul>
                        </li>

                        <li v-show="role === 'Admin'" class="dropdown" style="cursor: pointer;">
                            <a class="menu-toggle nav-link has-dropdown"><i
                                    class="fa-solid fa-layer-group"></i><span>Pathology</span></a>
                            <ul class="dropdown-menu">
                                <li><router-link to="/pathology-category" class="nav-link">Pathology-Category</router-link></li>
                                <li><router-link to="/pathology" class="nav-link">Pathology</router-link></li>
                            </ul>
                        </li>

                        <li v-show="role === 'Admin'" class="dropdown" style="cursor: pointer;">
                            <a class="menu-toggle nav-link has-dropdown"><i
                                    class="fa-solid fa-mortar-pestle"></i><span>Pharmacy</span></a>
                            <ul class="dropdown-menu">
                                <li><router-link to="/medicine-group" class="nav-link">Medicine Group</router-link></li>
                                <li><router-link to="/medicine" class="nav-link">Medicine</router-link>
                                </li>
                            </ul>
                        </li>
                        <li v-show="role === 'Admin'" class="dropdown">
                            <router-link to="/doctor" href="#" class="menu-toggle nav-link has-dropdown"><i
                                    class="fa-solid fa-user-doctor"></i><span>Doctor</span></router-link>
                        </li>
                        <li v-show="role === 'Admin'" class="dropdown" style="cursor: pointer;">
                            <router-link to="/appoinment-list" class="menu-toggle nav-link has-dropdown"><i
                                    class="fa-solid fa-calendar-check"></i><span>Appoinment</span></router-link>
                        </li>

                        <li v-show="role === 'Doctor'" class="dropdown">
                            <router-link to="/patient-list" href="#" class="menu-toggle nav-link has-dropdown"><i
                                    class="fa-solid fa-user-doctor"></i><span>Visited Patient List</span></router-link>
                        </li>
                        <li v-show="role === 'Doctor'" class="dropdown" style="cursor: pointer;">
                            <router-link to="/patient-prescription" class="menu-toggle nav-link has-dropdown"><i
                                    class="fa-solid fa-prescription"></i><span>Patient-Prescription</span></router-link>
                        </li>

                    </ul>
                </aside>
            </div>
            <!-- <div class="main-content">
                <section class="section" style="margin-top: -80px;">
                    <router-view name="content"></router-view>
                </section>
            </div> -->
            <div class="main-content">
                <section v-if="$route.path === '/hospital_dashboard'" class="section" style="margin-top: -80px;">
                    <h1 v-if="role === 'Doctor'" class="text-center">Hello {{ hospitals.doctorName }}</h1>
                    <h1 v-else-if="role === 'Admin'" class="text-center">Hello {{ hospitals.admin_name }}</h1>
                </section>
                <section v-else class="section" style="margin-top: -80px;">
                    <router-view name="content"></router-view>
                </section>
            </div>
            <!-- <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2019 <div class="bullet"></div> Design By <a href="#">Redstar</a>
                </div>
                <div class="footer-right">
                </div>
            </footer> -->
        </div>
    </div>
</template>

<script>
import { computed, onBeforeMount, onMounted, ref } from 'vue';
import Cookies from 'js-cookie';
import { useRouter } from 'vue-router';
import axios from 'axios';
computed
export default {
    name: 'Dashboard',
    setup() {
        const router = useRouter();
        const hasReloaded = sessionStorage.getItem('hasReloaded');
        const access_token = ref('');
        const hospitals = ref({});
        const role = ref('');
        onBeforeMount(() => {
            const styleLink = document.createElement("link");
            styleLink.rel = "stylesheet";
            styleLink.href = "/hospital/backend/app/assets/css/style.css";
            document.head.appendChild(styleLink);
        });
        const clearAllCookies = () => {
            const allCookies = Cookies.get();
            Object.keys(allCookies).forEach((cookie) => {
                Cookies.remove(cookie, { secure: true, sameSite: 'Strict' });
            });
            console.log('All cookies have been cleared.');
        };

        const hospital = async () => {
            try {
                const response = await axios.get('/api/auth/me', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data.role === 'Admin') {
                    role.value = response.data.role;
                    hospitals.value = response.data.user;
                }
                else if (response.data.role === 'Doctor') {
                    role.value = response.data.role;
                    hospitals.value = response.data.user;
                }
            } catch (error) {
                console.error('Error fetching hospital data:', error.response ? error.response.data : error.message);
            }
        };


        const logout = async () => {
            try {
                const response = await axios.post(
                    '/api/auth/logout',
                    {},
                    {
                        headers: {
                            'Authorization': `Bearer ${access_token.value}`
                        }
                    }
                );
                if (response.data && response.status === 200) {
                    clearAllCookies();
                    sessionStorage.removeItem('hasReloaded');
                    router.push({ name: 'Login' });
                    Toast.fire({
                        icon: "success",
                        title: "Successfully Logged Out!"
                    });
                }
            } catch (error) {
                console.log(error.response ? error.response.data : error.message);
            }
        };
        onMounted(async () => {
            access_token.value = Cookies.get('access_token');
            if (!hasReloaded) {
                sessionStorage.setItem('hasReloaded', 'true');
                window.location.reload();
            } else {
                sessionStorage.removeItem('hasReloaded');
                await hospital();
            }

        })
        return {
            logout,
            hospitals,
            role
        }
    }
}
</script>

<style scoped></style>