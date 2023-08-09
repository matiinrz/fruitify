import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import colors from 'vuetify/lib/util/colors';
import { aliases, mdi } from 'vuetify/iconsets/mdi';
import { createVuetify } from 'vuetify';

export default defineNuxtPlugin((nuxtApp) => {
  let theme = {
    defaultTheme: 'light',
    themes: {
      light: {
        dark: false,
        colors: {
          primary:  '#73C273',
          light: '#E7FFE8',
          grey: '#6C7B8E',
          dark: '#0C1222',
        },
      },
      dark: {
        dark: true,
        colors: {
          primary: colors.lightBlue.darken3,
          secondary: colors.deepOrange.darken2,
          fade: colors.grey.darken2,
        },
      },
    },
  };

  let icons = {
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi,
    },
  };

  let defaults = {
    VBtnSecondary: {
      color: 'secondary',
    },
    VBtn: {
      color: '#73C273',
      rounded: 'md',
      textColor: 'white',
 
    },
    VCardActions: {
      VBtn: {
        variant: 'flat',
        minWidth: '110',
        rounded: 'md',
      },
    },
    VCard: {
      elevation: 0,
      rounded: 'md',
      color: 'transparent',
    },
    VList: {
      elevation: 0,
    },
    VTextField: {
      density: 'compact',
      variant: 'solo',
      color: 'dark',
    },
    VTextarea: {
      density: 'compact',
      variant: 'solo-inverted',
      color: 'dark',
    },
    vFileInput: {
      density: 'compact',
      variant: 'solo',
      color: 'dark',
    },
    VAutocomplete: {
      density: 'compact',
      color: 'dark',
    },
    VSheet: {
      elevation: 4,
    },
    VSystemBar: {
      color: 'dark',
    },
    VCarouselItem: {
      rounded: 'md',
      elevation: 4,
    },
    VDivider: {
      thickness: 2,
      color: 'gray',
    },
    VSelect: {
      density: 'compact',
      variant: 'solo-inverted',
      color: 'dark',
    },
    VAppBar: {
      elevention: 1,
      color: 'white',
      density: 'compact',
    },
    VBottomNavigation: {
      elevention: 0,
      color: 'primary',
      density: 'compact',
      bgColor: 'white',
    },
  };

  const vuetify = createVuetify({
    display: {
      mobileBreakpoint: 'lg',
      thresholds: {
        xs: 0,
        sm: 340,
        md: 540,
        lg: 800,
        xl: 1280,
      },
    },
    ssr: true,
    components,
    directives,
    theme: theme,
    icons: icons,
    defaults: defaults,
  });

  nuxtApp.vueApp.use(vuetify);
});
