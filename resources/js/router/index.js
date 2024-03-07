import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import Courses from '../components/Courses';
import Courselearner from '../components/Courselearner';
import AddCourse from '../components/AddCourse';
import EditCourse from '../components/EditCourse';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'courses',
        path: '/courses',
        component: Courses
    },
    {
        name: 'getlearner',
        path: '/get-learner-courses',
        component: Courselearner
    },
    {
        name: 'addcourse',
        path: '/courses/add',
        component: AddCourse
    },
    {
        name: 'editcourse',
        path: '/courses/edit/:id',
        component: EditCourse
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
