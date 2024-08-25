/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#232531",
                primarySecond: "#132532",
                second: "#787F99",
                textColor: "#FEFEFC",
                textSecond: "#8D92A5",
            },
        },
    },
    plugins: [],
};
