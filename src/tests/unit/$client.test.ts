// @TODO: mock database call
import "./firebase.config"; // workaround for mocha

import { expect } from "chai";

import $client from "../../domain/client";

const GOOD_DATA = {
    name: "test_name",
    visible: false,
    description: "an optional description",
    website: "https://google.com",
};

const BAD_DATA = {
    website: "https://google.com",
};

describe("$client", () => {
    describe("create", () => {
        it("throws an error if the data is incomplete", async () => {
            let result;

            try {
                result = await $client.create({ data: BAD_DATA });
            } catch (err) {
                result = err;
            } finally {
                expect(result instanceof Error).to.be.true;
            }
        });
    });
});
