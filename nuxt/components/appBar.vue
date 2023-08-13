<template>
  <div>
    <v-app-bar>
      <v-app-bar-title class="text-primary">{{ appBarTitle }}</v-app-bar-title>

      <template v-slot:append>
        <v-btn size="small" icon="mdi-home" to="/"></v-btn>
        <v-btn v-if="auth.user.permission == 'superuser'" size="small" icon="mdi-account-outline" to="/admin"></v-btn>
        <v-btn size="small" icon="mdi-power" @click="logoutDialog = true"></v-btn>
      </template>
    </v-app-bar>

    <v-dialog v-model="logoutDialog" persistent max-width="300">
      <v-card color="white">
        <v-card-title>آیا از خروج اطمینان دارید ؟</v-card-title>
        <v-card-text>
          در صورت اطمینان تایید و در غیر این صورت انصراف را انتخاب کنید .
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-btn variant="outlined" @click="logoutDialog = false">
            انصراف
          </v-btn>
          <v-btn @click="logout()" class="text-white">
            تایید
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script setup>
const { $listen } = useNuxtApp()
const auth = useAuth()
const router = useRouter()
const appBarTitle = ref('خانه')
const logoutDialog = ref(false)

const changeTitle = (title) => {
  useHead({
    title: title
  })
  appBarTitle.value = title
}

const logout = async () => {
  await auth.logout();
  router.replace({ path: "/login" });
}

$listen('tilte-chaneg', changeTitle)


</script>

<style scoped></style>