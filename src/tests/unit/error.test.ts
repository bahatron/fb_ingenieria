import { expect } from "chai";
import $errorFactory from "../../domain/error/ErrorFactory";

describe("ErrorFactory", () => {
    it("can create validation error", () => {
        const error = $errorFactory.ValidationFailed("message");

        expect(error instanceof Error).to.be.true;
    });
});
