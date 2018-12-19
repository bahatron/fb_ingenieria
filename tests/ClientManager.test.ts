import "dotenv/config";
import { expect } from "chai";
import $clientManager from "../src/components/client/services/ClientManager";
import $firebase from "../src/services/firebase";

describe("Client manager", () => {
    after(() => {
        // close connection to firebase
        $firebase.database().goOffline();
    });

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
});
