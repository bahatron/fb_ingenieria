import "dotenv/config"; // this is to run tests directly from vscode
// import { expect } from "chai";
import $fs from "fs";
import $path from "path";
import $storage from "../../../services/Storage";

function loadTestFile() {
    const path = $path.resolve(__dirname, "../../fixtures/coolCat.jpg");

    return $fs.readFileSync(path);
}

describe("storage service", () => {
    describe("given an image file", () => {
        const file = loadTestFile();

        it("uploads the image to the bucket", async () => {
            const result = await $storage.upload(file);
        });
    });
});
