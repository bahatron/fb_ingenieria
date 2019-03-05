import { expect } from "chai";
import $database from "../../../services/Database";

function validator(data: any): any {
    return data;
}

async function createModel(data: any) {
    return $database.persist({
        path: "test",
        id: "testy",
        data,
        validator,
    });
}

describe("Database", () => {
    describe("data model", () => {
        it("can retrieved stored data", async () => {
            const data = {
                foo: "bar",
                rick: "sanchez",
            };

            const model = await createModel(data);

            const stubData = await model.data();

            expect(data).to.be.deep.equal(stubData);
        });

        it("will trigger a 'value' event when updated", async () => {
            const data = {
                foo: "bar",
            };

            const newData = {
                rick: "sanchez",
            };

            const model = await createModel(data);

            /** NOTE: if we remove the await from the update, the test will pass, but won't do the assertion */
            model.on("value", (value: any) => {
                expect(value).to.deep.equal({ ...data, ...newData });
            });

            await model.update(newData);
        });
    });
});
