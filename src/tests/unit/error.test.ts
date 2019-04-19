import { expect } from "chai";
import $error from "../../services/error";

describe("ErrorFactory", () => {
    it("can create validation error", () => {
        const error = $error.ValidationFailed("message");

        expect(error instanceof Error).to.be.true;
    });
});
