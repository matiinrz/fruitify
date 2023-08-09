import { toast } from 'vue3-toastify'

export default defineNuxtRouteMiddleware((to, from) => {
    const auth = useAuth();

    if (!auth.loggedIn) {
        return navigateTo('/login')
    }

})