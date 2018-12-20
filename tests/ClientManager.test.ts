import "./init.test"; // workaround for mocha

import { expect } from "chai";
import $clientManager from "../src/components/client/services/ClientManager";

describe("Client manager", () => {
    it("can persist clients", async () => {
        const dummy = {
            name: "test_name",
            visible: false,
            description: "an optional description",
            website: "https://google.com",
        };

        const result = await $clientManager.persist({
            data: dummy,
            id: "test_id_1",
        });

        const data = await result.data();

        return expect(data).to.deep.equal(dummy);
    });

    it("can fetch all clients", async () => {
        const clients = await $clientManager.all();

        expect(Array.isArray(clients)).to.be.true;
    });
});
