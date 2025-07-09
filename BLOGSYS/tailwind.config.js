const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                georgia: ["Georgia", ...defaultTheme.fontFamily.sans],
                cabin: ["Cabin", "sans-serif"],
                lora: ["Lora"],
            },
            colors: {
                primary: "#0000008a",
            },
        },
    },

    plugins: [require("flowbite-typography"), require("@tailwindcss/forms")],
};
