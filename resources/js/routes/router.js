import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/hospital/admin/auth/Login.vue';
import Register from '../components/hospital/admin/auth/Register.vue'
import Forget from '../components/hospital/admin/auth/Forget.vue';

import Home from '../components/hospital/user/Home.vue';
import DoctorappoinmentView from '../components/hospital/user/DoctorappoinmentView.vue';

import Dashboard from '../components/hospital/admin/dashboard/Dashboard.vue';

import Doctor from '../components/hospital/admin/dashboard/doctor/Doctor.vue';
import DoctorCreate from '../components/hospital/admin/dashboard/doctor/DoctorCreate.vue';
import DoctorView from '../components/hospital/admin/dashboard/doctor/DoctorView.vue';
import DoctorviewOffline from '../components/hospital/admin/dashboard/doctor/DoctorviewOffline.vue';
import DoctorEdit from '../components/hospital/admin/dashboard/doctor/DoctorEdit.vue';
import DoctorActive from '../components/hospital/admin/dashboard/doctor/DoctorActive.vue';
import DoctorInActive from '../components/hospital/admin/dashboard/doctor/DoctorInActive.vue';

import Appoinment from '../components/hospital/admin/dashboard/appoinment/Appoinment.vue';
import AppoinmentDetails from '../components/hospital/admin/dashboard/appoinment/AppoinmentDetails.vue';
import AppoinmentCreate from '../components/hospital/admin/dashboard/appoinment/AppoinmentCreate.vue';
import AppointReport from '../components/hospital/admin/dashboard/appoinment/AppointReport.vue';
import DoctorwiseReport from '../components/hospital/admin/dashboard/appoinment/DoctorwiseReport.vue';
import DoctorVisit from '../components/hospital/admin/dashboard/appoinment/DoctorVisit.vue';

import Symtom from '../components/hospital/admin/dashboard/options/symtom/Symtom.vue';
import SymtomCreate from '../components/hospital/admin/dashboard/options/symtom/SymtomCreate.vue';
import SymtomEdit from '../components/hospital/admin/dashboard/options/symtom/SymtomEdit.vue';

import Specialist from '../components/hospital/admin/dashboard/options/specialist/Specialist.vue';
import SpecialistCreate from '../components/hospital/admin/dashboard/options/specialist/SpecialistCreate.vue'
import SpecialistEdit from '../components/hospital/admin/dashboard/options/specialist/SpecialistEdit.vue';

import Experience from '../components/hospital/admin/dashboard/options/experience/Experience.vue';
import ExperienceCreate from '../components/hospital/admin/dashboard/options/experience/ExperienceCreate.vue';
import ExperienceEdit from '../components/hospital/admin/dashboard/options/experience/ExperienceEdit.vue';

import Department from '../components/hospital/admin/dashboard/options/department/Department.vue';
import DepartmentCreate from '../components/hospital/admin/dashboard/options/department/DepartmentCreate.vue';
import DepartmentEdit from '../components/hospital/admin/dashboard/options/department/DepartmentEdit.vue';

import Roomlist from '../components/hospital/admin/dashboard/options/room/Roomlist.vue';
import RoomListCreate from '../components/hospital/admin/dashboard/options/room/RoomlistCreate.vue'
import RoomlistEdit from '../components/hospital/admin/dashboard/options/room/RoomlistEdit.vue';

import ReferenceList from '../components/hospital/admin/dashboard/options/reference/RferenceList.vue';
import ReferenceCreate from '../components/hospital/admin/dashboard/options/reference/ReferenceCreate.vue'
import ReferenceEdit from '../components/hospital/admin/dashboard/options/reference/ReferenceEdit.vue';

import Medicine from '../components/hospital/admin/dashboard/pharmacy/medicine/Medicine.vue';
import MedicineCreate from '../components/hospital/admin/dashboard/pharmacy/medicine/MedicineCreate.vue';
import MedicineEdit from '../components/hospital/admin/dashboard/pharmacy/medicine/MedicineEdit.vue';

