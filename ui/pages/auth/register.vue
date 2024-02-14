<template>
  <v-app class="tw-bg-zinc-200">
    <v-row justify="center" align="center">
      <v-col md="4">
        <v-card>
          <v-card-title class="tw-text-center tw-py-10">
            <h2>Time Logger Registration</h2>
          </v-card-title>
          <v-card-text>
            <v-text-field
              label="Name"
              v-model="form.name"
              :error-messages="form.errors.name"
            >
            </v-text-field>
            <v-text-field
              label="Email"
              v-model="form.email"
              :error-messages="form.errors.email"
            >
            </v-text-field>
            <v-text-field
              label="Password"
              type="password"
              v-model="form.password"
              :error-messages="form.errors.password"
            >
            </v-text-field>

            <v-divider></v-divider>
            <v-btn
              block
              type="button"
              color="primary"
              variant="elevated"
              @click="handleSubmit"
            >
              Register
            </v-btn>
            <div class="tw-mt-3 tw-text-center">
              <span>Already have an account? </span>
              <router-link
                :to="{ name: 'auth.login' }"
                class="tw-mb-2 tw-text-sm tw-text-info"
              >
                Login Instead
              </router-link>
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-app>
</template>
<script setup>
import useForm from "@/utils/useForm";
import notify from "@/utils/notify";

const form = useForm({
  name: "",
  email: "",
  password: "",
});

function handleSubmit() {
  form.post(`/auth/register`).then(() => {
    window.location.reload();
    notify.success("User was created successfully");
  });
}
</script>
