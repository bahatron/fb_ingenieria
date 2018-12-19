import "dotenv/config";
import { expect } from "chai";
import $clientFactory from "../src/components/client/services/ClientFactory";
import { Client } from "../src/components/client/ClientFacade";
import $firebase from "../src/services/firebase";

/**
 * @todo: move this to an env file?
 */
const CLIENT_REF = "test/client";

describe("Client Factory", () => {
    it("can create a client", async () => {
        const id = "test_client_2";
        const data = {
            name: "test_dummy_123",
            visible: false,
            description: "an optional description",
            website: "https://website.com",
            image: "https://awesome.com/image.png",
        };

        const ref = $firebase.database().ref(`${CLIENT_REF}/${id}`);
        await ref.set(data);

        const client: Client = await $clientFactory.create({ ref, id });

        const clientData = await client.data();

        expect(data).to.deep.equal(clientData);
        expect(id).to.equal(client.id);
    });
});
