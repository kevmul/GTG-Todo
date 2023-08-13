const fs = require('fs');

const fileNames = fs
    .readdirSync(__dirname + '/../resources/js/svg')
    .map((file) => {
        return `'${file.replace(/\.svg$/, '')}'`;
    })
    .join(' | ');

fs.writeFile(
    __dirname + '/../resources/js/types/svgTypes.d.ts',
    `export type SvgNames = ${fileNames}`,
    (err) => {
        if (err) console.error(err);
    }
);
