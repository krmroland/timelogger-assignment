module.exports = {
  printWidth: 100,
  trailingComma: 'all',
  singleQuote: true,
  semi: true,
  tabWidth: 2,
  vueIndentScriptAndStyle: true,
  phpVersion: '8.0',
  overrides: [
    {
      files: '*.php',
      options: {
        tabWidth: 4,
        printWidth: 120,
        trailingCommaPHP: true,
      },
    },
    {
      files: '*blade.php',
      options: {
        tabWidth: 2,
        printWidth: 100,
      },
    },
    {
      files: '*.yml',
      options: {
        singleQuote: false,
      },
    },
  ],
};