import MedicineGoup from '../components/hospital/admin/dashboard/pharmacy/medicine-group/MedicineGoup.vue';
import MedicinegroupCreate from '../components/hospital/admin/dashboard/pharmacy/medicine-group/MedicinegroupCreate.vue';
import MedicinegroupEdit from '../components/hospital/admin/dashboard/pharmacy/medicine-group/MedicinegroupEdit.vue';

import Prescription from '../components/hospital/admin/dashboard/prescription/Prescription.vue';

import PatientList from '../components/hospital/admin/dashboard/doctor/patient/PatientList.vue';
import Patient from '../components/hospital/admin/dashboard/doctor/patient/Patient.vue';

import Category from '../components/hospital/admin/dashboard/pathology/pathology-category/Category.vue';
import CategoryCreate from '../components/hospital/admin/dashboard/pathology/pathology-category/CategoryCreate.vue';
import CategoryEdit from '../components/hospital/admin/dashboard/pathology/pathology-category/CategoryEdit.vue';

import Pathology from '../components/hospital/admin/dashboard/pathology/pathology/Pathology.vue';
import PathologyCreate from '../components/hospital/admin/dashboard/pathology/pathology/PathologyCreate.vue';
import PathologyEdit from '../components/hospital/admin/dashboard/pathology/pathology/PathologyEdit.vue';
const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
        children: [
            {
                path: '/doctorappoinment-view/:id',
                name: 'DoctorappoinmentView',
                components: {
                    default: Home,
                    content: DoctorappoinmentView
                },
                meta: { hideMainContent: true },
            }
        ]
    },

    { name: 'Login', component: Login, path: '/login' },
    { name: 'Register', component: Register, path: '/register' },
    { name: 'Forget', component: Forget, path: '/forget' },
    { name: 'DoctorviewOffline', component: DoctorviewOffline, path: '/doctorview/:id' },

    {
        path: '/hospital_dashboard',
        name: 'Dashboard',
        component: Dashboard,
        children: [
            {
                path: '/doctor',
                name: 'Doctor',
                components: {
                    default: Dashboard,
                    content: Doctor,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/doctor-create',
                name: 'DoctorCreate',
                components: {
                    default: Dashboard,
                    content: DoctorCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/doctor_view/:id',
                name: 'DoctorView',
                components: {
                    default: Dashboard,
                    content: DoctorView,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/doctoredit/:id',
                name: 'DoctorEdit',
                components: {
                    default: Dashboard,
                    content: DoctorEdit,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/doctor-active',
                name: 'DoctorActive',
                components: {
                    default: Dashboard,
                    content: DoctorActive,
                },
                meta: { hideMainContent: true },
            },

            {
                path: '/doctor-inactive',
                name: 'DoctorInActive',
                components: {
                    default: Dashboard,
                    content: DoctorInActive,
                },
                meta: { hideMainContent: true },
            },

            {
                path: '/appoinment',
                name: 'Appoinment',
                components: {
                    default: Dashboard,
                    content: Appoinment,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/appoinment-details',
                name: 'AppoinmentDetails',
                components: {
                    default: Dashboard,
                    content: AppoinmentDetails,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/appoinment-create',
                name: 'AppoinmentCreate',
                components: {
                    default: Dashboard,
                    content: AppoinmentCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/appoinment-report',
                name: 'AppointReport',
                components: {
                    default: Dashboard,
                    content: AppointReport,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/appoinment-doctor-report',
                name: 'DoctorwiseReport',
                components: {
                    default: Dashboard,
                    content: DoctorwiseReport,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/doctor-visit',
                name: 'DoctorVisit',
                components: {
                    default: Dashboard,
                    content: DoctorVisit,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/symtom',
                name: 'Symtom',
                components: {
                    default: Dashboard,
                    content: Symtom,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/symtom-create',
                name: 'SymtomCreate',
                components: {
                    default: Dashboard,
                    content: SymtomCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/symtomEdit/:id',
                name: 'SymtomEdit',
                components: {
                    default: Dashboard,
                    content: SymtomEdit,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/specialist',
                name: 'Specialist',
                components: {
                    default: Dashboard,
                    content: Specialist,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/specialist-create',
                name: 'SpecialistCreate',
                components: {
                    default: Dashboard,
                    content: SpecialistCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/experience',
                name: 'Experience',
                components: {
                    default: Dashboard,
                    content: Experience,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/experience-create',
                name: 'ExperienceCreate',
                components: {
                    default: Dashboard,
                    content: ExperienceCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/experienceEdit/:id',
                name: 'ExperienceEdit',
                components: {
                    default: Dashboard,
                    content: ExperienceEdit,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/reference',
                name: 'ReferenceList',
                components: {
                    default: Dashboard,
                    content: ReferenceList,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/reference-create',
                name: 'ReferenceCreate',
                components: {
                    default: Dashboard,
                    content: ReferenceCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/reference-edit/:id',
                name: 'ReferenceEdit',
                components: {
                    default: Dashboard,
                    content: ReferenceEdit,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/room',
                name: 'Roomlist',
                components: {
                    default: Dashboard,
                    content: Roomlist,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/room-create',
                name: 'RoomListCreate',
                components: {
                    default: Dashboard,
                    content: RoomListCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/roomlist-edit/:id',
                name: 'RoomlistEdit',
                components: {
                    default: Dashboard,
                    content: RoomlistEdit,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/department-category',
                name: 'Department',
                components: {
                    default: Dashboard,
                    content: Department,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/department-category-create',
                name: 'DepartmentCreate',
                components: {
                    default: Dashboard,
                    content: DepartmentCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/departmentEdit/:id',
                name: 'DepartmentEdit',
                components: {
                    default: Dashboard,
                    content: DepartmentEdit,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/specialistEdit/:id',
                name: 'SpecialistEdit',
                components: {
                    default: Dashboard,
                    content: SpecialistEdit,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/medicine-group',
                name: 'MedicineGroup',
                components: {
                    default: Dashboard,
                    content: MedicineGoup,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/medicine-group-create',
                name: 'MedicinegroupCreate',
                components: {
                    default: Dashboard,
                    content: MedicinegroupCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/medicine-group-edit/:id',
                name: 'MedicinegroupEdit',
                components: {
                    default: Dashboard,
                    content: MedicinegroupEdit,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/medicine',
                name: 'Medicine',
                components: {
                    default: Dashboard,
                    content: Medicine,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/medicine-create',
                name: 'MedicineCreate',
                components: {
                    default: Dashboard,
                    content: MedicineCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/medicine-eidt/:id',
                name: 'MedicineEdit',
                components: {
                    default: Dashboard,
                    content: MedicineEdit,
                },
                meta: { hideMainContent: true },
            },

            {
                path: '/prescription',
                name: 'Prescription',
                components: {
                    default: Dashboard,
                    content: Prescription,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/patient-list',
                name: 'PatientList',
                components: {
                    default: Dashboard,
                    content: PatientList,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/patient',
                name: 'Patient',
                components: {
                    default: Dashboard,
                    content: Patient,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/pathology-category',
                name: 'Category',
                components: {
                    default: Dashboard,
                    content: Category,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/pathology-category-create',
                name: 'CategoryCreate',
                components: {
                    default: Dashboard,
                    content: CategoryCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/pathology-category-edit/:id',
                name: 'CategoryEdit',
                components: {
                    default: Dashboard,
                    content: CategoryEdit,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/pathology',
                name: 'Pathology',
                components: {
                    default: Dashboard,
                    content: Pathology,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/pathology-create',
                name: 'PathologyCreate',
                components: {
                    default: Dashboard,
                    content: PathologyCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/pathology-edit/:id',
                name: 'PathologyEdit',
                components: {
                    default: Dashboard,
                    content: PathologyEdit,
                },
                meta: { hideMainContent: true },
            },

        ]
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});



export default router;