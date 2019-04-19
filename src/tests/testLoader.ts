import FS from "fs";
import PATH from "path";

const MOCHA_TEST_PATH = "./unit";

const EXCLUDED_FILES = [".eslintrc.js"];

function loadFolderContent(path: string): string[] {
    return FS.readdirSync(path).map(entry => PATH.resolve(path, entry));
}

function includesFile(path: string, excluded: string[]): boolean {
    return excluded.every(fileName => path.includes(fileName));
}

function isValidFile(path: string): boolean {
    return FS.statSync(path).isFile() && !includesFile(path, EXCLUDED_FILES);
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

export default function loadMochaTests(): string[] {
    const path = PATH.resolve(__dirname, MOCHA_TEST_PATH);

    return loadFolderFilesRecursive(path);
}
