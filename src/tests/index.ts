import "dotenv/config";

import mocha from "mocha";
import loadMochaTests from "./testLoader";

function mochaTests(): Promise<void> {
    return new Promise((resolve, reject) => {
        const $mocha = new mocha();

        const mochaTests = loadMochaTests();

        mochaTests.forEach((testFile) => {
            $mocha.addFile(testFile);
        });

        $mocha.run(failures => (failures ? reject() : resolve()));
    });
}

async function main() {
    try {
        await mochaTests();
        process.exit(0);
    } catch (err) {
        process.exit(-1);
    }
}
main();
