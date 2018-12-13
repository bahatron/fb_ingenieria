import "dotenv/config";
import { expect } from "chai";
import $clientFirebaseRTManager from "../src/components/client/services/ClientFirebaseRTManager";

describe("Client manager", () => {
    it("can persist clients", async () => {
        const dummy = {
            name: "test_name",
            visible: false,
            description: "an optional description",
            website: "https://google.com",
        };

        const result = await $clientFirebaseRTManager.persist(dummy);

        const data = await result.once("value");

        return expect(data.val()).to.deep.equal(dummy);
    });
});
