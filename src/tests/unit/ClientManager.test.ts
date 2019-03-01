// @TODO: mock database call
import "./firebase.config"; // workaround for mocha

import { expect } from "chai";
import $clientManager from "../../domain/client/services/ClientManager";

const DUMMY_DATA = {
    name: "test_name",
    visible: false,
    description: "an optional description",
    website: "https://google.com",
};

describe("Client manager", () => {
    it("can create clients", async () => {
        const result = await $clientManager.create({
            data: DUMMY_DATA,
            id: "test_id_1",
        });

        const data = await result.data();

        return expect(data).to.deep.equal(DUMMY_DATA);
    });

    it("can fetch all clients", async () => {
        const clientInstance = await $clientManager.create({ data: DUMMY_DATA });

        const clients = await $clientManager.all();

        expect(Array.isArray(clients)).to.be.true;

        clients.forEach((client) => {
            expect(Object.getPrototypeOf(client)).to.equal(Object.getPrototypeOf(clientInstance));
        });
    });
});
