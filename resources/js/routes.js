const Login = () => import('./components/Login/Login.vue' /* webpackChunkName: "resource/js/components/login" */)
const Welcome = () => import('./components/Welcome.vue' /* webpackChunkName: "resource/js/components/welcome" */)
const CompanyList = () => import('./components/Company/List.vue' /* webpackChunkName: "resource/js/components/category/list" */)
const CompanyCreate = () => import('./components/Company/Add.vue' /* webpackChunkName: "resource/js/components/category/add" */)
const CompanyEdit = () => import('./components/Company/Edit.vue' /* webpackChunkName: "resource/js/components/category/edit" */)
const CompanyShow = () => import('./components/Company/Show.vue' /* webpackChunkName: "resource/js/components/category/show" */)
const EmployeeList = () => import('./components/Employee/List.vue' /* webpackChunkName: "resource/js/components/Employee/list" */)
const EmployeeCreate = () => import('./components/Employee/Add.vue' /* webpackChunkName: "resource/js/components/Employee/add" */)
const EmployeeEdit = () => import('./components/Employee/Edit.vue' /* webpackChunkName: "resource/js/components/Employee/edit" */)
const EmployeeShow = () => import('./components/Employee/Show.vue' /* webpackChunkName: "resource/js/components/Employee/show" */)

export const routes = [
    {
        name: 'home',
        path: '/home',
        component: Welcome
    },
    {
        name: 'companyList',
        path: '/company',
        component: CompanyList
    },
    {
        name: 'companyEdit',
        path: '/company/:id/edit',
        component: CompanyEdit
    },
    {
        name: 'companyShow',
        path: '/company/:id/show',
        component: CompanyShow
    },
    {
        name: 'companyAdd',
        path: '/company/add',
        component: CompanyCreate
    },
    {
        name: 'employeeList',
        path: '/employee',
        component: EmployeeList
    },
    {
        name: 'employeeEdit',
        path: '/employee/:id/edit',
        component: EmployeeEdit
    },
    {
        name: 'employeeShow',
        path: '/employee/:id/show',
        component: EmployeeShow
    },
    {
        name: 'employeeAdd',
        path: '/employee/add',
        component: EmployeeCreate
    }
]
