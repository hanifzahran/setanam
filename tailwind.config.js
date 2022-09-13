const colors = require("tailwindcss/colors");
module.exports = {
    purge: ["./resources/views/**/*.blade.php", "./resources/css/**/*.css"],
    theme: {
        extend: {
            fontFamily: {
                inter: "'Inter',serif",
            },
        },
        screens: {
            sm: "320px",
            md: "768px",
            lg: "1024px",
            xl: "1227px",
            "2xl": "1440px",
        },
        colors: {
            white: colors.white,
            emerald: colors.emerald,
            indigo: colors.indigo,
            yellow: colors.yellow,
            red: colors.red,
            green: colors.green,
            blue: colors.blue,
            primary: "#1C4C4E",
            secondary: "#28B67E",
            info: "#2F80ED",
            success: "#27AE60",
            warning: "#E2B93B",
            error: "#EB5757",
            orange: "#F2994A",
            black: {
                1: "#000000",
                2: "#1D1D1D",
                3: "#282828",
            },
            gray: {
                1: "#333333",
                2: "#4F4F4F",
                3: "#828282",
                4: "#BDBDBD",
                5: "#E0E0E0",
            },
        },
    },
    variants: {},
};
