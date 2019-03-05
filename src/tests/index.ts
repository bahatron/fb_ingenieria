import "dotenv/config";

import $mocha from "mocha";
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

async function loadMochaTests(): Promise<string[]> {
    const path = PATH.resolve(__dirname, MOCHA_TEST_PATH);

    return loadFolderFilesRecursive(path);
}

async function mochaTests() {
    const mochaRunner = new $mocha();

    const mochaTests = await loadMochaTests();

    mochaTests.forEach((testFile) => {
        mochaRunner.addFile(testFile);
    });

    mochaRunner.run((failures) => {
        console.log(`Failures: ${failures}`);
    });
}

async function main() {
    try {
        console.log("hello");
        await mochaTests();
        process.exit(0);
    } catch (err) {
        console.log(`Error: ${err.message}`);
        process.exit(-1);
    }
}
main();
