import "dotenv/config";

import mocha from "mocha";
import FS from "fs";
import PATH from "path";

const MOCHA_TEST_PATH = "./unit";

function loadFolderContent(path: string): string[] {
    return FS.readdirSync(path).map(entry => PATH.resolve(path, entry));
}

function isValidFile(path: string, validExtension = ["ts", "js"]): boolean {
    return FS.statSync(path).isFile() && validExtension.includes(path.split(".").pop() || "");
}

function loadFolderFilesRecursive(path: string): string[] {
    return loadFolderContent(path).reduce((foundFiles: string[], entry: string) => {
        if (FS.statSync(entry).isDirectory()) {
            foundFiles = foundFiles.concat(loadFolderFilesRecursive(entry));
        } else if (isValidFile(entry)) {
            foundFiles.push(entry);
        }

        return foundFiles;
    }, []);
}

function loadMochaTests(): string[] {
    const path = PATH.resolve(__dirname, MOCHA_TEST_PATH);

    return loadFolderFilesRecursive(path);
}

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
