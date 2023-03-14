import { createRouter, createWebHistory } from 'vue-router'
import TasksIndex from './components/tasks/TasksIndex.vue';
import TasksCreate from './components/tasks/TasksCreate.vue';
import TasksEdit from './components/tasks/TasksEdit.vue';
import SubtaskEdit from './components/subtask/SubtaskEdit.vue';
import SubtaskCreate from './components/subtask/SubtaskCreate.vue';
import UserToken from './components/user/UserToken.vue';


const routes = [
    {
        path: '/tasks',
        name: 'tasks.index',
        component: TasksIndex
    },
    {
        path: '/tasks/create',
        name: 'tasks.create',
        component: TasksCreate
    },
    {
        path: '/tasks/:id/edit',
        name: 'tasks.edit',
        component: TasksEdit,
        props: true
    },
    {
        path: '/subtask/:task_id/create',
        name: 'subtask.create',
        component: SubtaskCreate,
        props: true
    },
    {
        path: '/subtask/:subtask_id/edit',
        name: 'subtask.edit',
        component: SubtaskEdit,
        props: true
    },
    {
        path: '/user/token',
        name: 'user.token',
        component: UserToken
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
