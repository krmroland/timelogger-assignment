<template>
  <v-dialog v-bind="$attrs" persistent max-width="500">
    <v-card>
      <v-toolbar flat tile>
        <v-toolbar-title class="tw-text-xl tw-font-medium"> Log Entry </v-toolbar-title>
        <v-spacer></v-spacer>

        <v-btn icon @click="$emit('update:modelValue', false)">
          <v-icon>{{ mdiClose }}</v-icon>
        </v-btn>
      </v-toolbar>

      <v-card-text>
        <v-form class="tw-mt-5" @submit.prevent="handleSubmit">
          <v-text-field
            outlined
            dense
            type="date"
            :error-messages="form.errors.date"
            label="Time in minutes *"
            :prepend-inner-icon="mdiLabelOutline"
            v-model="form.date"
            class="tw-mb-3"
            placeholder="Date"
          />

          <v-text-field
            outlined
            dense
            type="categories"
            min="0"
            hide-spin-buttons
            :error-messages="form.errors.time_in_minutes"
            label="Time in minutes *"
            :prepend-inner-icon="mdiLabelOutline"
            v-model="form.time_in_minutes"
            class="tw-mb-3"
            placeholder="The time worked in minutes"
          />

          <v-combobox
            clearable
            chips
            closable-chips
            v-model="form.categories"
            :error-messages="form.errors.categories"
            multiple
            label="Cargories"
          ></v-combobox>

          <v-textarea
            label="Description"
            v-model="form.description"
            auto-grow
            rows="2"
            max-rows="5"
            :error-messages="form.errors.description"
          />

          <div class="tw-my-2">
            <v-btn
              color="primary"
              type="submit"
              block
              :disabled="form.processing"
              :loading="form.processing"
            >
              <v-icon left>{{ mdiBookClockOutline }}</v-icon>
              Log Time
            </v-btn>
          </div>
        </v-form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script setup>
  import { mdiBookClockOutline, mdiClose, mdiLabelOutline } from '@mdi/js';

  import useForm from '@/utils/useForm';

  import notify from '@/utils/notify';
  import store from '@/utils/store';

  const emit = defineEmits(['created', 'update:modelValue']);

  const form = useForm({
    date: null,
    time_in_minutes: 0,
    categories: [],
    description: '',
  });

  async function handleSubmit() {
    form
      .post(`/api/v1/users/${store.userId}/time-entries`)
      .then(({ data: entry }) => {
        form.reset();
        emit('created', entry);
        notify.success('Entry was created successfully');
      })
      .catch((e) => {
        notify.error('Something went wrong while logging time');
      });
  }
</script>
