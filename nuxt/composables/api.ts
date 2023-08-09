import type { UseFetchOptions } from 'nuxt/dist/app/composables';
import { toast } from 'vue3-toastify';

export const api = (path: string, opts?: UseFetchOptions<any>) => {

    /** load nuxt env configuration */
    const config = useRuntimeConfig();

    /** load nuxt bearer token if user logged in */
    const authentication = useAuth();
    const token: string = (authentication.loggedIn && authentication.tokenStrategy.token)
        ? authentication.tokenStrategy.token.get().toString() : '';

    /** request options */
    let options: UseFetchOptions<any> = {
        ...opts,
        baseURL: config.public.appURL,
        headers: {
            'Accept': 'application/json',
            'Cache-Control': 'no-cache',
            'Authorization': token,
            ...opts?.headers
        },
        onResponseError(context) {
            if (!toast) return;
            if (context.response.status == 401) {
                useRouter().push('/login')
            }

            if (context.response.status == 403) {
                useRouter().push('/')
            }

            const responseData = context.response._data;

            if (typeof responseData === 'string') {
                // Handle non-JSON response
                toast.error(responseData);
            } else {
                // Handle JSON response
                const errorMessage = responseData?.message || context.response?.statusText || context.error;
                toast.error(errorMessage);
            }
        }
    };

    if (!options.onResponse) {
        options.onResponse = (context) => {
            if (!toast || !context.response._data?.message || context.response.status != 200) return;
        }
    };


    return useFetch(`/gate/${path}`, options);
}