import { toast } from 'vue3-toastify'

export default defineNuxtRouteMiddleware((to, from) => {
    const auth = useAuth();

    if (!auth.loggedIn) {
        return navigateTo('/login')
    }

    if (auth?.user?.role === 'ADMIN' && !to.path.includes('admin')) {
        return navigateTo('/admin')
    }

    if (to.path.includes('admin') && auth?.user?.role !== 'ADMIN'){
        return navigateTo('/login')
    }

    if (to.path.includes('/user/list') && auth?.user?.role === 'FINDER') {
        toast.error('شما به این بخش دسترسی ندارید')
        return navigateTo('/user')
    }

    if (to.path.includes('/user/users') && auth?.user?.role !== 'SUPERUSER') {
        toast.error('شما به این بخش دسترسی ندارید')
        return navigateTo('/user')
    }
})