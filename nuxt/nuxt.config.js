// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    devtools: {enabled: false},
    ssr: false,
    loading: '~/components/general/LoadingIniactor.vue',
    app: {
        head: {
            title: 'سازمان ميادين ميوه و تره بار و ساماندهي مشاغل شهري شهرداري اصفهان',
            htmlAttrs: {dir: 'rtl', lang: 'fa'},
            meta: [{name: 'description', content: ''}],
        },
    },

    runtimeConfig: {
        apiSecret: '123',
        public: {
            appURL: process.env.APP_URL,
            imageUrl: process.env.STORAGE_URL,
        },
    },

    build: {
        transpile: ['vuetify'],
    },

    vite: {
        define: {
            'process.env.DEBUG': false,
        },

    },

    routeRules: {
        // Static page generated on-demand, revalidates in background => { swr: true }
        // Static page generated on-demand once => { static: true }
        // Set custom headers matching paths => { headers: { 'cache-control': 's-maxage=0' } }
        // Render these routes with SPA => { ssr: false }
        // Add cors headers => { cors: true }
        // Add redirect headers => { redirect: '/new-page' }, { redirect: { to: '/new-page', statusCode: 302 } }
        '/': {ssr: false},
        '/user/**': {ssr: false},
        // '/marketer/**': { ssr: false },
    },

    css: [
        '@/assets/app.scss',
        'vuetify/lib/styles/main.sass',
        '@mdi/font/css/materialdesignicons.min.css',
    ],

    modules: ['@pinia/nuxt', '@nuxt-alt/auth', '@nuxt-alt/proxy', "@vite-pwa/nuxt",],

    proxy: {
        proxies: {
            '/gate': {
                target: process.env.BASE_URL,
                rewrite: (path) => path.replace(/^\/gate/, ''),
            },
        },
    },

    auth: {
        redirect: {
            login: '/login',
            logout: '/',
            home: '/',
            callback: '/login',
        },
        strategies: {
            local: {
                endpoints: {
                    login: {
                        url: '/gate/api/auth/login',
                        method: 'post',
                        propertyName: false,
                    },
                    user: {
                        url: '/gate/api/user',
                        method: 'get',
                        propertyName: false,
                    },
                    logout: {
                        url: '/gate/api/auth/logout',
                        method: 'post',
                        propertyName: false,
                    },
                    csrf: {url: '/gate/sanctum/csrf-cookie'},
                },
                token: {
                    property: 'token',
                    prefix: '_token.',
                    required: true,
                    type: 'Bearer',
                    global: true,
                },
                user: {
                    property: false,
                    autoFetch: true,
                },
                // localStorage: {
                //   prefix: "auth.",
                // },
                cookie: {
                    prefix: 'auth.',
                    options: {
                        path: '/',
                    },
                },
            },
        },
    },

    pwa: {
        manifest: {
            name: "fruitify",
            icons: [
                {
                    "src": "/images/logo.png",
                    "sizes": "64x64",
                    type: "image/png",
                },
                {
                    "src": "/images/logo.png",
                    "sizes": "120x120",
                    type: "image/png",
                },
                {
                    "src": "/images/logo.png",
                    "sizes": "144x144",
                    type: "image/png",
                },
                {
                    "src": "/images/logo.png",
                    "sizes": "152x152",
                    type: "image/png"
                },
                {
                    "src": "/images/logo.png",
                    "sizes": "192x192",
                    type: "image/png"
                },
                {
                    "src": "/images/logo.png",
                    "sizes": "384x384",
                    type: "image/png"
                },
                {
                    "src": "/images/logo.png",
                    "sizes": "512x512",
                    type: "image/png"
                },
            ],

        },
        devOptions: {
            enabled: false,
            type: "module",
        },
    }
});
