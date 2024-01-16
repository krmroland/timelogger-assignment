import "vuetify/styles";

import { createVuetify } from "vuetify";

import { aliases, mdi } from "vuetify/iconsets/mdi-svg";

import colors from "@/utils/colors";

export default createVuetify({
  icons: {
    defaultSet: "mdi",
    aliases,
    sets: {
      mdi,
    },
  },

  theme: {
    themes: {
      dark: { colors },
      light: {
        colors,
      },
    },
  },

  defaults: {
    VTextField: {
      variant: "outlined",
      density: "compact",
      color: "primary",
    },

    VTextarea: {
      variant: "outlined",
      density: "compact",
      color: "primary",
      autoGrow: true,
    },
    VAutocomplete: {
      variant: "outlined",
      density: "compact",
      color: "primary",
    },
    VCombobox: {
      variant: "outlined",
      density: "compact",
      color: "primary",
    },
    VBtnToggle: {
      density: "compact",
      color: "primary",
    },
  },
});
