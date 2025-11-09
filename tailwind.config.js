/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Roboto Flex", "system-ui", "sans-serif"],
        mono: ["Roboto Mono", "monospace"],
      },
      colors: {
        background: "var(--background)",
        foreground: "var(--foreground)",
        background: "var(--background)",
  foreground: "var(--foreground)",

  primary: "var(--primary)",
  'primary-foreground': "var(--primary-foreground)",

  secondary: "var(--secondary)",
  'secondary-foreground': "var(--secondary-foreground)",

  accent: "var(--accent)",
  'accent-foreground': "var(--accent-foreground)",

  border: "var(--border)",
  input: "var(--input)",

  ring: "var(--ring)",  // ✅ defines ring color so outline-ring works
        primary: "var(--primary)",
        'primary-foreground': "var(--primary-foreground)",

        secondary: "var(--secondary)",
        'secondary-foreground': "var(--secondary-foreground)",

        accent: "var(--accent)",
        'accent-foreground': "var(--accent-foreground)",

        border: "var(--border)",
        input: "var(--input)",
        ring: "var(--ring)",
      },
      borderColor: {
        DEFAULT: "var(--border)",
      },
      borderRadius: {
        sm: "calc(var(--radius) - 4px)",
        md: "calc(var(--radius) - 2px)",
        lg: "var(--radius)",
        xl: "calc(var(--radius) + 4px)",
      },
    },
  },
  plugins: [
    require("tailwindcss-animate"),
  ],
};
