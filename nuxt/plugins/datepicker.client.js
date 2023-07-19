import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker';
import colors from 'vuetify/lib/util/colors';

export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.vueApp.use(Vue3PersianDatetimePicker, {
    name: 'CustomDatePicker',
    props: {
      inputFormat: 'YYYY-MM-DD HH:mm',
      format: 'jYYYY-jMM-jDD', // jYYYY-jMM-jDD HH:mm
      editable: false,
      inputClass: 'form-control my-custom-class-name',
      placeholder: 'انتخاب کنید',
      altFormat: 'jYYYY-jMM-jDD',
      color: colors.green.darken4,
      autoSubmit: true,
      clearable: true,
      displayFormat: 'jYYYY-jMM-jDD',
      //...
      //... And whatever you want to set as default.
      //...
    },
  });
  
});
